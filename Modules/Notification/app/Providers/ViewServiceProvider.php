<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the notification-widget component alias
        Blade::component('notification::components.notification-widget', 'notification-widget');
        
        // Load views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'notification');
    }
} 