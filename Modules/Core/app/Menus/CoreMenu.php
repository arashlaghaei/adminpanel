<?php

namespace Modules\Core\Menus;

use Modules\Core\Services\MenuManager;

class CoreMenu
{
    public static function register(): void
    {
        MenuManager::add([
            'title' => 'داشبورد',
            'icon' => 'ki-duotone ki-element-11 fs-2',
            'route' => 'core.web.admin.dashboard',
            'priority' => 1,
        ]);

        MenuManager::add([
            'type' => 'heading',
            'title' => 'صفحات',
            'priority' => 10,
        ]);

        MenuManager::add([
            'title' => 'مدیریت کاربران',
            'icon' => 'ki-duotone ki-profile-user fs-2',
            'route' => 'core.web.admin.user.user.index',
            'priority' => 11,
        ]);

        MenuManager::add([
            'title' => 'سطح دسترسی',
            'icon' => 'ki-duotone ki-shield-tick fs-2',
            'route' => 'core.web.admin.role.role.index',
            'priority' => 12,
        ]);

        MenuManager::add([
            'title' => 'ویرایش پروفایل',
            'icon' => 'ki-duotone ki-user-edit fs-2',
            'route' => 'core.web.admin.user.profile.edit',
            'priority' => 13,
        ]);

        MenuManager::add([
            'title' => 'تغییر گذرواژه',
            'icon' => 'ki-duotone ki-lock fs-2',
            'route' => 'core.web.admin.user.changePassword.edit',
            'priority' => 14,
        ]);
    }
}

