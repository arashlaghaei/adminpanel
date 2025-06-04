<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;
use Illuminate\Support\Facades\Http;

class DiscordChannel extends AbstractChannel
{
    /**
     * Send the given notification.
     */
    protected function sendNotification($notifiable, Notification $notification, NotificationLog $log)
    {
        // Get webhook URL
        $webhookUrl = $this->getWebhookUrl($notifiable);
        
        if (!$webhookUrl) {
            $log->markAsFailed('No Discord webhook URL provided');
            return null;
        }
        
        // Get message content
        $content = $this->getContent($notifiable, $notification);
        
        try {
            // Send the message to Discord
            $response = Http::post($webhookUrl, $content);
            
            // Update log with response data (exclude webhook URL for security)
            $logData = $log->data;
            $logData['content'] = $content;
            $logData['response_status'] = $response->status();
            $logData['response_body'] = $response->body();
            $log->data = $logData;
            
            if (!$response->successful()) {
                $log->markAsFailed('Failed to send Discord notification: ' . $response->body());
                return false;
            }
            
            return true;
        } catch (\Exception $e) {
            $log->markAsFailed($e->getMessage());
            return false;
        }
    }
    
    /**
     * Get the webhook URL.
     */
    protected function getWebhookUrl($notifiable)
    {
        if (method_exists($notifiable, 'routeNotificationForDiscord')) {
            return $notifiable->routeNotificationForDiscord();
        }
        
        // Use default from config
        return config('notification.discord.webhook_url');
    }
    
    /**
     * Get the content for Discord.
     */
    protected function getContent($notifiable, Notification $notification)
    {
        // If the notification has a toDiscord method, use it
        if (method_exists($notification, 'toDiscord')) {
            return $notification->toDiscord($notifiable);
        }
        
        // Build a Discord embed
        $embed = [
            'title' => method_exists($notification, 'getTitle') ? $notification->getTitle($notifiable) : 'New Notification',
            'description' => method_exists($notification, 'getMessage') ? $notification->getMessage($notifiable) : 'You have a new notification.',
            'color' => method_exists($notification, 'getColor') ? $notification->getColor($notifiable) : 7506394, // Default to blue
            'timestamp' => now()->toIso8601String(),
        ];
        
        // Add footer
        $embed['footer'] = [
            'text' => config('app.name', 'Laravel'),
        ];
        
        // Add URL if present
        if (method_exists($notification, 'getActionUrl')) {
            $embed['url'] = $notification->getActionUrl($notifiable);
        }
        
        // Add thumbnail if present
        if (method_exists($notification, 'getIcon')) {
            $embed['thumbnail'] = [
                'url' => $notification->getIcon($notifiable),
            ];
        }
        
        // Add fields if present
        if (method_exists($notification, 'getFields')) {
            $embed['fields'] = $notification->getFields($notifiable);
        }
        
        // Build the final payload
        $content = [
            'embeds' => [$embed],
        ];
        
        // Add username if configured
        $username = config('notification.discord.username');
        if ($username) {
            $content['username'] = $username;
        }
        
        return $content;
    }
    
    /**
     * Get the name of this channel.
     */
    public function getName(): string
    {
        return 'discord';
    }
} 