<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;
use Modules\Notification\Models\NotificationRateLimit;

abstract class AbstractChannel implements ChannelInterface
{
    /**
     * Send the notification through the channel.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return mixed
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$this->isAvailable($notifiable, $notification)) {
            return null;
        }
        
        // Check rate limits
        if ($this->isRateLimited($notifiable, $notification)) {
            return null;
        }
        
        // Create or get notification log
        $notificationType = method_exists($notification, 'getType') ? $notification->getType() : get_class($notification);
        $notificationLog = NotificationLog::create([
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->getKey(),
            'notification_type' => $notificationType,
            'channel' => $this->getName(),
            'data' => $this->getNotificationData($notifiable, $notification),
            'status' => NotificationLog::STATUS_PENDING,
        ]);
        
        try {
            // Actual implementation of sending notification
            $result = $this->sendNotification($notifiable, $notification, $notificationLog);
            
            // Record success
            $notificationLog->markAsSent();
            
            // Increment rate limit counter
            NotificationRateLimit::incrementRate($notifiable, $notificationType, $this->getName());
            
            return $result;
        } catch (\Exception $e) {
            // Record failure
            $notificationLog->markAsFailed($e->getMessage());
            
            // Re-throw or handle error as needed
            if (config('app.debug')) {
                throw $e;
            }
            
            return false;
        }
    }
    
    /**
     * The actual implementation of sending the notification.
     * This should be implemented by subclasses.
     */
    abstract protected function sendNotification($notifiable, Notification $notification, NotificationLog $log);
    
    /**
     * Get notification data for logging.
     */
    protected function getNotificationData($notifiable, Notification $notification): array
    {
        return [
            'notification_class' => get_class($notification),
            'notification_id' => method_exists($notification, 'id') ? $notification->id : null,
            'channel' => $this->getName(),
            'timestamp' => now()->timestamp,
        ];
    }
    
    /**
     * Check if the channel is available/enabled for a notifiable entity.
     */
    public function isAvailable($notifiable, Notification $notification): bool
    {
        // Check if the channel is enabled in config
        if (!config('notification.channels.' . $this->getName(), false)) {
            return false;
        }
        
        // Check user preferences if the notifiable entity has them
        if (method_exists($notifiable, 'getNotificationPreference')) {
            $preference = $notifiable->getNotificationPreference(
                method_exists($notification, 'getType') ? $notification->getType() : get_class($notification)
            );
            
            if ($preference && !$preference->isEnabledForChannel($this->getName())) {
                return false;
            }
        }
        
        // Check if notification should use this channel
        if (method_exists($notification, 'shouldSendOn')) {
            return $notification->shouldSendOn($this->getName(), $notifiable);
        }
        
        // Check if notification has via method
        if (method_exists($notification, 'via')) {
            $channels = $notification->via($notifiable);
            return in_array($this->getName(), $channels);
        }
        
        return true;
    }
    
    /**
     * Check if sending notification exceeds rate limits.
     */
    protected function isRateLimited($notifiable, Notification $notification): bool
    {
        $notificationType = method_exists($notification, 'getType') ? $notification->getType() : get_class($notification);
        
        return NotificationRateLimit::hasReachedLimit($notifiable, $notificationType, $this->getName());
    }
} 