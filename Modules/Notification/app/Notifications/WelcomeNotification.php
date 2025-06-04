<?php

namespace Modules\Notification\Notifications;

class WelcomeNotification extends BaseNotification
{
    /**
     * Get the default channels for this notification.
     *
     * @return array
     */
    protected function getDefaultChannels(): array
    {
        return ['database', 'sms', 'whatsapp', 'telegram'];
    }
    
    /**
     * Get the notification title.
     *
     * @param mixed $notifiable
     * @return string
     */
    public function getTitle($notifiable): string
    {
        return 'Welcome to ' . config('app.name');
    }
    
    /**
     * Get the notification message.
     *
     * @param mixed $notifiable
     * @return string
     */
    public function getMessage($notifiable): string
    {
        $name = $notifiable->name ?? 'there';
        return "Hello {$name}! Welcome to our platform. We're glad to have you on board.";
    }
    
    /**
     * Get the notification icon.
     *
     * @param mixed $notifiable
     * @return string|null
     */
    public function getIcon($notifiable): ?string
    {
        return 'fas fa-user-plus';
    }
    
    /**
     * Get the notification action URL.
     *
     * @param mixed $notifiable
     * @return string|null
     */
    public function getActionUrl($notifiable): ?string
    {
        return url('/dashboard');
    }
    
    /**
     * Get the notification actions.
     *
     * @param mixed $notifiable
     * @return array|null
     */
    public function getActions($notifiable): ?array
    {
        return [
            [
                'label' => 'Complete Profile',
                'url' => url('/profile'),
                'type' => 'primary',
            ],
            [
                'label' => 'Explore Platform',
                'url' => url('/dashboard'),
                'type' => 'secondary',
            ],
        ];
    }
    
    /**
     * Get WhatsApp specific content.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toWhatsApp($notifiable): array
    {
        $name = $notifiable->name ?? 'there';
        
        return [
            'text' => "Hello {$name}! Welcome to " . config('app.name') . ". We're excited to have you join us. You can visit " . url('/dashboard') . " to get started.",
        ];
    }
    
    /**
     * Get SMS specific content.
     *
     * @param mixed $notifiable
     * @return string
     */
    public function toSms($notifiable): string
    {
        $name = $notifiable->name ?? 'there';
        return "Hello {$name}! Welcome to " . config('app.name') . ". We're excited to have you join us.";
    }
    
    /**
     * Get Telegram specific content.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toTelegram($notifiable): array
    {
        $name = $notifiable->name ?? 'there';
        $message = "Hello {$name}! Welcome to " . config('app.name') . ". We're excited to have you join us.";
        
        return [
            'text' => $message,
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Complete Profile',
                            'url' => url('/profile'),
                        ],
                    ],
                    [
                        [
                            'text' => 'Explore Platform',
                            'url' => url('/dashboard'),
                        ],
                    ],
                ],
            ],
        ];
    }
} 