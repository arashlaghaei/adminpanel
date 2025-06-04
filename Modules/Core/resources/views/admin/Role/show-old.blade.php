@extends('core::admin.layout.master')

@section('content')

    <x-core::form.page-header resource="سطح دسترسی" page="ایجاد" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="d-flex flex-column flex-lg-row mt-5">
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="mb-0">{{ $role->label ?? $role->name }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            @if($role->description)
                                <div class="text-gray-600 fs-7 mb-5">
                                    {{ $role->description }}
                                </div>
                            @endif

                            <div class="d-flex flex-wrap mb-5">
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4 me-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bold">{{ jdate($role->created_at)->format('Y/m/d') }}</div>
                                    <div class="fw-semibold text-gray-400">تاریخ ایجاد</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded py-3 px-4 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bold">{{ $role->user->count() }} <span class="text-gray-500 fs-7">کاربر</span></div>
                                    <div class="fw-semibold text-gray-400">تعداد کاربران</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pt-0">
                            <a href="{{ route('core.web.admin.role.role.edit', $role->id) }}" class="btn btn-light btn-active-primary w-100">ویرایش سطح دسترسی</a>
                        </div>
                    </div>
                </div>

                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">

                    {{-- لیست مجوزها --}}
                    <div class="card card-flush mb-6 mb-xl-9">
                        <div class="card-header pt-5">
                            <div class="card-title">
                                <h2 class="d-flex align-items-center">مجوزهای تخصیص داده شده
                                    <span class="text-gray-600 fs-6 ms-1">({{ $role->permissions->count() }} مجوز)</span></h2>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            @php
                                $groupedPermissions = $role->permissions
                                    ->groupBy('mainGroup')
                                    ->map(fn($items) => $items->groupBy('group'));
                            @endphp

                            @forelse($groupedPermissions as $mainGroupKey => $mainGroup)
                                <div class="mb-6">
                                    <h4 class="text-dark fw-bolder mb-3">{{ $mainGroupKey }}</h4>

                                    @foreach($mainGroup as $groupKey => $permissions)
                                        <div class="ps-4 mb-4">
                                            <h5 class="text-muted fw-bold fs-6 mb-3">{{ $groupKey }}</h5>
                                            <div class="d-flex flex-wrap">
                                                @foreach($permissions as $permission)
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
                                <p class="text-muted">هیچ مجوزی برای این نقش ثبت نشده است.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- لیست کاربران --}}
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
                                            <th class="min-w-150px">ایمیل</th>
                                            <th class="min-w-125px">تاریخ عضویت</th>
                                            <th class="text-end min-w-100px">اقدامات</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                        @foreach($role->user as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="d-flex align-items-center">
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <div class="symbol-label fs-3 bg-light-warning text-warning">
                                                            {{ strtoupper(Str::limit(Str::replace(' ', '', $user->first_name), 2, '')).' '.strtoupper(Str::limit(Str::replace(' ', '', $user->last_name), 2, '')) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ jdate($user->created_at)->format('Y/m/d') }}</td>
                                                <td class="text-end">
                                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="مشاهده">
                                                        <i class="ki-duotone ki-eye fs-3"><span class="path1"></span><span class="path2"></span></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center p-10">
                                    <p class="text-muted fs-4">هیچ کاربری به این نقش اختصاص داده نشده است.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
