<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Entities\Permission;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // گروه‌های دسترسی فرعی (جزئی‌تر) - این لیست از کد قبلی شما حفظ شده است
        $persianGroups = [
            'کاربران',           // مدیریت کاربران، افزودن، ویرایش، حذف کاربر
            'نقش‌ها',            // مدیریت نقش‌های کاربری، تخصیص دسترسی به نقش
            'دسترسی‌ها',        // مدیریت خود دسترسی‌ها (مجوزها)
            'تنظیمات',          // تنظیمات کلی سیستم، تنظیمات ظاهری، تنظیمات ایمیل
            'محتوا',             // مدیریت مقالات، برگه‌ها، اخبار، اطلاعیه‌ها
            'گزارشات',          // مشاهده گزارشات فروش، گزارشات بازدید، گزارشات کاربران
            'محصولات',          // مدیریت محصولات فروشگاه، دسته‌بندی محصولات، ویژگی‌ها
            'سفارشات',          // مدیریت سفارشات مشتریان، پیگیری وضعیت سفارش
            'مالی',              // مدیریت تراکنش‌ها، فاکتورها، کدهای تخفیف
            'پشتیبانی',         // مدیریت تیکت‌های پشتیبانی، پاسخ به سوالات کاربران
            'رسانه',             // مدیریت فایل‌ها، تصاویر، ویدئوها
            'منوها',             // مدیریت منوهای اصلی و فرعی وبسایت
            'نظرات',            // مدیریت دیدگاه‌های کاربران برای مطالب یا محصولات
            'اطلاع‌رسانی‌ها',   // مدیریت سیستم ارسال پیامک، ایمیل‌های اطلاع‌رسانی
            'لاگ‌ها',            // مشاهده لاگ‌های سیستم و فعالیت کاربران
            'ماژول‌ها',          // مدیریت ماژول‌های نصب شده و فعال
            'قالب‌ها',           // مدیریت قالب‌های وبسایت
            'صفحات سفارشی',     // مدیریت صفحات ایجاد شده توسط کاربر
        ];

        // نگاشت نام‌های فارسی گروه به نام‌های انگلیسی (برای routeName و name)
        $resourceNameMapping = [
            'کاربران' => 'users',
            'نقش‌ها' => 'roles',
            'دسترسی‌ها' => 'permissions',
            'تنظیمات' => 'settings',
            'محتوا' => 'content', // می‌تواند شامل مقالات، برگه‌ها و ... باشد
            'گزارشات' => 'reports',
            'محصولات' => 'products',
            'سفارشات' => 'orders',
            'مالی' => 'financials',
            'پشتیبانی' => 'support-tickets',
            'رسانه' => 'media',
            'منوها' => 'menus',
            'نظرات' => 'comments',
            'اطلاع‌رسانی‌ها' => 'notifications',
            'لاگ‌ها' => 'logs',
            'ماژول‌ها' => 'modules',
            'قالب‌ها' => 'themes',
            'صفحات سفارشی' => 'custom-pages',
        ];

        // گروه‌های دسترسی اصلی (کلی‌تر) - این لیست از کد قبلی شما حفظ شده است
        $mainGroups = [
            'پنل مدیریت',      // دسترسی‌های مربوط به بخش ادمین و مدیریت کل سیستم
            'پنل کاربری',     // دسترسی‌های مربوط به پروفایل و امکانات کاربران عادی
            'سیستم',           // دسترسی‌های پایه‌ای و سیستمی، معمولاً برای توسعه‌دهندگان
            'فروشگاه',         // دسترسی‌های مرتبط با ماژول فروشگاه (اگر وجود دارد)
            'وبلاگ',           // دسترسی‌های مرتبط با ماژول وبلاگ یا بخش اخبار
            'عمومی',           // دسترسی‌هایی که ممکن است بین چند بخش مشترک باشند
            'ابزارها',          // دسترسی به ابزارهای کمکی و مدیریتی
        ];

        // اقدامات استاندارد CRUD با ترجمه فارسی و بخش‌های مربوط به route و name
        $standardActions = [
            'create' => ['label' => 'ایجاد', 'route_suffix' => 'create', 'name_prefix' => 'create'],
            'edit'   => ['label' => 'ویرایش', 'route_suffix' => 'edit', 'name_prefix' => 'edit'],
            'view'   => ['label' => 'نمایش', 'route_suffix' => 'show', 'name_prefix' => 'view'], // برای نمایش یک مورد خاص
            'list'   => ['label' => 'نمایش لیست', 'route_suffix' => 'index', 'name_prefix' => 'list'], // برای نمایش لیست موارد
            'delete' => ['label' => 'حذف', 'route_suffix' => 'destroy', 'name_prefix' => 'delete'],
        ];

        // انتخاب یک گروه فارسی به صورت تصادفی
        $selectedPersianGroup = $this->faker->randomElement($persianGroups);
        // دریافت نام انگلیسی معادل (اگر در نگاشت نباشد، یک نام تصادفی ایجاد می‌شود)
        $englishResourceName = $resourceNameMapping[$selectedPersianGroup] ?? $this->faker->slug(1, false);

        // انتخاب یک اقدام استاندارد به صورت تصادفی
        $selectedActionKey = $this->faker->randomElement(array_keys($standardActions));
        $actionDetails = $standardActions[$selectedActionKey];

        // ساخت نام دسترسی (مثال: create-users)
        // توجه: اگر ستون 'name' در دیتابیس شما باید یکتا باشد، این نام ممکن است تکراری شود
        // اگر فکتوری چندین بار برای ترکیب یکسان گروه و اقدام فراخوانی شود.
        // مدیریت یکتایی نام‌ها معمولاً در Seeder انجام می‌شود.
        $permissionName = $actionDetails['name_prefix'] . '-' . $englishResourceName;

        // ساخت برچسب دسترسی (مثال: ایجاد کاربران)
        $permissionLabel = $actionDetails['label'] . ' ' . $selectedPersianGroup;

        // ساخت نام مسیر (مثال: users.create)
        $permissionRouteName = $englishResourceName . '.' . $actionDetails['route_suffix'];

        return [
            'name' => $permissionName,
            'label' => $permissionLabel,
            'group' => $selectedPersianGroup, // گروه فارسی
            'mainGroup' => $this->faker->randomElement($mainGroups), // انتخاب تصادفی از گروه‌های اصلی
            'routeName' => $permissionRouteName,
        ];
    }
}
