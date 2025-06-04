<?php

namespace Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notification\Models\NotificationTemplate;

class NotificationTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('page')) {
            $per_page = $request->input('per_page', 10);
            $list = NotificationTemplate::search()->paginate($per_page);
            return response()->json($list);
        }

        return view('notification::admin.templates.index');
    }

    public function create()
    {
        return view('notification::admin.templates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:notification_templates,key',
            'notification_type' => 'required|string|max:255',
            'channels' => 'required|array',
            'content' => 'nullable',
            'actions' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);

        $data['channels'] = array_values($data['channels']);
        $data['is_active'] = $request->boolean('is_active');

        NotificationTemplate::create($data);
        message();
        return redirect()->route('admin.notification-templates.index');
    }

    public function edit(NotificationTemplate $notificationTemplate)
    {
        return view('notification::admin.templates.edit', ['template' => $notificationTemplate]);
    }

    public function update(Request $request, NotificationTemplate $notificationTemplate)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:notification_templates,key,' . $notificationTemplate->id,
            'notification_type' => 'required|string|max:255',
            'channels' => 'required|array',
            'content' => 'nullable',
            'actions' => 'nullable',
            'is_active' => 'nullable|boolean',
        ]);

        $data['channels'] = array_values($data['channels']);
        $data['is_active'] = $request->boolean('is_active');

        $notificationTemplate->update($data);
        message();
        return redirect()->route('admin.notification-templates.edit', $notificationTemplate->id);
    }

    public function destroy(NotificationTemplate $notificationTemplate)
    {
        $notificationTemplate->delete();
        return back()->with('success', 'Template deleted');
    }
}
