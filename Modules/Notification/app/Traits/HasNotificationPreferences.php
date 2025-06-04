<?php

namespace Modules\Notification\Traits;

use Modules\Notification\Models\NotificationPreference;
use Modules\Notification\Models\NotificationLog;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNotificationPreferences
{
    /**
     * Get all notification preferences for the user.
     */
    public function notificationPreferences(): HasMany
    {
        return $this->hasMany(NotificationPreference::class, 'user_id');
    }
    
    /**
     * Get notification logs for the user.
     */
    public function notificationLogs()
    {
        return NotificationLog::where('notifiable_type', get_class($this))
            ->where('notifiable_id', $this->getKey());
    }
    
    /**
     * Get notification preference for a specific notification type.
     *
     * @param string $notificationType
     * @return NotificationPreference|null
     */
    public function getNotificationPreference(string $notificationType): ?NotificationPreference
    {
        return $this->notificationPreferences()
            ->where('notification_type', $notificationType)
            ->first();
    }
    
    /**
     * Check if notifications of a specific type are enabled.
     *
     * @param string $notificationType
     * @return bool
     */
    public function isNotificationEnabled(string $notificationType): bool
    {
        $preference = $this->getNotificationPreference($notificationType);
        
        return $preference ? $preference->is_enabled : true;
    }
    
    /**
     * Get the preferred channels for a notification type.
     *
     * @param string $notificationType
     * @return array
     */
    public function getPreferredChannels(string $notificationType): array
    {
        $preference = $this->getNotificationPreference($notificationType);
        
        if ($preference && !empty($preference->channels)) {
            return $preference->channels;
        }
        
        // Return default channels from config if no preference is set
        return array_keys(array_filter(config('notification.channels')));
    }
    
    /**
     * Set notification preference for a specific type.
     *
     * @param string $notificationType
     * @param array $channels
     * @param bool $isEnabled
     * @return NotificationPreference
     */
    public function setNotificationPreference(string $notificationType, array $channels, bool $isEnabled = true): NotificationPreference
    {
        return NotificationPreference::updateOrCreate(
            [
                'user_id' => $this->getKey(),
                'notification_type' => $notificationType,
            ],
            [
                'channels' => $channels,
                'is_enabled' => $isEnabled,
            ]
        );
    }
    
    /**
     * Get unread notifications count.
     *
     * @return int
     */
    public function getUnreadNotificationsCount(): int
    {
        return $this->notificationLogs()
            ->whereNull('read_at')
            ->count();
    }
    
    /**
     * Get the routing information for the given driver.
     *
     * @param string $driver
     * @param \Illuminate\Notifications\Notification|null $notification
     * @return mixed
     */
    public function routeNotificationFor($driver, $notification = null)
    {
        if (method_exists($this, $method = 'routeNotificationFor'.ucfirst($driver))) {
            return $this->{$method}($notification);
        }
        
        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->email;
            case 'sms':
            case 'whatsapp':
                return $this->phone_number ?? $this->phone ?? $this->mobile;
        }
        
        return null;
    }
} 