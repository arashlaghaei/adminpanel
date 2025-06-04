<?php

namespace Modules\Notification\Channels;

use Illuminate\Notifications\Notification;
use Modules\Notification\Models\NotificationLog;
use Illuminate\Support\Facades\Http;

class SmsChannel extends AbstractChannel
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
        
        $message = $this->getMessage($notifiable, $notification);
        
        // Prepare the API call to Kavenegar
        $apiKey = config('notification.sms.api_key');
        $sender = config('notification.sms.sender');
        
        // Normalize phone number (remove leading zero, add country code if needed)
        $phoneNumber = $this->normalizePhoneNumber($phoneNumber);

        \Log::debug('📲 SMS Sending', [
            'phone' => $phoneNumber,
            'message' => $message
        ]);
        try {
            // Make the API call
            $response = Http::asForm()->post("https://api.kavenegar.com/v1/{$apiKey}/sms/send.json", [
                'receptor' => $phoneNumber,
//                'sender' => '10004346',
                'message' => $message,
            ]);

            
            $responseData = $response->json();
            
            // Update log with response data
            $log->data = array_merge($log->data, [
                'phone_number' => $phoneNumber,
                'message' => $message,
                'response' => $responseData,
            ]);
            
            if (!$response->successful() || ($responseData['return']['status'] ?? 0) != 200) {
                $errorMessage = $responseData['return']['message'] ?? 'Unknown error';
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
        if (method_exists($notifiable, 'routeNotificationForSms')) {
            return $notifiable->routeNotificationForSms();
        }
        
        if (method_exists($notifiable, 'routeNotificationForKavenegar')) {
            return $notifiable->routeNotificationForKavenegar();
        }
        
        // Try common attribute names for phone number
        foreach ([ 'mobile', 'mobile_number', 'cellphone','phone_number', 'phone',] as $attribute) {
            if (isset($notifiable->{$attribute})) {
                return $notifiable->{$attribute};
            }
        }
        
        return null;
    }
    
    /**
     * Get the SMS message.
     */
    protected function getMessage($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toSms')) {
            return $notification->toSms($notifiable);
        }
        
        if (method_exists($notification, 'toKavenegar')) {
            return $notification->toKavenegar($notifiable);
        }
        
        if (method_exists($notification, 'getMessage')) {
            return $notification->getMessage($notifiable);
        }
        
        // Default to a generic message if no specific SMS content is defined
        return 'You have a new notification.';
    }
    
    /**
     * Normalize the phone number for SMS delivery.
     */
    protected function normalizePhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Remove leading zero if present
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }
        
        // Add Iran country code if needed (assuming Iranian numbers by default)
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
        return 'sms';
    }
} 