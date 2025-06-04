@extends('core::admin.layout.master')

@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <h2 class="fw-bold">جزئیات اعلان</h2>
                </div>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-light-primary me-3">
                        <i class="ki-duotone ki-arrow-left fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        بازگشت به لیست
                    </a>
                    @if($log->status === 'failed')
                        <a href="#" class="btn btn-light-warning me-3" onclick="event.preventDefault(); document.getElementById('retry-form').submit();">
                            <i class="ki-duotone ki-refresh fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            تلاش مجدد
                        </a>
                        <form id="retry-form" action="{{ route('admin.notifications.retry', $log->id) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">نوع اعلان:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">{{ $log->notification_type }}</div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">کانال:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">
                    <span class="badge badge-light-{{ $log->channel == 'database' ? 'primary' : ($log->channel == 'sms' ? 'success' : ($log->channel == 'whatsapp' ? 'info' : 'warning')) }}">
                        {{ $log->channel }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">گیرنده:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">
                    @if($log->notifiable)
                        {{ get_class($log->notifiable) }} #{{ $log->notifiable_id }}
                        @if(method_exists($log->notifiable, 'getFullNameAttribute') && $log->notifiable->getFullNameAttribute())
                            ({{ $log->notifiable->getFullNameAttribute() }})
                        @elseif(isset($log->notifiable->name))
                            ({{ $log->notifiable->name }})
                        @endif
                    @else
                        کاربر #{{ $log->notifiable_id }}
                    @endif
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">وضعیت:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">
                    @if($log->status == 'sent')
                        <span class="badge badge-light-success">ارسال شده</span>
                    @elseif($log->status == 'pending')
                        <span class="badge badge-light-warning">در انتظار</span>
                    @elseif($log->status == 'failed')
                        <span class="badge badge-light-danger">ناموفق</span>
                    @elseif($log->status == 'delivered')
                        <span class="badge badge-light-success">تحویل داده شده</span>
                    @elseif($log->status == 'read')
                        <span class="badge badge-light-primary">خوانده شده</span>
                    @endif
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">تاریخ ایجاد:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">{{ jdate($log->created_at)->format('Y/m/d H:i:s') }}</div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">تاریخ ارسال:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">{{ $log->sent_at ? jdate($log->sent_at)->format('Y/m/d H:i:s') : '-' }}</div>
                <!--end::Col-->
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">تاریخ خواندن:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">{{ $log->read_at ? jdate($log->read_at)->format('Y/m/d H:i:s') : '-' }}</div>
                <!--end::Col-->
            </div>
            @if($log->status == 'failed')
                <div class="row mb-6">
                    <!--begin::Label-->
                    <div class="col-lg-4 fw-semibold fs-6 text-gray-800">متن خطا:</div>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fw-semibold fs-6 text-danger">{{ $log->error }}</div>
                    <!--end::Col-->
                </div>
            @endif
            <div class="row mb-6">
                <!--begin::Label-->
                <div class="col-lg-4 fw-semibold fs-6 text-gray-800">تعداد تلاش‌ها:</div>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fw-semibold fs-6">{{ $log->attempts }}</div>
                <!--end::Col-->
            </div>
            
            <div class="separator my-10"></div>
            
            <h3 class="mb-5">محتوای اعلان</h3>
            
            <div class="row mb-6">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body">
                            @if(isset($log->data['message']))
                                <p>{{ $log->data['message'] }}</p>
                            @elseif(isset($log->data['text']))
                                <p>{{ $log->data['text'] }}</p>
                            @elseif(isset($log->data['content']))
                                <p>{{ $log->data['content'] }}</p>
                            @else
                                <pre>{{ json_encode($log->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            @endif
                            
                            @if(isset($log->data['actions']) && is_array($log->data['actions']))
                                <div class="mt-4">
                                    @foreach($log->data['actions'] as $action)
                                        <a href="{{ $action['url'] ?? '#' }}" class="btn btn-sm btn-{{ $action['type'] ?? 'primary' }} me-2">
                                            {{ $action['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if(isset($log->data['response']) && !empty($log->data['response']))
                <div class="separator my-10"></div>
                
                <h3 class="mb-5">پاسخ API</h3>
                
                <div class="row mb-6">
                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body text-end dleft">
                                <pre>{{ json_encode($log->data['response'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!--end::Card body-->
    </div>
@endsection 