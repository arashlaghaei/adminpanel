<?php

namespace Modules\Notification\Notifications;

use Modules\Notification\Models\NotificationTemplate;

class TemplateNotification extends BaseNotification
{
    /**
     * The notification template.
     */
    protected $template;
    
    /**
     * Any additional data to be used in the template.
     */
    protected $data;
    
    /**
     * Create a new notification instance.
     */
    public function __construct(NotificationTemplate $template, array $data = [])
    {
        parent::__construct();
        $this->template = $template;
        $this->data = $data;
    }
    
    /**
     * Get the notification type.
     */
    public function getType(): string
    {
        return $this->template->notification_type;
    }
    
    /**
     * Get the default channels for this notification.
     */
    protected function getDefaultChannels(): array
    {
        return $this->template->channels;
    }
    
    /**
     * Get the notification title.
     */
    public function getTitle($notifiable): string
    {
        $title = $this->template->getContent('database', app()->getLocale());
        
        if (!$title) {
            return $this->template->name;
        }
        
        // Replace variables in the title
        return $this->replaceVariables($title, $notifiable);
    }
    
    /**
     * Get the notification message.
     */
    public function getMessage($notifiable): string
    {
        $message = $this->template->getContent('database', app()->getLocale());
        
        if (!$message) {
            return 'You have a new notification';
        }
        
        // Replace variables in the message
        return $this->replaceVariables($message, $notifiable);
    }
    
    /**
     * Get the notification actions.
     */
    public function getActions($notifiable): ?array
    {
        $actions = $this->template->getActions('database', app()->getLocale());
        
        if (!$actions) {
            return null;
        }
        
        // Process each action to replace variables in URLs and labels
        foreach ($actions as &$action) {
            if (isset($action['label'])) {
                $action['label'] = $this->replaceVariables($action['label'], $notifiable);
            }
            
            if (isset($action['url'])) {
                $action['url'] = $this->replaceVariables($action['url'], $notifiable);
            }
        }
        
        return $actions;
    }
    
    /**
     * Get WhatsApp specific content.
     */
    public function toWhatsApp($notifiable): array
    {
        $content = $this->template->getContent('whatsapp', app()->getLocale());
        
        if (!$content) {
            return [
                'text' => $this->getMessage($notifiable),
            ];
        }
        
        // Replace variables in the content
        $content = $this->replaceVariables($content, $notifiable);
        
        return [
            'text' => $content,
        ];
    }
    
    /**
     * Get SMS specific content.
     */
    public function toSms($notifiable): string
    {
        $content = $this->template->getContent('sms', app()->getLocale());
        
        if (!$content) {
            return $this->getMessage($notifiable);
        }
        
        // Replace variables in the content
        return $this->replaceVariables($content, $notifiable);
    }
    
    /**
     * Get Telegram specific content.
     */
    public function toTelegram($notifiable): array
    {
        $content = $this->template->getContent('telegram', app()->getLocale());
        
        if (!$content) {
            $content = $this->getMessage($notifiable);
        } else {
            $content = $this->replaceVariables($content, $notifiable);
        }
        
        $actions = $this->getActions($notifiable);
        $buttons = [];
        
        if ($actions) {
            foreach ($actions as $action) {
                $buttons[] = [
                    [
                        'text' => $action['label'],
                        'url' => $action['url'],
                    ],
                ];
            }
        }
        
        return [
            'text' => $content,
            'reply_markup' => !empty($buttons) ? [
                'inline_keyboard' => $buttons,
            ] : null,
        ];
    }
    
    /**
     * Replace variables in a string with values from the notifiable and additional data.
     */
    protected function replaceVariables(string $text, $notifiable): string
    {
        // Replace notifiable attributes (e.g., {name}, {email})
        foreach (get_object_vars($notifiable) as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $text = str_replace('{' . $key . '}', $value, $text);
            }
        }
        
        // Replace additional data variables
        foreach ($this->data as $key => $value) {
            if (is_string($value) || is_numeric($value)) {
                $text = str_replace('{' . $key . '}', $value, $text);
            }
        }
        
        // Replace common variables
        $text = str_replace('{app_name}', config('app.name'), $text);
        $text = str_replace('{date}', now()->format('Y-m-d'), $text);
        $text = str_replace('{time}', now()->format('H:i'), $text);
        
        return $text;
    }
} 