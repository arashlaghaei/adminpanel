<?php

namespace Modules\Notification\Console\Commands;

use Illuminate\Console\Command;
use Modules\Notification\Services\NotificationService;

class RetryFailedNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:retry-failed {--days=7 : Only retry notifications failed within the specified number of days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry failed notifications';

    /**
     * The notification service instance.
     *
     * @var \Modules\Notification\Services\NotificationService
     */
    protected $notificationService;

    /**
     * Create a new command instance.
     *
     * @param \Modules\Notification\Services\NotificationService $notificationService
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $days = $this->option('days');
        
        $this->info("Retrying notifications failed within the last {$days} days...");
        
        $retried = $this->notificationService->retryFailed($days);
        
        $this->info("Queued {$retried} notifications for retry.");
        
        return 0;
    }
} 