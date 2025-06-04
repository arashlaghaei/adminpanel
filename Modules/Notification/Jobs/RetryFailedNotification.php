<?php

namespace Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Notification\Models\NotificationLog;
use Modules\Notification\Services\NotificationService;

class RetryFailedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The notification log ID.
     */
    protected $logId;
    
    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;
    
    /**
     * Create a new job instance.
     */
    public function __construct($logId)
    {
        $this->logId = $logId;
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationService $service)
    {
        $log = NotificationLog::find($this->logId);
        
        if (!$log || $log->status !== NotificationLog::STATUS_FAILED || !$log->canRetry()) {
            return;
        }
        
        // Get the notifiable entity
        $notifiable = $log->notifiable;
        
        if (!$notifiable) {
            $log->markAsFailed('Notifiable entity not found');
            return;
        }
        
        // Calculate backoff delay based on attempt number
        $delayMinutes = config('notification.retry.delay_minutes', 10);
        $backoffMultiplier = config('notification.retry.backoff_multiplier', 2);
        $delayMultiplier = pow($backoffMultiplier, $log->attempts - 1);
        
        // Add delay before retry
        $this->delay(now()->addMinutes($delayMinutes * $delayMultiplier));
        
        // Attempt to send by the same channel that failed
        $channel = $service->getChannel($log->channel);
        
        if (!$channel) {
            $log->markAsFailed("Channel {$log->channel} not found");
            return;
        }
        
        // Recreate notification from log data
        if (isset($log->data['notification_class']) && class_exists($log->data['notification_class'])) {
            $notificationClass = $log->data['notification_class'];
            $notification = new $notificationClass();
            
            // If we have serialized notification data, try to restore it
            if (isset($log->data['notification_serialized'])) {
                try {
                    $notification = unserialize($log->data['notification_serialized']);
                } catch (\Exception $e) {
                    // Just use the new instance if unserialization fails
                }
            }
            
            // Update log status to pending for the retry
            $log->status = NotificationLog::STATUS_PENDING;
            $log->save();
            
            // Try sending again using the same channel
            $channel->send($notifiable, $notification);
        } else {
            $log->markAsFailed('Cannot recreate notification object from log data');
        }
    }
    
    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception)
    {
        $log = NotificationLog::find($this->logId);
        
        if ($log) {
            $log->markAsFailed($exception->getMessage());
        }
    }
} 