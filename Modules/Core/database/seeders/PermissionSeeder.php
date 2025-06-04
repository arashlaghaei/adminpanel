<?php

namespace Modules\Core\Database\Seeders; // مسیر شما صحیح است

use Illuminate\Database\Seeder;
use Modules\Core\Entities\Permission; // مسیر شما صحیح است

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->info('Permission seeder started with structured main groups...');
        $count = 0;

        // 1. تعریف ساختار MainGroup ها و ماژول های زیرمجموعه آنها
        // کلید: نام MainGroup (فارسی)
        // مقدار: آرایه ای از نام ماژول ها (فارسی - باید در resourceNameMapping هم تعریف شده باشند)
        $mainGroupConfig = [
            'مدیریت سیستم' => [
                'کاربران',
                'نقش‌ها',
                'دسترسی‌ها', // برای مدیریت خود دسترسی‌ها
                'تنظیمات کلی سیستم', // نام دقیق تر برای تنظیمات
                'لاگ‌های سیستم',
            ],
            'مدیریت محتوا' => [
                'پست‌ها',
                'برگه‌ها',
                'دسته‌بندی‌های محتوا', // ماژول جدید یا دقیق تر
                'نظرات کاربران',
                'گالری تصاویر', // ماژول جدید یا دقیق تر برای رسانه
            ],
            'فروشگاه' => [
                'محصولات',
                'دسته‌بندی محصولات',
                'ویژگی‌های محصول',
                'سفارشات',
                'کدهای تخفیف',
                'گزارشات فروش',
            ],
            'مالی و حسابداری' => [
                'تراکنش‌ها',
                'فاکتورها',
                'درگاه‌های پرداخت', // ماژول جدید
            ],
            'پشتیبانی و کاربران' => [
                'تیکت‌های پشتیبانی',
                'اطلاع‌رسانی به کاربران', // نام دقیق تر
                'سوالات متداول', // ماژول جدید
            ],
            // ... سایر MainGroup ها و ماژول های آنها
        ];

        // 2. نگاشت نام‌های فارسی ماژول به نام‌های انگلیسی (برای routeName و name)
        // اطمینان حاصل کنید همه ماژول‌های استفاده شده در mainGroupConfig اینجا تعریف شده باشند
        $resourceNameMapping = [
            'کاربران' => 'users',
            'نقش‌ها' => 'roles',
            'دسترسی‌ها' => 'permissions',
            'تنظیمات کلی سیستم' => 'system-settings',
            'لاگ‌های سیستم' => 'system-logs',
            'پست‌ها' => 'posts',
            'برگه‌ها' => 'pages',
            'دسته‌بندی‌های محتوا' => 'content-categories',
            'نظرات کاربران' => 'user-comments',
            'گالری تصاویر' => 'media-gallery',
            'محصولات' => 'products',
            'دسته‌بندی محصولات' => 'product-categories',
            'ویژگی‌های محصول' => 'product-attributes',
            'سفارشات' => 'orders',
            'کدهای تخفیف' => 'discount-codes',
            'گزارشات فروش' => 'sales-reports',
            'تراکنش‌ها' => 'transactions',
            'فاکتورها' => 'invoices',
            'درگاه‌های پرداخت' => 'payment-gateways',
            'تیکت‌های پشتیبانی' => 'support-tickets',
            'اطلاع‌رسانی به کاربران' => 'user-notifications',
            'سوالات متداول' => 'faqs',
            // موارد قبلی شما که ممکن است هنوز لازم باشند:
            'محتوا' => 'generic-content', // اگر هنوز محتوای عمومی دارید
            'گزارشات' => 'general-reports',
            'مالی' => 'general-financials',
            'پشتیبانی' => 'general-support',
            'رسانه' => 'general-media',
            'منوها' => 'menus',
            'اطلاع‌رسانی‌ها' => 'system-notifications', // ممکن است با اطلاع رسانی به کاربر متفاوت باشد
            'لاگ‌ها' => 'activity-logs', // ممکن است با لاگ سیستم متفاوت باشد
            'ماژول‌ها' => 'core-modules',
            'قالب‌ها' => 'themes',
            'صفحات سفارشی' => 'custom-pages',
        ];

        // 3. اقدامات استانداردی که می‌خواهید برای هر ماژول ایجاد شوند
        $actionsToCreate = [
            'list',   // نمایش لیست
            'view',   // نمایش جزئیات یک مورد
            'create', // ایجاد
            'edit',   // ویرایش
            'delete',  // حذف
        ];

        // 4. جزئیات اقدامات استاندارد (برچسب فارسی، پسوند برای routeName، پیشوند برای name)
        $standardActionsDetails = [
            'list'   => ['label_action' => 'لیست',         'route_suffix' => 'index',   'name_prefix' => 'list'],
            'view'   => ['label_action' => 'نمایش جزئیات', 'route_suffix' => 'show',    'name_prefix' => 'view'],
            'create' => ['label_action' => 'ایجاد',        'route_suffix' => 'create',  'name_prefix' => 'create'],
            'edit'   => ['label_action' => 'ویرایش',       'route_suffix' => 'edit',    'name_prefix' => 'edit'],
            'delete' => ['label_action' => 'حذف',          'route_suffix' => 'destroy', 'name_prefix' => 'delete'],
            // 'export' => ['label_action' => 'خروجی اکسل',   'route_suffix' => 'export',  'name_prefix' => 'export'],
            // 'import' => ['label_action' => 'ورود از اکسل',  'route_suffix' => 'import',  'name_prefix' => 'import'],
        ];


        // --- شروع منطق اصلی سیدر ---
        foreach ($mainGroupConfig as $currentMainGroup => $modulesInMainGroup) {
            $this->command->info("Processing Main Group: {$currentMainGroup}");

            foreach ($modulesInMainGroup as $persianModuleGroup) {
                // بررسی اینکه آیا ماژول فارسی در لیست نگاشت انگلیسی وجود دارد
                if (!isset($resourceNameMapping[$persianModuleGroup])) {
                    $this->command->warn("Skipping module '{$persianModuleGroup}' in main group '{$currentMainGroup}': Not found in resourceNameMapping.");
                    continue;
                }
                $englishResourceName = $resourceNameMapping[$persianModuleGroup];
                $this->command->line("-- Module: {$persianModuleGroup} (English: {$englishResourceName})");

                foreach ($actionsToCreate as $actionKey) {
                    if (!isset($standardActionsDetails[$actionKey])) {
                        $this->command->warn("---- Action key '{$actionKey}' not found in standardActionsDetails. Skipping for module '{$persianModuleGroup}'.");
                        continue;
                    }
                    $currentActionDetails = $standardActionsDetails[$actionKey];

                    // ساخت نام دسترسی (یکتا)
                    $permissionName = $currentActionDetails['name_prefix'] . '-' . $englishResourceName;
                    // ساخت برچسب دسترسی (قابل فهم برای کاربر)
                    // اصلاح شده: قبلا فقط currentActionDetails['label'] بود
                    $permissionLabel = $currentActionDetails['label_action'];

                    $permission = Permission::firstOrCreate(
                        [
                            'name' => $permissionName,
                        ],
                        [
                            'label' => $permissionLabel,
                            'group' => $persianModuleGroup, // نام ماژول فارسی
                            'mainGroup' => $currentMainGroup, // نام گروه اصلی فعلی
                            'routeName' => $englishResourceName . '.' . $currentActionDetails['route_suffix'],
                        ]
                    );

                    if ($permission->wasRecentlyCreated) {
                        $this->command->line("---- Created permission: {$permission->label} (Name: {$permission->name}, MainGroup: {$currentMainGroup})");
                        $count++;
                    } else {
                        $this->command->line("---- Permission already exists: {$permission->label} (Name: {$permission->name})");
                    }
                }
            }
        }

        $this->command->info("Permission seeder finished. {$count} new permissions created.");
    }
}
