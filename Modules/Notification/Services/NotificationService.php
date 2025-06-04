<?php

namespace Modules\Notification\Services;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Modules\Notification\Channels\DatabaseChannel;
use Modules\Notification\Channels\SmsChannel;
use Modules\Notification\Channels\WhatsAppChannel;
use Modules\Notification\Channels\TelegramChannel;
use Modules\Notification\Channels\SlackChannel;
use Modules\Notification\Channels\DiscordChannel;
use Modules\Notification\Models\NotificationLog;
use Modules\Notification\Models\NotificationRateLimit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;

class NotificationService
{
    /**
     * Available notification channels.
     */
    protected $channels = [];
    
    /**
     * Create a new notification service instance.
     */
    public function __construct()
    {
        // Initialize channels based on config
        $this->initializeChannels();
    }
    
    /**
     * Initialize available channels based on config.
     */
    protected function initializeChannels()
    {
        // Register default channels
        $this->channels = [
            'database' => new DatabaseChannel(),
            'sms' => new SmsChannel(),
            'whatsapp' => new WhatsAppChannel(),
            'telegram' => new TelegramChannel(),
            'slack' => new SlackChannel(),
            'discord' => new DiscordChannel(),
        ];
        
        // You could add more channels here or through a dynamic registration system
    }
    
    /**
     * Send a notification with fallback support.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @param array|null $channels Specific channels to use (overrides fallback chain)
     * @param \Carbon\Carbon|null $scheduledFor When to send the notification
     * @return bool
     */
    public function send($notifiable, Notification $notification, array $channels = null, Carbon $scheduledFor = null)
    {
        // If notification should be scheduled
        if ($scheduledFor && $scheduledFor->isFuture()) {
            return $this->scheduleNotification($notifiable, $notification, $channels, $scheduledFor);
        }
        
        // Get the fallback chain from the notification if it has one
        if ($channels === null && method_exists($notification, 'getFallbackChannels')) {
            $channels = $notification->getFallbackChannels($notifiable);
        }
        
        // Otherwise, use the default fallback chain from config
        if ($channels === null) {
            $channels = config('notification.fallback_order', ['sms', 'whatsapp', 'mail', 'database']);
        }

        $sent = false;
        // Try each channel in the fallback chain
        foreach ($channels as $channelName) {
            if (!isset($this->channels[$channelName])) {
                Log::warning("Notification channel {$channelName} not found.");
                continue;
            }
            
            $channel = $this->channels[$channelName];
            
            // Check if the channel is available/enabled
            if (!$channel->isAvailable($notifiable, $notification)) {
                continue;
            }
            
            // Attempt to send the notification through this channel
            $result = $channel->send($notifiable, $notification);
            
            // If successful, no need to try other channels
            if ($result) {
                $sent = true;
            }
        }

        if (!$sent) {
            // If we got here, all channels in the fallback chain failed
            Log::error('Failed to send notification through any channel', [
                'notifiable' => get_class($notifiable) . ':' . $notifiable->getKey(),
                'notification' => get_class($notification),
            ]);
        }

        return $sent;
    }
    
    /**
     * Schedule a notification for future delivery.
     */
    protected function scheduleNotification($notifiable, Notification $notification, array $channels = null, Carbon $scheduledFor)
    {
        // Create a log entry for the scheduled notification
        $notificationType = method_exists($notification, 'getType') ? $notification->getType() : get_class($notification);
        
        $log = NotificationLog::create([
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->getKey(),
            'notification_type' => $notificationType,
            'channel' => 'scheduled', // Will be updated when actually sent
            'data' => [
                'notification_class' => get_class($notification),
                'notification_id' => method_exists($notification, 'id') ? $notification->id : null,
                'channels' => $channels,
                'scheduled_for' => $scheduledFor->toIso8601String(),
            ],
            'status' => NotificationLog::STATUS_PENDING,
            'scheduled_for' => $scheduledFor,
        ]);
        
        // Dispatch to queue with delay
        $delay = $scheduledFor->diffInSeconds(now());
        
        Queue::later($delay, new \Modules\Notification\Jobs\SendScheduledNotification(
            $notifiable, $notification, $channels, $log
        ), [], config('notification.queue.default'));
        
        return true;
    }
    
    /**
     * Send a notification to multiple recipients.
     *
     * @param array $notifiables Array of recipients
     * @param \Illuminate\Notifications\Notification $notification
     * @param array|null $channels Specific channels to use
     * @param \Carbon\Carbon|null $scheduledFor When to send the notification
     * @return array Status for each recipient
     */
    public function sendMultiple(array $notifiables, Notification $notification, array $channels = null, Carbon $scheduledFor = null)
    {
        $results = [];
        
        foreach ($notifiables as $notifiable) {
            $results[get_class($notifiable) . ':' . $notifiable->getKey()] = $this->send($notifiable, $notification, $channels, $scheduledFor);
        }
        
        return $results;
    }
    
    /**
     * Get a specific notification channel.
     */
    public function getChannel(string $name)
    {
        return $this->channels[$name] ?? null;
    }
    
    /**
     * Register a new notification channel.
     */
    public function registerChannel(string $name, $channel)
    {
        $this->channels[$name] = $channel;
        return $this;
    }
    
    /**
     * Retry failed notifications.
     *
     * @param int $days Only retry notifications failed within the specified number of days
     * @return int Number of notifications queued for retry
     */
    public function retryFailed($days = null)
    {
        $query = NotificationLog::failed();
        
        if ($days !== null) {
            $query->where('created_at', '>=', now()->subDays($days));
        }
        
        $failedLogs = $query->get();
        $count = 0;
        
        foreach ($failedLogs as $log) {
            if ($log->canRetry()) {
                // Dispatch to queue for retry
                Queue::push(new \Modules\Notification\Jobs\RetryFailedNotification($log->id), [], config('notification.queue.default'));
                $count++;
            }
        }
        
        return $count;
    }
    
    /**
     * Get pending scheduled notifications that should be sent now.
     */
    public function processScheduledNotifications()
    {
        $logs = NotificationLog::scheduledNow()->get();
        $count = 0;
        
        foreach ($logs as $log) {
            Queue::push(new \Modules\Notification\Jobs\SendScheduledNotification(
                $log->notifiable, 
                unserialize($log->data['notification_serialized']), 
                $log->data['channels'], 
                $log
            ), [], config('notification.queue.default'));
            
            $count++;
        }
        
        return $count;
    }
} 