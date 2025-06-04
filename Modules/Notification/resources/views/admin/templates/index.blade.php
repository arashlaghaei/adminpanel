@extends('core::admin.layout.master')

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2 class="fw-bold">قالب‌های اعلان</h2>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ route('admin.notification-templates.create') }}" class="btn btn-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        ایجاد قالب جدید
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_templates_table">
                <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-50px">شناسه</th>
                    <th class="min-w-125px">عنوان</th>
                    <th class="min-w-125px">کلید</th>
                    <th class="min-w-125px">نوع</th>
                    <th class="min-w-125px">وضعیت</th>
                    <th class="text-end min-w-70px">عملیات</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                @foreach($templates as $template)
                    <tr>
                        <td>{{ $template->id }}</td>
                        <td>{{ $template->name }}</td>
                        <td>{{ $template->key }}</td>
                        <td>{{ $template->notification_type }}</td>
                        <td>
                            @if($template->is_active)
                                <span class="badge badge-light-success">فعال</span>
                            @else
                                <span class="badge badge-light-danger">غیرفعال</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                عملیات
                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.notification-templates.edit', $template->id) }}" class="menu-link px-3">ویرایش</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" onclick="event.preventDefault(); if(confirm('آیا مطمئن هستید؟')) document.getElementById('delete-form-{{ $template->id }}').submit();">حذف</a>
                                    <form id="delete-form-{{ $template->id }}" action="{{ route('admin.notification-templates.destroy', $template->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $templates->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const table = document.querySelector('#kt_templates_table');
    $(table).DataTable({
        "info": false,
        'order': [],
        'columnDefs': [
            { orderable: false, targets: 5 },
        ]
    });
</script>
@endpush
