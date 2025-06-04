@extends('core::admin.layout.master')

@section('content')

    <x-core::form.page-header resource="سطح دسترسی" :page="('نمایش: ' . ($role->label ?? $role->name))" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        {{-- برای کنترل بهتر عرض محتوا در حالت تک ستونی، می‌توانید از container-xl یا container-lg استفاده کنید --}}
        <div id="kt_app_content_container" class="app-container container-fluid">

            {{-- کارت اول: ادغام اطلاعات کلی و مجوزها --}}
            <div class="card card-flush mb-6 mb-xl-9">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        {{-- عنوان نقش --}}
                        <h2 class="mb-0">{{ $role->label ?? $role->name }}</h2>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <a href="{{route(getNamePage('index'))}}" class="btn btn-light-primary me-3">
                                <i class="ki-duotone ki-arrow-left fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                بازگشت به لیست
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    {{-- توضیحات و آمار کلی نقش --}}
                    @if($role->description)
                        <p class="text-gray-700 fs-6 mb-4">{{ $role->description }}</p>
                    @endif

                    <div class="d-flex flex-wrap mb-5">
                        <div class="d-flex align-items-center me-6 mb-2">
                            <i class="ki-duotone ki-calendar-8 fs-3 text-gray-500 me-2">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                            </i>
                            <span class="fw-semibold text-gray-700 fs-7">تاریخ ایجاد: {{ jdate($role->created_at)->format('Y/m/d') }}</span>
                        </div>
                        <div class="d-flex align-items-center me-6 mb-2">
                            <i class="ki-duotone ki-profile-circle fs-3 text-gray-500 me-2">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                            </i>
                            <span class="fw-semibold text-gray-700 fs-7">تعداد کاربران: {{ $role->user->count() }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="ki-duotone ki-shield-tick fs-3 text-gray-500 me-2">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <span class="fw-semibold text-gray-700 fs-7">تعداد مجوزها: {{ $role->permissions->count() }}</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed mt-1 mb-5"></div>

                    {{-- عنوان بخش مجوزها --}}
                    <h3 class="d-flex align-items-center text-dark fw-bold mb-4">مجوزهای تخصیص داده شده</h3>

                    @php
                        $groupedPermissions = $role->permissions
                            ->groupBy('mainGroup')
                            ->map(fn($items) => $items->groupBy('group'));
                    @endphp

                    @forelse($groupedPermissions as $mainGroupKey => $mainGroup)
                        <div class="mb-6">
                            <h4 class="text-gray-800 fw-bolder mb-3 fs-5">{{ $mainGroupKey ?? 'گروه اصلی نامشخص' }}</h4>

                            @foreach($mainGroup as $groupKey => $permissionsInGroup)
                                <div class="ps-4 mb-4">
                                    <h5 class="text-muted fw-bold fs-6 mb-3">{{ $groupKey ?? 'زیرگروه نامشخص' }}</h5>
                                    <div class="d-flex flex-wrap">
                                        @foreach($permissionsInGroup as $permission)
                                            <div class="me-5 mb-2 p-3 border border-dashed rounded border-primary bg-light-primary">
                                                <span class="fs-7 text-primary fw-bold">
                                                    <i class="ki-duotone ki-check-circle fs-4 text-primary me-1">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    {{ $permission->label ?? $permission->name }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if(!$loop->last)
                            <div class="separator separator-dashed mb-5"></div>
                        @endif
                    @empty
                        <div class="text-center p-5">
                            <p class="text-muted fs-5">هیچ مجوزی برای این نقش ثبت نشده است.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- کارت لیست کاربران (بدون تغییر باقی می‌ماند) --}}
            <div class="card card-flush mb-6 mb-xl-9">
                <div class="card-header pt-5">
                    <div class="card-title">
                        <h2 class="d-flex align-items-center">کاربران دارای این سطح دسترسی
                            <span class="text-gray-600 fs-6 ms-1">({{ $role->user->count() }} کاربر)</span></h2>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if($role->user->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">#</th>
                                    <th class="min-w-150px">کاربر</th>
                                    <th class="min-w-150px">نام</th>
                                    <th class="min-w-150px">نام خواندگی</th>
                                    <th class="min-w-150px">ایمیل</th>
                                    <th class="min-w-125px">تاریخ عضویت</th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                @foreach($role->user as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                @php
                                                    $firstNameInitial = strtoupper(Str::limit(Str::replace(' ', '', $user->first_name ?? ''), 1, ''));
                                                    $lastNameInitial = strtoupper(Str::limit(Str::replace(' ', '', $user->last_name ?? ''), 1, ''));
                                                    $initials = $firstNameInitial . $lastNameInitial;
                                                    if(empty(trim($initials))) $initials = 'NA';
                                                @endphp
                                                <div class="symbol-label fs-3 bg-light-warning text-warning">
                                                    {{ $initials }}
                                                </div>
                                            </div>
                                        </td>
                                        <div class="d-flex flex-column">
                                            <div class="text-gray-800 text-hover-primary mb-1">{{ ($user->first_name ?? '') . ' ' . ($user->last_name ?? '') }}</div>
                                        </div>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ jdate($user->created_at)->format('Y/m/d') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center p-10">
                            <i class="ki-duotone ki-profile-circle fs-4x text-gray-300 mb-5">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                            </i>
                            <p class="text-muted fs-4">هیچ کاربری به این نقش اختصاص داده نشده است.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                if (typeof bootstrap !== 'undefined' && typeof bootstrap.Tooltip === 'function') {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                }
                return null;
            });
        });
    </script>
@endpush
