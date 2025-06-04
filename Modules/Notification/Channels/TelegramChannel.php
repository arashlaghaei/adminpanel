<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;
use Illuminate\Support\Facades\Http;

class TelegramChannel extends AbstractChannel
{
    /**
     * Send the given notification.
     */
    protected function sendNotification($notifiable, Notification $notification, NotificationLog $log)
    {
        $chatId = $this->getRecipientChatId($notifiable);
        
        if (!$chatId) {
            $log->markAsFailed('No Telegram chat ID provided');
            return null;
        }
        
        // Get message content
        $content = $this->getContent($notifiable, $notification);
        
        // Get token from config
        $botToken = config('notification.telegram.bot_token');
        $parseMode = config('notification.telegram.default_parse_mode', 'HTML');
        
        try {
            $response = null;
            $method = 'sendMessage';
            $payload = [
                'chat_id' => $chatId,
                'parse_mode' => $parseMode,
            ];
            
            // Determine the type of content and add appropriate parameters
            if (isset($content['text'])) {
                $payload['text'] = $content['text'];
            } else if (isset($content['photo'])) {
                $method = 'sendPhoto';
                $payload['photo'] = $content['photo'];
                
                if (isset($content['caption'])) {
                    $payload['caption'] = $content['caption'];
                }
            } else if (isset($content['document'])) {
                $method = 'sendDocument';
                $payload['document'] = $content['document'];
                
                if (isset($content['caption'])) {
                    $payload['caption'] = $content['caption'];
                }
            } else if (isset($content['audio'])) {
                $method = 'sendAudio';
                $payload['audio'] = $content['audio'];
                
                if (isset($content['caption'])) {
                    $payload['caption'] = $content['caption'];
                }
            }
            
            // Add reply markup if present (buttons, keyboard, etc.)
            if (isset($content['reply_markup'])) {
                $payload['reply_markup'] = json_encode($content['reply_markup']);
            }
            
            // Send the message
            $response = Http::post("https://api.telegram.org/bot{$botToken}/{$method}", $payload);
            
            $responseData = $response->json();
            
            // Update log with response data
            $log->data = array_merge($log->data, [
                'chat_id' => $chatId,
                'content' => $content,
                'response' => $responseData,
            ]);
            
            if (!$response->successful() || !($responseData['ok'] ?? false)) {
                $errorMessage = $responseData['description'] ?? 'Unknown error';
                $log->markAsFailed($errorMessage);
                return false;
            }
            
            return true;
        } catch (\Exception $e) {
            $log->markAsFailed($e->getMessage());
            return false;
        }
    }
    
    /**
     * Get the recipient's Telegram chat ID.
     */
    protected function getRecipientChatId($notifiable)
    {
        if (method_exists($notifiable, 'routeNotificationForTelegram')) {
            return $notifiable->routeNotificationForTelegram();
        }
        
        // Try common attribute names for Telegram chat ID
        foreach (['telegram_chat_id', 'telegram_id', 'chat_id'] as $attribute) {
            if (isset($notifiable->{$attribute})) {
                return $notifiable->{$attribute};
            }
        }
        
        return null;
    }
    
    /**
     * Get the content for Telegram.
     */
    protected function getContent($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toTelegram')) {
            return $notification->toTelegram($notifiable);
        }
        
        // If no specific Telegram content is provided, try to get a simple text message
        if (method_exists($notification, 'getMessage')) {
            return [
                'text' => $notification->getMessage($notifiable),
            ];
        }
        
        // Default content
        return [
            'text' => 'You have a new notification.',
        ];
    }
    
    /**
     * Get the name of this channel.
     */
    public function getName(): string
    {
        return 'telegram';
    }
} 