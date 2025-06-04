@extends('core::admin.layout.master')

@section('content')

    <x-core::form.page-header resource="سطح دسترسی" page="ایجاد" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form class="form d-flex flex-column flex-lg-row" method="post" action="{{route(getNamePage('store'))}}"  enctype="multipart/form-data" >
                {{ csrf_field() }}

                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>ایجاد سطح دسترسی</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0" id="kt_modal_create_role"> {{-- Changed ID for clarity, though not strictly necessary if kt_modal_update_role_form is unique --}}

                            <div class="row">

                                <div class="col-12">
                                    <x-core::form.input name="name" title="نام سطح دسترسی"/>
                                </div>
                                <div class="clearfix mb-7"></div>

                                <div class="fv-row" id="kt_modal_update_role_form"> {{-- Keeping this ID for JS compatibility, ensure it's unique on the page if kt_modal_create_role is also used --}}
                                    <label class="fs-5 fw-bold form-label mb-2">سطح دسترسی مجوزها</label>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <tbody class="text-gray-600 fw-semibold">
                                            <tr>
                                                <td class="text-gray-800">دسترسی کامل
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="به تمامی ماژول های سیستم دسترسی کامل پیدا میکند">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                           <span class="path1"></span>
                                                           <span class="path2"></span>
                                                           <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </td>
                                                <td>
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                        <span class="form-check-label" for="kt_roles_select_all">انتخاب همه</span>
                                                    </label>
                                                </td>
                                            </tr>
                                            @php
                                                $dataRow = 0;
                                                $mainGroupIndex = 0;
                                            @endphp
                                            @foreach($permissions->groupBy('mainGroup') as $mainGroupKey => $mainGroupValue)
                                                @php $mainGroupIndex++; @endphp
                                                <tr class="module-header-row">
                                                    <td>
                                                        <label class="fs-5 fw-bold form-label mb-2">{{ $mainGroupKey }}</label>
                                                        {{-- Tooltip for main group can remain if needed --}}
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="به تمامی ماژول های {{$mainGroupKey}} دسترسی کامل پیدا میکند">
                                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                               <span class="path1"></span>
                                                               <span class="path2"></span>
                                                               <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input select-all-module-master" type="checkbox" data-module-id="module-{{ $mainGroupIndex }}" />
                                                            <span class="form-check-label">انتخاب همه ماژول {{ $mainGroupKey }}</span>
                                                        </label>
                                                    </td>
                                                </tr>

                                                @foreach($mainGroupValue->groupBy('group') as $groupKey => $groupValue)
                                                    @php $dataRow++; @endphp
                                                    <tr class="permission-group-row module-{{ $mainGroupIndex }}-items">
                                                        <td class="text-gray-800 ps-10">{{ $groupKey }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                    <input class="form-check-input select-all-group-master module-{{ $mainGroupIndex }}-checkbox" type="checkbox" data-group-id="group-{{ $dataRow }}" />
                                                                    <span class="form-check-label">انتخاب همه</span>
                                                                </label>
                                                                @foreach($groupValue as $permission)
                                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                        <input class="form-check-input permission-checkbox group-{{ $dataRow }}-checkbox module-{{ $mainGroupIndex }}-checkbox" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                                               data-parent-module="module-{{ $mainGroupIndex }}" data-parent-group="group-{{ $dataRow }}" />
                                                                        <span class="form-check-label">{{ $permission->label }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <a href="{{route(getNamePage('index'))}}" class="btn btn-light me-5">انصراف</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره</span> {{-- Changed from ذخیره تغییرات --}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('kt_modal_update_role_form'); // Assuming this ID is consistent for the form area
            if (!form) {
                console.error('Permission form area #kt_modal_update_role_form not found.');
                return;
            }

            const selectAllGlobal = form.querySelector('#kt_roles_select_all');
            const allModuleMasters = form.querySelectorAll('.select-all-module-master');
            const allGroupMasters = form.querySelectorAll('.select-all-group-master');
            const allPermissionCheckboxes = form.querySelectorAll('.permission-checkbox');

            // تابع برای به‌روزرسانی وضعیت چک‌باکس‌های والد
            function updateParentCheckboxes() {
                // به‌روزرسانی "انتخاب همه" برای هر گروه
                allGroupMasters.forEach(groupMaster => {
                    const groupId = groupMaster.dataset.groupId;
                    const groupPermissions = form.querySelectorAll(`.permission-checkbox.${groupId}-checkbox`);
                    groupMaster.checked = groupPermissions.length > 0 && Array.from(groupPermissions).every(cb => cb.checked);
                });

                // به‌روزرسانی "انتخاب همه ماژول" برای هر ماژول اصلی
                allModuleMasters.forEach(moduleMaster => {
                    const moduleId = moduleMaster.dataset.moduleId;
                    const moduleItems = form.querySelectorAll(`.${moduleId}-checkbox`); // این شامل هم چک‌باکس‌های دسترسی و هم "انتخاب همه گروه" های زیرمجموعه است
                    moduleMaster.checked = moduleItems.length > 0 && Array.from(moduleItems).every(cb => cb.checked);
                });

                // به‌روزرسانی "انتخاب همه کلی"
                const allIndividualPermissions = form.querySelectorAll('.permission-checkbox');
                if (selectAllGlobal) {
                    selectAllGlobal.checked = allIndividualPermissions.length > 0 && Array.from(allIndividualPermissions).every(cb => cb.checked);
                }
            }

            // مدیریت "انتخاب همه کلی"
            if (selectAllGlobal) {
                selectAllGlobal.addEventListener('change', (e) => {
                    const isChecked = e.target.checked;
                    allPermissionCheckboxes.forEach(cb => cb.checked = isChecked);
                    // After changing individual permissions, all parents need to be updated accordingly
                    allGroupMasters.forEach(cb => cb.checked = isChecked);
                    allModuleMasters.forEach(cb => cb.checked = isChecked);
                });
            }

            // مدیریت "انتخاب همه ماژول"
            allModuleMasters.forEach(moduleMaster => {
                moduleMaster.addEventListener('change', (e) => {
                    const isChecked = e.target.checked;
                    const moduleId = moduleMaster.dataset.moduleId;
                    form.querySelectorAll(`.${moduleId}-checkbox`).forEach(cb => {
                        cb.checked = isChecked;
                    });
                    updateParentCheckboxes();
                });
            });

            // مدیریت "انتخاب همه گروه"
            allGroupMasters.forEach(groupMaster => {
                groupMaster.addEventListener('change', (e) => {
                    const isChecked = e.target.checked;
                    const groupId = groupMaster.dataset.groupId;
                    form.querySelectorAll(`.permission-checkbox.${groupId}-checkbox`).forEach(cb => {
                        cb.checked = isChecked;
                    });
                    updateParentCheckboxes();
                });
            });

            // مدیریت تغییر در چک‌باکس‌های دسترسی انفرادی
            allPermissionCheckboxes.forEach(permissionCb => {
                permissionCb.addEventListener('change', () => {
                    updateParentCheckboxes();
                });
            });

            // فراخوانی اولیه برای تنظیم وضعیت‌ها هنگام بارگذاری صفحه
            // For 'create' page, everything should ideally start unchecked,
            // but calling this ensures consistency if any checkbox somehow starts checked (e.g. browser cache)
            // or if you decide to have default checked permissions in the future.
            updateParentCheckboxes();
        });
    </script>
@endpush
