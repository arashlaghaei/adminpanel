@extends('core::admin.layout.master')

@section('content')

    <x-core::form.page-header resource="پروفایل" page="ویرایش" not-breadcrumbs="true" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form class="form d-flex flex-column flex-lg-row" method="post" action="{{route('core.web.admin.user.changePassword.store')}}"  enctype="multipart/form-data" >
                {{ csrf_field() }}


                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>ویرایش پروفایل</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">

                            <div class="row">
                                <x-core::form.input name="current_password" title="پسورد قبلی" class="dleft"/>
                                <div class="clearfix mb-7"></div>
                            </div>

                            <div class="fv-row" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <label class="form-label fw-semibold fs-6 mb-2">
                                        پسورد جدید
                                    </label>

                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid dleft" type="password" placeholder="" name="new_password" autocomplete="off" />

                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                              data-kt-password-meter-control="visibility">
                    <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                    <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            </span>
                                    </div>

                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                </div>
                                @error('new_password')
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <div>{{ $message }}</div>
                                </div>
                                @enderror

                                <div class="text-muted">
                                    برای انتخاب گذرواژه جدید، از ۸ کاراکتر یا بیشتر با ترکیبی از حروف، اعداد و نمادها  و یک حروف بزرگ استفاده کنید.
                                </div>
                                <div class="text-muted">
                                    مثال:
                                    Password@123
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <a href="{{route('core.web.admin.dashboard')}}" class="btn btn-light me-5">انصراف</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره تغییرات</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .translate-middle {
            transform: translate(-50%, -50%) !important;
        }
        .end-0 {
            right: 0 !important;
        }
    </style>
@endpush