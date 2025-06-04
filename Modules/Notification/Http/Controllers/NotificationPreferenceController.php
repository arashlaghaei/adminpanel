<?php

namespace Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notification\Models\NotificationPreference;

class NotificationPreferenceController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display the user's notification preferences.
     */
    public function index()
    {
        $user = auth()->user();
        $preferences = NotificationPreference::where('user_id', $user->id)->get();
        
        // Get available notification types
        $notificationTypes = $this->getAvailableNotificationTypes();
        
        // Get available channels
        $channels = array_keys(array_filter(config('notification.channels')));
        
        return view('notification::preferences.index', compact('preferences', 'notificationTypes', 'channels'));
    }
    
    /**
     * Update the user's notification preferences.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'preferences' => 'required|array',
            'preferences.*.notification_type' => 'required|string',
            'preferences.*.channels' => 'sometimes|array',
            'preferences.*.is_enabled' => 'sometimes|boolean',
        ]);
        
        foreach ($data['preferences'] as $preferenceData) {
            NotificationPreference::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'notification_type' => $preferenceData['notification_type'],
                ],
                [
                    'channels' => $preferenceData['channels'] ?? [],
                    'is_enabled' => $preferenceData['is_enabled'] ?? false,
                ]
            );
        }
        
        return back()->with('success', 'Notification preferences updated successfully');
    }
    
    /**
     * Get available notification types.
     */
    protected function getAvailableNotificationTypes()
    {
        // This could be fetched from a config file, database, or by scanning notification classes
        $baseNamespace = 'Modules\\Notification\\Notifications\\';
        $basePath = app_path('../../Modules/Notification/Notifications/');
        
        $types = [];
        
        if (file_exists($basePath)) {
            $files = scandir($basePath);
            
            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === 'BaseNotification.php') {
                    continue;
                }
                
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $className = pathinfo($file, PATHINFO_FILENAME);
                    $fullyQualifiedClassName = $baseNamespace . $className;
                    
                    if (class_exists($fullyQualifiedClassName)) {
                        $reflectionClass = new \ReflectionClass($fullyQualifiedClassName);
                        
                        if (!$reflectionClass->isAbstract() && 
                            $reflectionClass->isSubclassOf('Modules\\Notification\\Notifications\\BaseNotification')) {
                            $instance = new $fullyQualifiedClassName();
                            $types[] = [
                                'key' => $instance->getType(),
                                'name' => $this->getPrettyName($className),
                            ];
                        }
                    }
                }
            }
        }
        
        return $types;
    }
    
    /**
     * Convert class name to a prettier display name.
     */
    protected function getPrettyName($className)
    {
        if (substr($className, -12) === 'Notification') {
            $className = substr($className, 0, -12);
        }
        
        return ucwords(strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $className)));
    }
} 