<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;
use Illuminate\Support\Facades\Http;

class SlackChannel extends AbstractChannel
{
    /**
     * Send the given notification.
     */
    protected function sendNotification($notifiable, Notification $notification, NotificationLog $log)
    {
        // Get webhook URL
        $webhookUrl = $this->getWebhookUrl($notifiable);
        
        if (!$webhookUrl) {
            $log->markAsFailed('No Slack webhook URL provided');
            return null;
        }
        
        // Get message content
        $content = $this->getContent($notifiable, $notification);
        
        try {
            // Send the message to Slack
            $response = Http::post($webhookUrl, $content);
            
            // Update log with response data (exclude webhook URL for security)
            $logData = $log->data;
            $logData['content'] = $content;
            $logData['response_status'] = $response->status();
            $logData['response_body'] = $response->body();
            $log->data = $logData;
            
            if (!$response->successful()) {
                $log->markAsFailed('Failed to send Slack notification: ' . $response->body());
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
        if (method_exists($notifiable, 'routeNotificationForSlack')) {
            return $notifiable->routeNotificationForSlack();
        }
        
        // Use default from config
        return config('notification.slack.webhook_url');
    }
    
    /**
     * Get the content for Slack.
     */
    protected function getContent($notifiable, Notification $notification)
    {
        // If the notification has a toSlack method, use it
        if (method_exists($notification, 'toSlack')) {
            return $notification->toSlack($notifiable);
        }
        
        // Default content structure for Slack
        $content = [
            'text' => method_exists($notification, 'getTitle') ? $notification->getTitle($notifiable) : 'New Notification',
        ];
        
        // Add blocks if message is available
        if (method_exists($notification, 'getMessage')) {
            $content['blocks'] = [
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'mrkdwn',
                        'text' => $notification->getMessage($notifiable),
                    ],
                ],
            ];
        }
        
        // Add actions if available
        if (method_exists($notification, 'getActions')) {
            $actions = $notification->getActions($notifiable);
            
            if (!empty($actions)) {
                $actionElements = [];
                
                foreach ($actions as $action) {
                    $actionElements[] = [
                        'type' => 'button',
                        'text' => [
                            'type' => 'plain_text',
                            'text' => $action['label'],
                        ],
                        'url' => $action['url'],
                    ];
                }
                
                $content['blocks'][] = [
                    'type' => 'actions',
                    'elements' => $actionElements,
                ];
            }
        }
        
        // Add username and icon if configured
        $username = config('notification.slack.username');
        $icon = config('notification.slack.icon');
        
        if ($username) {
            $content['username'] = $username;
        }
        
        if ($icon) {
            if (strpos($icon, ':') === 0) {
                $content['icon_emoji'] = $icon;
            } else {
                $content['icon_url'] = $icon;
            }
        }
        
        // Add channel if configured
        $channel = config('notification.slack.channel');
        if ($channel) {
            $content['channel'] = $channel;
        }
        
        return $content;
    }
    
    /**
     * Get the name of this channel.
     */
    public function getName(): string
    {
        return 'slack';
    }
} 