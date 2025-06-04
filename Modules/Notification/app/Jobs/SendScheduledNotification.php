<?php

namespace Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Notification\Models\NotificationLog;
use Modules\Notification\Services\NotificationService;

class SendScheduledNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The notifiable entity (recipient).
     */
    protected $notifiable;
    
    /**
     * The notification object.
     */
    protected $notification;
    
    /**
     * The channels to try.
     */
    protected $channels;
    
    /**
     * The notification log.
     */
    protected $log;
    
    /**
     * Create a new job instance.
     */
    public function __construct($notifiable, $notification, $channels, NotificationLog $log)
    {
        $this->notifiable = $notifiable;
        $this->notification = $notification;
        $this->channels = $channels;
        $this->log = $log;
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationService $service)
    {
        // Verify the notification is still pending and scheduled for now or in the past
        if ($this->log->status !== NotificationLog::STATUS_PENDING || 
            ($this->log->scheduled_for && $this->log->scheduled_for->isFuture())) {
            return;
        }
        
        // Send the notification
        $service->send($this->notifiable, $this->notification, $this->channels);
    }
    
    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception)
    {
        // Update the log with failure information
        $this->log->markAsFailed($exception->getMessage());
    }
} 