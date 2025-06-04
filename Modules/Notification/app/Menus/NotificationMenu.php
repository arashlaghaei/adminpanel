<?php

namespace Modules\Notification\Menus;

use Modules\Core\Services\MenuManager;

class NotificationMenu
{
    public static function register(): void
    {
        MenuManager::add([
            'type' => 'heading',
            'title' => 'اعلان‌ها',
            'priority' => 50,
        ]);

        MenuManager::add([
            'title' => 'لیست اعلان‌ها',
            'icon' => 'ki-duotone ki-notification-on fs-2',
            'route' => 'admin.notifications.index',
            'priority' => 51,
        ]);

        MenuManager::add([
            'title' => 'قالب‌های اعلان',
            'icon' => 'ki-duotone ki-setting-3 fs-2',
            'route' => 'admin.notification-templates.index',
            'priority' => 52,
        ]);
    }
}
