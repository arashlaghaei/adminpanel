<?php

namespace Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\Core\Entities\User;
use Modules\Core\Libraries\Class\StatisticsGenerator;
use Modules\Notification\Models\NotificationLog;
use Modules\Notification\Models\NotificationTemplate;
use Modules\Notification\Services\NotificationService;

class NotificationController extends Controller
{
    /**
     * The notification service instance.
     */
    protected $notificationService;
    
    /**
     * Create a new controller instance.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
//        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the notifications.
     */
    public function index(Request $request)
    {
        if (request()->has('page')) {
            $per_page = request()->input('per_page', 10);

            $list = NotificationLog::search()->paginate($per_page);

            return response()->json($list);
        }

        $userStats = new StatisticsGenerator(NotificationLog::class);
        $data['chartWeek'] = $userStats->getLastWeekRecords();
        $data['chartMonth'] = $userStats->getLastMonthRecords();
        $data['chartYear'] = $userStats->getLastYearRecords();
            
        return view('notification::admin.log.index', $data);
    }
    
    /**
     * Display the notification log details.
     */
    public function show($id)
    {
        $log = NotificationLog::with('notifiable')->findOrFail($id);
        
        return view('notification::admin.show', compact('log'));
    }
    
    /**
     * Show the form for testing notifications.
     */
    public function test()
    {
        $templates = NotificationTemplate::active()->get();
        $channels = array_keys(array_filter(config('notification.channels')));
        
        return view('notification::admin.test', compact('templates', 'channels'));
    }
    
    /**
     * Send a test notification.
     */
    public function sendTest(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:notification_templates,id',
            'recipient_id' => 'required',
            'recipient_type' => 'required|in:user,customer,admin',
            'channels' => 'required|array',
            'channels.*' => 'string|in:database,sms,whatsapp,mail,telegram,slack,discord',
        ]);


        // Find the template
        $template = NotificationTemplate::findOrFail($request->template_id);

        // Find the recipient
        $recipientType = $request->recipient_type;
        $recipientId = $request->recipient_id;
        
        $recipientClass = null;
        if ($recipientType === 'user') {
            $recipientClass = config('auth.providers.users.model');
        } else if ($recipientType === 'customer') {
            // You would need to define the customer model class
            $recipientClass = \App\Models\Customer::class;
        } else if ($recipientType === 'admin') {
            // You would need to define the admin model class
            $recipientClass = \App\Models\Admin::class;
        }

        if (!$recipientClass || !class_exists($recipientClass)) {
            return back()->with('error', 'Invalid recipient type');
        }
        
        // Find the recipient
        $recipient = $recipientClass::find($recipientId);

        if (!$recipient) {
            return back()->with('error', 'Recipient not found');
        }
        
        // Create a generic notification from the template
        $notification = new \Modules\Notification\Notifications\TemplateNotification($template);

        // Send the notification
        $this->notificationService->send($recipient, $notification, $request->channels);

        message();
        return back()->with('success', 'Test notification sent successfully');
    }
    
    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $log = NotificationLog::findOrFail($id);
        $log->markAsRead();
        
        return back()->with('success', 'Notification marked as read');
    }
    
    /**
     * Retry a failed notification.
     */
    public function retry($id)
    {
        $log = NotificationLog::findOrFail($id);
        
        if ($log->status !== NotificationLog::STATUS_FAILED) {
            return back()->with('error', 'Only failed notifications can be retried');
        }
        
        // Dispatch retry job
        \Modules\Notification\Jobs\RetryFailedNotification::dispatch($log->id);
        
        return back()->with('success', 'Notification queued for retry');
    }
    
    /**
     * Delete a notification log.
     */
    public function destroy($id)
    {
        $log = NotificationLog::findOrFail($id);
        $log->delete();
        
        return back()->with('success', 'Notification log deleted');
    }
}
