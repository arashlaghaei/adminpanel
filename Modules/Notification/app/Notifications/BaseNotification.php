<?php

namespace Modules\Notification\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

abstract class BaseNotification extends Notification
{
    /**
     * Notification unique ID.
     */
    public $id;
    
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->id = (string) Str::uuid();
    }
    
    /**
     * Get the notification's delivery channels based on user preferences.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // If the notifiable has preferences, use them
        if (method_exists($notifiable, 'getNotificationPreference')) {
            $preference = $notifiable->getNotificationPreference($this->getType());
            
            if ($preference && !empty($preference->channels)) {
                return $preference->channels;
            }
        }
        
        // Otherwise, use default channels
        return $this->getDefaultChannels();
    }
    
    /**
     * Get the notification type.
     *
     * @return string
     */
    public function getType(): string
    {
        return class_basename(static::class);
    }
    
    /**
     * Get the fallback channels to try if the primary channel fails.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function getFallbackChannels($notifiable): array
    {
        return config('notification.fallback_order', ['sms', 'whatsapp', 'mail', 'database']);
    }
    
    /**
     * Get the default channels for this notification.
     *
     * @return array
     */
    abstract protected function getDefaultChannels(): array;
    
    /**
     * Get the notification title.
     *
     * @param mixed $notifiable
     * @return string
     */
    abstract public function getTitle($notifiable): string;
    
    /**
     * Get the notification message.
     *
     * @param mixed $notifiable
     * @return string
     */
    abstract public function getMessage($notifiable): string;
    
    /**
     * Get the notification icon URL or class.
     *
     * @param mixed $notifiable
     * @return string|null
     */
    public function getIcon($notifiable): ?string
    {
        return null;
    }
    
    /**
     * Get the notification action URL.
     *
     * @param mixed $notifiable
     * @return string|null
     */
    public function getActionUrl($notifiable): ?string
    {
        return null;
    }
    
    /**
     * Get the notification actions (buttons, links, etc.).
     *
     * @param mixed $notifiable
     * @return array|null
     */
    public function getActions($notifiable): ?array
    {
        return null;
    }
    
    /**
     * Check if notification should be sent to a specific user role.
     *
     * @param mixed $notifiable
     * @return bool
     */
    public function shouldSendToRole($notifiable): bool
    {
        // By default, send to all roles
        return true;
    }
    
    /**
     * Get array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'type' => $this->getType(),
            'title' => $this->getTitle($notifiable),
            'message' => $this->getMessage($notifiable),
            'icon' => $this->getIcon($notifiable),
            'action_url' => $this->getActionUrl($notifiable),
            'actions' => $this->getActions($notifiable),
            'created_at' => now()->toIso8601String(),
        ];
    }
    
    /**
     * Get database representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return $this->toArray($notifiable);
    }
    
    /**
     * Check if notification should be sent on a specific channel.
     *
     * @param string $channel
     * @param mixed $notifiable
     * @return bool
     */
    public function shouldSendOn($channel, $notifiable): bool
    {
        // Allow sending on any channel by default
        return true;
    }
} 