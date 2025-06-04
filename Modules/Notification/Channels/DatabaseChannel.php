<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;

class DatabaseChannel extends AbstractChannel
{
    /**
     * Send the given notification.
     */
    protected function sendNotification($notifiable, Notification $notification, NotificationLog $log)
    {
        $data = $this->getData($notifiable, $notification);
        
        // Update the log data with the actual notification content
        $log->data = array_merge($log->data, $data);
        $log->save();
        
        // If Laravel's native database notifications are used as well
        if (method_exists($notification, 'toDatabase')) {
            return NotificationLog::create([
                'notifiable_type' => get_class($notifiable),
                'notifiable_id'   => $notifiable->getKey(),
                'notification_type' => $notification->getType(),
                'channel' => 'database',
                'data' => $data,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
            return $notifiable->routeNotificationFor('database', $notification)
                ->create([
                    'id' => $notification->id ?? $log->id,
                    'type' => get_class($notification),
                    'data' => $data,
                    'read_at' => null,
                ]);
        }
        
        return $log;
    }
    
    /**
     * Get the data for the notification.
     */
    protected function getData($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toDatabase')) {
            return $notification->toDatabase($notifiable);
        }
        
        if (method_exists($notification, 'toArray')) {
            return $notification->toArray($notifiable);
        }
        
        // Default data structure if no specific method exists
        return [
            'title' => method_exists($notification, 'getTitle') ? $notification->getTitle($notifiable) : 'Notification',
            'message' => method_exists($notification, 'getMessage') ? $notification->getMessage($notifiable) : null,
            'icon' => method_exists($notification, 'getIcon') ? $notification->getIcon($notifiable) : null,
            'action_url' => method_exists($notification, 'getActionUrl') ? $notification->getActionUrl($notifiable) : null,
            'created_at' => now()->toIso8601String(),
        ];
    }
    
    /**
     * Get the name of this channel.
     */
    public function getName(): string
    {
        return 'database';
    }
} 