# Notification Module

This module provides a comprehensive notification system with multiple channels, user preferences, and admin management.

## Features

- Multiple notification channels: Database, Email, SMS, WhatsApp, Telegram, Slack, Discord
- Channel fallback chains
- User notification preferences
- Role-based notification filtering
- Scheduled/delayed notifications
- Notification logging
- Testing system for administrators
- Multi-language support
- Action buttons in notifications
- Targeted/group notifications
- Automatic retry for failed notifications
- Rate limiting

## Installation

1. Make sure the module is installed in the Modules directory
2. Add the Notification module to the modules config file
3. Publish the module's configuration file:
   ```
   php artisan module:publish-config Notification
   ```
4. Run the migrations:
   ```
   php artisan module:migrate Notification
   ```

## Usage

### Add the notification trait to User model

To enable notification preferences for users, add the `HasNotificationPreferences` trait to your User model:

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Notification\app\Traits\HasNotificationPreferences;

class User extends Authenticatable
{
    use HasNotificationPreferences;
    
    // Your model code...
}
```

### Add the notification widget to the layout

To display notifications in your Metronic admin panel, include the notification widget in your master layout:

```php
@include('notification::components.register')
```

### Sending notifications

You can use the NotificationService to send notifications:

```php
use Modules\Notification\Services\NotificationService;
use Modules\Notification\Notifications\WelcomeNotification;

// In your controller
public function register(Request $request)
{
    // User registration code...
    
    // Send welcome notification
    $notificationService = app(NotificationService::class);
    $notificationService->send($user, new WelcomeNotification());
    
    // ...
}
```

### Creating custom notifications

Create a new notification class by extending the BaseNotification class:

```php
<?php

namespace App\Notifications;

use Modules\Notification\Notifications\BaseNotification;

class OrderConfirmationNotification extends BaseNotification
{
    protected $order;
    
    public function __construct($order)
    {
        parent::__construct();
        $this->order = $order;
    }
    
    protected function getDefaultChannels(): array
    {
        return ['database', 'sms', 'mail'];
    }
    
    public function getTitle($notifiable): string
    {
        return 'سفارش شما تایید شد';
    }
    
    public function getMessage($notifiable): string
    {
        return "سفارش شما با کد {$this->order->code} با موفقیت تایید شد.";
    }
    
    public function getActionUrl($notifiable): ?string
    {
        return url("/orders/{$this->order->id}");
    }
}
```

## Configuration

You can configure notification channels, fallback order, and other settings in the `config/notification.php` file.

## Admin Panel

The module provides an admin panel for managing notifications at:
- `/admin/notifications` - List of all notifications
- `/admin/notifications/test/form` - Test sending notifications

## User Preferences

Users can manage their notification preferences at:
- `/notifications/preferences` - User notification preference page 