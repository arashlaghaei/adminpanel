@props(['limit' => 5])

@php
    $user = auth()->user();
    $notifications = [];
    
    if ($user) {
        $notifications = \Modules\Notification\Models\NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->whereIn('channel', ['database'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
        
        $unreadCount = \Modules\Notification\Models\NotificationLog::where('notifiable_type', get_class($user))
            ->where('notifiable_id', $user->id)
            ->whereIn('channel', ['database'])
            ->whereNull('read_at')
            ->count();
    }
@endphp

<!--begin::Notification toggle-->
<div class="app-navbar-item ms-1 ms-md-4">
    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_notifications">
        <i class="ki-duotone ki-notification-status fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
        @if($unreadCount > 0)
            <span class="bullet bullet-dot bg-danger h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
        @endif
    </div>
    
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
        <!--begin::Heading-->
        <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{asset('assets/panel/media/misc/menu-header-bg.jpg')}}')">
            <!--begin::Title-->
            <h3 class="text-white fw-semibold px-9 mt-10 mb-6">اعلان‌ها
                <span class="fs-8 opacity-75 ps-3">{{ $unreadCount }} اعلان خوانده نشده</span>
            </h3>
            <!--end::Title-->
            <!--begin::Tabs-->
            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                <li class="nav-item">
                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_all">همه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4" href="{{ route('notifications.preferences.index') }}">تنظیمات</a>
                </li>
            </ul>
            <!--end::Tabs-->
        </div>
        <!--end::Heading-->
        
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab panel-->
            <div class="tab-pane fade show active" id="kt_topbar_notifications_all" role="tabpanel">
                <!--begin::Items-->
                <div class="scroll-y mh-325px my-5 px-8">
                    @if(count($notifications) > 0)
                        @foreach($notifications as $notification)
                            <!--begin::Item-->
                            <div class="d-flex flex-stack py-4 {{ is_null($notification->read_at) ? 'bg-light-primary rounded px-2' : '' }}">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-abstract-28 fs-2 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    
                                    <!--begin::Title-->
                                    <div class="mb-0 me-2">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold" onclick="event.preventDefault(); document.getElementById('read-form-{{ $notification->id }}').submit();">
                                            @if(isset($notification->data['title']))
                                                {{ $notification->data['title'] }}
                                            @else
                                                {{ $notification->notification_type }}
                                            @endif
                                        </a>
                                        <div class="text-gray-500 fs-7">
                                            @if(isset($notification->data['message']))
                                                {{ \Illuminate\Support\Str::limit($notification->data['message'], 50) }}
                                            @endif
                                        </div>
                                        
                                        <form id="read-form-{{ $notification->id }}" action="{{ route('admin.notifications.mark-as-read', $notification->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                                
                                <!--begin::Label-->
                                <span class="badge badge-light fs-8">{{ jdate($notification->created_at)->ago() }}</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Item-->
                            
                            @if(!$loop->last)
                                <div class="separator separator-dashed d-none"></div>
                            @endif
                        @endforeach
                    @else
                        <!--begin::Item-->
                        <div class="d-flex flex-stack py-4">
                            <div class="d-flex align-items-center w-100 justify-content-center">
                                <span class="text-gray-500 fs-7">اعلانی وجود ندارد</span>
                            </div>
                        </div>
                        <!--end::Item-->
                    @endif
                </div>
                <!--end::Items-->
                
                <!--begin::View more-->
                <div class="py-3 text-center border-top">
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-color-gray-600 btn-active-color-primary">
                        مشاهده همه
                        <i class="ki-duotone ki-arrow-right fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                </div>
                <!--end::View more-->
            </div>
            <!--end::Tab panel-->
        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Notification toggle--> 