<?php

return [
    'name' => 'Notification',
    
    // Configure which notification channels are enabled
    'channels' => [
        'database' => true,  // Internal notifications
        'mail' => true,      // Email notifications
        'sms' => true,       // SMS notifications (Kavenegar)
        'whatsapp' => true,  // WhatsApp notifications (360Dialog or Wablas)
        'telegram' => true,  // Telegram notifications (Bot API)
        'slack' => true,     // Slack notifications
        'discord' => false,  // Discord notifications (optional)
    ],
    
    // Fallback order for notification channels
    'fallback_order' => ['sms', 'whatsapp', 'mail', 'database'],
    
    // Channel configurations
    'mail' => [
        'from_address' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
        'from_name' => env('MAIL_FROM_NAME', 'Notification System'),
    ],
    
    'sms' => [
        'provider' => 'kavenegar',
        'api_key' => '71526165364463524A70567648616D6F616A4D4F51773D3D',
        'sender' => env('KAVENEGAR_SENDER'),
        'template_verify' => env('KAVENEGAR_TEMPLATE_VERIFY', 'verify'),
    ],
    
    'whatsapp' => [
        'provider' => '360dialog', // Options: 360dialog, wablas
        'api_key' => env('WHATSAPP_API_KEY'),
        'business_account_id' => env('WHATSAPP_BUSINESS_ACCOUNT_ID'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
    ],
    
    'telegram' => [
        'bot_token' => '8075048094:AAGow42esrfppSlshy0ZbPqXMiJo1Cce60I',
        'default_parse_mode' => 'HTML', // HTML or Markdown
    ],
    
    'slack' => [
        'webhook_url' => env('SLACK_WEBHOOK_URL'),
        'channel' => env('SLACK_CHANNEL', '#general'),
        'username' => env('SLACK_USERNAME', 'Notification Bot'),
        'icon' => env('SLACK_ICON', ':bell:'),
    ],
    
    'discord' => [
        'webhook_url' => env('DISCORD_WEBHOOK_URL'),
        'username' => env('DISCORD_USERNAME', 'Notification Bot'),
    ],

    // Rate limiting settings: max notifications per type per user per day
    'rate_limits' => [
        'default' => 10, // Default maximum notifications per day
        'types' => [
            'order_confirmation' => 5,
            'payment_reminder' => 3,
            // Add more types as needed
        ],
    ],
    
    // Retry settings for failed notifications
    'retry' => [
        'max_attempts' => 3,         // Maximum retry attempts
        'delay_minutes' => 10,       // Delay between retries in minutes
        'backoff_multiplier' => 2,   // Multiply delay by this factor for each retry
    ],
    
    // Database queue configuration
    'queue' => [
        'default' => env('NOTIFICATION_QUEUE', 'notifications'),
        'priority' => [
            'high' => 'notifications-high',
            'medium' => 'notifications-medium',
            'low' => 'notifications-low',
        ],
    ],
];
