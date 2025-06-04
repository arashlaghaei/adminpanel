@extends('core::admin.layout.master')

@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bold">مدیریت اعلان‌ها</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <!--begin::Add customer-->
                    <a href="{{ route('admin.notifications.test.form') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-message-text-2 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        آزمایش اعلان جدید
                    </a>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">شناسه</th>
                    <th class="min-w-125px">نوع اعلان</th>
                    <th class="min-w-125px">کانال</th>
                    <th class="min-w-125px">گیرنده</th>
                    <th class="min-w-125px">وضعیت</th>
                    <th class="min-w-125px">تاریخ ارسال</th>
                    <th class="text-end min-w-70px">عملیات</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->notification_type }}</td>
                        <td>
                            <span class="badge badge-light-{{ $log->channel == 'database' ? 'primary' : ($log->channel == 'sms' ? 'success' : ($log->channel == 'whatsapp' ? 'info' : 'warning')) }}">
                                {{ $log->channel }}
                            </span>
                        </td>
                        <td>
                            @if($log->notifiable)
                                {{ get_class($log->notifiable) }} #{{ $log->notifiable_id }}
                            @else
                                کاربر #{{ $log->notifiable_id }}
                            @endif
                        </td>
                        <td>
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
                        </td>
                        <td>{{ $log->sent_at ? jdate($log->sent_at)->format('Y/m/d H:i') : '-' }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                عملیات
                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.notifications.show', $log->id) }}" class="menu-link px-3">مشاهده</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                @if($log->status == 'failed')
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" onclick="event.preventDefault(); document.getElementById('retry-form-{{ $log->id }}').submit();">تلاش مجدد</a>
                                        <form id="retry-form-{{ $log->id }}" action="{{ route('admin.notifications.retry', $log->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                @endif
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" data-kt-customer-table-filter="delete_row" onclick="event.preventDefault(); if(confirm('آیا مطمئن هستید؟')) document.getElementById('delete-form-{{ $log->id }}').submit();">حذف</a>
                                    <form id="delete-form-{{ $log->id }}" action="{{ route('admin.notifications.destroy', $log->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end::Table-->
            
            <div class="d-flex justify-content-end">
                {{ $logs->links() }}
            </div>
        </div>
        <!--end::Card body-->
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize datatables
        const table = document.querySelector('#kt_customers_table');
        const datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'columnDefs': [
                { orderable: false, targets: 5 }, // Disable ordering on action column
            ]
        });
    </script>
@endpush 