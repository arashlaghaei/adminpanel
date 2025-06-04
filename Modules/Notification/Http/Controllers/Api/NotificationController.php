<?php

namespace Modules\Notification\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notification\Models\NotificationLog;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $logs = NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->latest()
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'success' => true,
            'data' => $logs,
            'meta' => [
                'total' => $logs->total(),
                'per_page' => $logs->perPage(),
                'current_page' => $logs->currentPage(),
                'last_page' => $logs->lastPage(),
            ],
        ]);
    }
    
    /**
     * Display a listing of the user's unread notifications.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unread(Request $request)
    {
        $user = auth()->user();
        
        $logs = NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->whereNull('read_at')
            ->latest()
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'success' => true,
            'data' => $logs,
            'meta' => [
                'total' => $logs->total(),
                'per_page' => $logs->perPage(),
                'current_page' => $logs->currentPage(),
                'last_page' => $logs->lastPage(),
            ],
        ]);
    }
    
    /**
     * Get the count of unread notifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        $user = auth()->user();
        
        $count = NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->whereNull('read_at')
            ->count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'count' => $count,
            ],
        ]);
    }
    
    /**
     * Mark a notification as read.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead($id)
    {
        $user = auth()->user();
        
        $log = NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->findOrFail($id);
        
        $log->markAsRead();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
            'data' => $log,
        ]);
    }
    
    /**
     * Delete a notification.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = auth()->user();
        
        $log = NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->findOrFail($id);
        
        $log->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Notification deleted',
        ]);
    }
} 