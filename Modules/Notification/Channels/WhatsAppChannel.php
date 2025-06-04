<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;
use Illuminate\Support\Facades\Http;

class WhatsAppChannel extends AbstractChannel
{
    /**
     * Send the given notification.
     */
    protected function sendNotification($notifiable, Notification $notification, NotificationLog $log)
    {
        $phoneNumber = $this->getRecipientPhoneNumber($notifiable);
        
        if (!$phoneNumber) {
            $log->markAsFailed('No phone number provided');
            return null;
        }
        
        // Get message content
        $content = $this->getContent($notifiable, $notification);
        
        // Get provider-specific configuration
        $provider = config('notification.whatsapp.provider', '360dialog');
        
        if ($provider === '360dialog') {
            return $this->send360Dialog($phoneNumber, $content, $notification, $log);
        } else if ($provider === 'wablas') {
            return $this->sendWablas($phoneNumber, $content, $notification, $log);
        } else {
            $log->markAsFailed("Unsupported WhatsApp provider: {$provider}");
            return false;
        }
    }
    
    /**
     * Send notification via 360Dialog API.
     */
    protected function send360Dialog($phoneNumber, $content, $notification, $log)
    {
        $apiKey = config('notification.whatsapp.api_key');
        $phoneNumberId = config('notification.whatsapp.phone_number_id');
        
        // Normalize phone number for WhatsApp
        $phoneNumber = $this->normalizePhoneNumber($phoneNumber);
        
        try {
            // Construct the message based on type
            $messageData = [];
            
            if (isset($content['template'])) {
                // Template message
                $messageData = [
                    'messaging_product' => 'whatsapp',
                    'to' => $phoneNumber,
                    'type' => 'template',
                    'template' => $content['template'],
                ];
            } else if (isset($content['text'])) {
                // Text message
                $messageData = [
                    'messaging_product' => 'whatsapp',
                    'to' => $phoneNumber,
                    'type' => 'text',
                    'text' => [
                        'body' => $content['text'],
                    ],
                ];
            } else if (isset($content['media'])) {
                // Media message (image, document, etc.)
                $messageData = [
                    'messaging_product' => 'whatsapp',
                    'to' => $phoneNumber,
                    'type' => $content['media']['type'],
                    $content['media']['type'] => [
                        'link' => $content['media']['url'],
                        'caption' => $content['media']['caption'] ?? null,
                    ],
                ];
            }
            
            // Make the API call
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post("https://graph.facebook.com/v17.0/{$phoneNumberId}/messages", $messageData);
            
            $responseData = $response->json();
            
            // Update log with response data
            $log->data = array_merge($log->data, [
                'phone_number' => $phoneNumber,
                'content' => $content,
                'response' => $responseData,
            ]);
            
            if (!$response->successful()) {
                $errorMessage = $responseData['error']['message'] ?? 'Unknown error';
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
     * Send notification via Wablas API.
     */
    protected function sendWablas($phoneNumber, $content, $notification, $log)
    {
        $apiKey = config('notification.whatsapp.api_key');
        
        // Normalize phone number for WhatsApp
        $phoneNumber = $this->normalizePhoneNumber($phoneNumber);
        
        try {
            $url = 'https://wablas.com/api/send-message';
            $payload = [];
            
            if (isset($content['text'])) {
                $url = 'https://wablas.com/api/send-message';
                $payload = [
                    'phone' => $phoneNumber,
                    'message' => $content['text'],
                ];
            } else if (isset($content['media'])) {
                $url = 'https://wablas.com/api/send-image';
                if ($content['media']['type'] === 'image') {
                    $payload = [
                        'phone' => $phoneNumber,
                        'image' => $content['media']['url'],
                        'caption' => $content['media']['caption'] ?? '',
                    ];
                } else if ($content['media']['type'] === 'document') {
                    $url = 'https://wablas.com/api/send-document';
                    $payload = [
                        'phone' => $phoneNumber,
                        'document' => $content['media']['url'],
                        'caption' => $content['media']['caption'] ?? '',
                    ];
                }
            }
            
            // Make the API call
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->post($url, $payload);
            
            $responseData = $response->json();
            
            // Update log with response data
            $log->data = array_merge($log->data, [
                'phone_number' => $phoneNumber,
                'content' => $content,
                'response' => $responseData,
            ]);
            
            if (!$response->successful() || $responseData['status'] !== true) {
                $errorMessage = $responseData['message'] ?? 'Unknown error';
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
     * Get the recipient's phone number.
     */
    protected function getRecipientPhoneNumber($notifiable)
    {
        if (method_exists($notifiable, 'routeNotificationForWhatsApp')) {
            return $notifiable->routeNotificationForWhatsApp();
        }
        
        // Try common attribute names for phone number
        foreach (['whatsapp_number', 'phone_number', 'phone', 'mobile', 'mobile_number', 'cellphone'] as $attribute) {
            if (isset($notifiable->{$attribute})) {
                return $notifiable->{$attribute};
            }
        }
        
        return null;
    }
    
    /**
     * Get the content for WhatsApp.
     */
    protected function getContent($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toWhatsApp')) {
            return $notification->toWhatsApp($notifiable);
        }
        
        // If no specific WhatsApp content is provided, try to get a simple text message
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
     * Normalize the phone number for WhatsApp delivery.
     */
    protected function normalizePhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Remove leading zero if present
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }
        
        // Add country code if needed (assuming Iranian numbers by default)
        if (strlen($phoneNumber) === 10) {
            $phoneNumber = '98' . $phoneNumber;
        }
        
        return $phoneNumber;
    }
    
    /**
     * Get the name of this channel.
     */
    public function getName(): string
    {
        return 'whatsapp';
    }
} 