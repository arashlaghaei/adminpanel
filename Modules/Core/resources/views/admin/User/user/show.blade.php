@extends('core::admin.layout.master')

@section('content')

    <x-core::form.page-header resource="کاربر" page="نمایش" />


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                @if($user->picture)
                                    <img src="{{asset($user->picture)}}" alt="image" />
                                @else
                                    <div class="symbol-label fs-3 bg-light-primary text-primary">
                                        {{ $user->initials }}
                                    </div>
                                @endif
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$user->first_name .' '. $user->last_name}}</a>
                                        <a href="#">
                                            <i class="ki-duotone ki-verify fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <div class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>{{$user->typeTranslate}}</div>

                                        <div class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                            <i class="ki-duotone ki-sms fs-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{$user->email}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-semibold fs-6 text-gray-500">تکمیل پروفایل</span>
                                        <span class="fw-bold fs-6">50%</span>
                                    </div>
                                    <div class="h-5px mx-3 w-100 bg-light mb-3">
                                        <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">مشخصات کاربر</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">پروفایل جزییات</h3>
                            </div>
                            <a href="{{route(getNamePage('edit'),1)}}" class="btn btn-sm btn-primary align-self-center">ویرایش کاربر</a>
                        </div>
                        <div class="card-body p-9">
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">نام</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{$user->first_name}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">نام خانوادگی</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{$user->last_name}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">نام کاربری</label>
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">{{$user->username}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">ایمیل</label>
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">{{$user->email}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">موبایل
                                    <span class="ms-1" data-bs-toggle="tooltip" title="شماره موبایل باید فعال باشد">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">{{$user->mobile}}</span>
                                    <span class="badge badge-success">تایید شده</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">تلفن
                                    <span class="ms-1" data-bs-toggle="tooltip" title="شماره تلفن باید فعال باشد">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">{{$user->phone}}</span>
                                    <span class="badge badge-success">تایید شده</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">جنسیت</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">{{$user->gender == 'male' ? 'مرد':'زن'}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">تاریخ تولد</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">{{toPersian($user->birth_date)}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">محل تولد</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">{{$user->birth_place}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">آدرس</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">{{$user->address}}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">وضعیت کاربر</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">{{$user->StatusText}}</span>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="kt_ecommerce_add_product_general2" role="tab-panel">
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::کارت header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::کارت title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">پروفایل جزییات 22</h3>
                            </div>
                            <!--end::کارت title-->
                            <!--begin::Actions-->
                            <a href="account/settings.html" class="btn btn-sm btn-primary align-self-center"> پروفایل</a>
                            <!--end::Actions-->
                        </div>
                        <!--begin::کارت header-->
                        <!--begin::کارت body-->
                        <div class="card-body p-9">
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">نام کامل</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">جلالی</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">کمپانی</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">ساتراس وب</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">تماس با ما تلفن
                                    <span class="ms-1" data-bs-toggle="tooltip" title="شماره تلفن باید فعال باشد">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">044 3276 454 935</span>
                                    <span class="badge badge-success">تایید شده</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">سایت کمپانی</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">keenthemes.com</a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">کشور
                                    <span class="ms-1" data-bs-toggle="tooltip" title="کشور of یاigination">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">المان</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">ارتباط</label>
                                <!--end::Tags-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">ایمیل, تلفن</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-10">
                                <!--begin::Tags-->
                                <label class="col-lg-4 fw-semibold text-muted">همه</label>
                                <!--begin::Tags-->
                                <!--begin::Tags-->
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">بله</span>
                                </div>
                                <!--begin::Tags-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">ما به توجه شما نیاز داریم</h4>
                                        <div class="fs-6 text-gray-700">پرداخت شما رد شد. لطفاً برای شروع استفاده از ابزارها
                                            <a class="fw-bold" href="account/billing.html">روش پرداخت</a>.</div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::کارت body-->
                    </div>
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-8 mb-xl-10">
                            <!--begin::Chart widget 5-->
                            <div class="card card-flush h-lg-100">
                                <!--begin::Header-->
                                <div class="card-header flex-nowrap pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">پرفروش ترین دسته بندی ها</span>
                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">8 هزار بازدید اجتماعی</span>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                            <i class="ki-duotone ki-dots-square fs-1 text-gray-500 me-n1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </button>
                                        <!--begin::Menu 2-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mb-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">تیکت جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">جدید مشتری</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                <!--begin::Menu item-->
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">گروه جدید</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--end::Menu item-->
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator mt-3 opacity-75"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3 py-3">
                                                    <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 2-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-5 ps-6">
                                    <div id="kt_charts_widget_5" class="min-h-auto"></div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Chart widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-4 mb-5 mb-xl-10">
                            <!--begin::Engage widget 1-->
                            <div class="card h-md-100" dir="ltr">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column flex-center">
                                    <!--begin::Heading-->
                                    <div class="mb-2">
                                        <!--begin::Title-->
                                        <h1 class="fw-semibold text-gray-800 text-center lh-lg">آیا سعی کرده ای
                                            <br />جدید
                                            <span class="fw-bolder">نرم افزار موبایل</span></h1>
                                        <!--end::Title-->
                                        <!--begin::Illustration-->
                                        <div class="py-10 text-center">
                                            <img src="assets/media/svg/illustrations/easy/1.svg" class="theme-light-show w-200px" alt="" />
                                            <img src="assets/media/svg/illustrations/easy/1-dark.svg" class="theme-dark-show w-200px" alt="" />
                                        </div>
                                        <!--end::Illustration-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Links-->
                                    <div class="text-center mb-1">
                                        <!--begin::Link-->
                                        <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_create_app" data-bs-toggle="modal">تلاش مجدد</a>
                                        <!--end::Link-->
                                        <!--begin::Link-->
                                        <a class="btn btn-sm btn-light" href="apps/invoices/view/invoice-1.html">آموزش بیشتر</a>
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Links-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <!--begin::لیست widget 5-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">محصولات تحویل</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">1 میلیون محصول ارسال شده</span>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <a href="apps/ecommerce/sales/details.html" class="btn btn-sm btn-light">جزییات سفارش</a>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Scroll-->
                                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                                        <!--begin::item-->
                                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-stack mb-3">
                                                <!--begin::Wrapper-->
                                                <div class="me-3">
                                                    <!--begin::Icon-->
                                                    <img src="assets/media/stock/ecommerce/210.png" class="w-50px ms-n1 me-1" alt="" />
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">فیل 1802</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Actions-->
                                                <div class="m-0">
                                                    <!--begin::Menu-->
                                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">تیکت جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">جدید مشتری</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">گروه جدید</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::مشتری-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::نام-->
                                                <span class="text-gray-500 fw-bold">به:
																<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">جیسون بورن</a></span>
                                                <!--end::نام-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light-success">سفارش داده شده</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::مشتری-->
                                        </div>
                                        <!--end::item-->
                                        <!--begin::item-->
                                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-stack mb-3">
                                                <!--begin::Wrapper-->
                                                <div class="me-3">
                                                    <!--begin::Icon-->
                                                    <img src="assets/media/stock/ecommerce/209.png" class="w-50px ms-n1 me-1" alt="" />
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">لباس</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Actions-->
                                                <div class="m-0">
                                                    <!--begin::Menu-->
                                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">تیکت جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">جدید مشتری</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">گروه جدید</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::مشتری-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::نام-->
                                                <span class="text-gray-500 fw-bold">به:
																<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">مریم رجبی</a></span>
                                                <!--end::نام-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light-primary">حمل دریایی</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::مشتری-->
                                        </div>
                                        <!--end::item-->
                                        <!--begin::item-->
                                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-stack mb-3">
                                                <!--begin::Wrapper-->
                                                <div class="me-3">
                                                    <!--begin::Icon-->
                                                    <img src="assets/media/stock/ecommerce/214.png" class="w-50px ms-n1 me-1" alt="" />
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">تی شرت زرد</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Actions-->
                                                <div class="m-0">
                                                    <!--begin::Menu-->
                                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">تیکت جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">جدید مشتری</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">گروه جدید</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::مشتری-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::نام-->
                                                <span class="text-gray-500 fw-bold">به:
																<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">علی کاربر</a></span>
                                                <!--end::نام-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light-danger">تایید شده</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::مشتری-->
                                        </div>
                                        <!--end::item-->
                                        <!--begin::item-->
                                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-stack mb-3">
                                                <!--begin::Wrapper-->
                                                <div class="me-3">
                                                    <!--begin::Icon-->
                                                    <img src="assets/media/stock/ecommerce/211.png" class="w-50px ms-n1 me-1" alt="" />
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">فیل 1802</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Actions-->
                                                <div class="m-0">
                                                    <!--begin::Menu-->
                                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">تیکت جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">جدید مشتری</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">گروه جدید</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::مشتری-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::نام-->
                                                <span class="text-gray-500 fw-bold">به:
																<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">محمد ابراهیمی</a></span>
                                                <!--end::نام-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light-success">سفارش داده شده</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::مشتری-->
                                        </div>
                                        <!--end::item-->
                                        <!--begin::item-->
                                        <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-stack mb-3">
                                                <!--begin::Wrapper-->
                                                <div class="me-3">
                                                    <!--begin::Icon-->
                                                    <img src="assets/media/stock/ecommerce/215.png" class="w-50px ms-n1 me-1" alt="" />
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">لباس</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Actions-->
                                                <div class="m-0">
                                                    <!--begin::Menu-->
                                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">تیکت جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">جدید مشتری</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">گروه جدید</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::مشتری-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::نام-->
                                                <span class="text-gray-500 fw-bold">به:
																<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">محمد رضایی</a></span>
                                                <!--end::نام-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light-primary">حمل دریایی</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::مشتری-->
                                        </div>
                                        <!--end::item-->
                                        <!--begin::item-->
                                        <div class="border border-dashed border-gray-300 rounded px-7 py-3">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-stack mb-3">
                                                <!--begin::Wrapper-->
                                                <div class="me-3">
                                                    <!--begin::Icon-->
                                                    <img src="assets/media/stock/ecommerce/192.png" class="w-50px ms-n1 me-1" alt="" />
                                                    <!--end::Icon-->
                                                    <!--begin::Title-->
                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bold">تی شرت زرد</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Actions-->
                                                <div class="m-0">
                                                    <!--begin::Menu-->
                                                    <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                        <i class="ki-duotone ki-dots-square fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </button>
                                                    <!--begin::Menu 2-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">عملیات سریع</div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mb-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">تیکت جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">جدید مشتری</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                                            <!--begin::Menu item-->
                                                            <a href="#" class="menu-link px-3">
                                                                <span class="menu-title">گروه جدید</span>
                                                                <span class="menu-arrow"></span>
                                                            </a>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu sub-->
                                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه مدیر</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه کارکنان</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link px-3">گروه عضوها</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu sub-->
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">مخاطبین جدید</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu separator-->
                                                        <div class="separator mt-3 opacity-75"></div>
                                                        <!--end::Menu separator-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <div class="menu-content px-3 py-3">
                                                                <a class="btn btn-primary btn-sm px-4" href="#">گزارش ایجاد کنید</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu 2-->
                                                    <!--end::Menu-->
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::مشتری-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::نام-->
                                                <span class="text-gray-500 fw-bold">به:
																<a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bold">اتنا رضایی</a></span>
                                                <!--end::نام-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light-danger">تایید شده</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::مشتری-->
                                        </div>
                                        <!--end::item-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::لیست widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <!--begin::Table Widget 5-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::کارت header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">گزارش سهام</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">کل 2,356 قلم موجود در انبار</span>
                                    </h3>
                                    <!--end::Title-->
                                    <!--begin::Actions-->
                                    <div class="card-toolbar">
                                        <!--begin::فیلترها-->
                                        <div class="d-flex flex-stack flex-wrap gap-4">
                                            <!--begin::Destination-->
                                            <div class="d-flex align-items-center fw-bold">
                                                <!--begin::Tags-->
                                                <div class="text-muted fs-7 me-2">دسته بندی</div>
                                                <!--end::Tags-->
                                                <!--begin::انتخاب-->
                                                <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="انتخاب ">
                                                    <option></option>
                                                    <option value="مشاهده همه" selected="selected">مشاهده همه</option>
                                                    <option value="a">دسته بندی A</option>
                                                    <option value="b">دسته بندی B</option>
                                                </select>
                                                <!--end::انتخاب-->
                                            </div>
                                            <!--end::Destination-->
                                            <!--begin::وضعیت-->
                                            <div class="d-flex align-items-center fw-bold">
                                                <!--begin::Tags-->
                                                <div class="text-muted fs-7 me-2">وضعیت</div>
                                                <!--end::Tags-->
                                                <!--begin::انتخاب-->
                                                <select class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="انتخاب " data-kt-table-widget-5="filter_status">
                                                    <option></option>
                                                    <option value="مشاهده همه" selected="selected">مشاهده همه</option>
                                                    <option value="موجود">موجود</option>
                                                    <option value="ناموجود">ناموجود</option>
                                                    <option value="موجودی کم">موجودی کم</option>
                                                </select>
                                                <!--end::انتخاب-->
                                            </div>
                                            <!--end::وضعیت-->
                                            <!--begin::جستجو-->
                                            <a href="apps/ecommerce/catalog/products.html" class="btn btn-light btn-sm">نمایش </a>
                                            <!--end::جستجو-->
                                        </div>
                                        <!--begin::فیلترها-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::کارت header-->
                                <!--begin::کارت body-->
                                <div class="card-body">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                        <!--begin::Table head-->
                                        <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-150px">آیتم</th>
                                            <th class="text-end pe-3 min-w-100px">محصولات شناسه</th>
                                            <th class="text-end pe-3 min-w-150px">تاریخ افزودن</th>
                                            <th class="text-end pe-3 min-w-100px">قیمت</th>
                                            <th class="text-end pe-3 min-w-100px">وضعیت</th>
                                            <th class="text-end pe-0 min-w-75px">تعداد</th>
                                        </tr>
                                        <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Macbook Air M1</a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#XGY-356</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">02 Apr, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$1,230</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="58">
                                                <span class="text-gray-900 fw-bold">58 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Surface Laptop 4</a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#YHD-047</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">01 Apr, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$1,060</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-danger">ناموجود</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="0">
                                                <span class="text-gray-900 fw-bold">0 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Logitech MX 250</a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#SRR-678</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">24 Mar, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$64</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="290">
                                                <span class="text-gray-900 fw-bold">290 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">موتور صوتی HD3</a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#PXF-578</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">24 Mar, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$1,060</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-danger">ناموجود</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="46">
                                                <span class="text-gray-900 fw-bold">46 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">HP Hyper LTR</a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#PXF-778</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">16 Jan, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$4500</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="78">
                                                <span class="text-gray-900 fw-bold">78 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary">Dell 32</a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#XGY-356</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">22 Dec, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$1,060</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-warning">موجودی کم</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="8">
                                                <span class="text-gray-900 fw-bold">8 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        <tr>
                                            <!--begin::item-->
                                            <td>
                                                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-900 text-hover-primary"> Pixel 6 </a>
                                            </td>
                                            <!--end::item-->
                                            <!--begin::محصولات شناسه-->
                                            <td class="text-end">#XVR-425</td>
                                            <!--end::محصولات شناسه-->
                                            <!--begin::تاریخ added-->
                                            <td class="text-end">27 Dec, 2024</td>
                                            <!--end::تاریخ added-->
                                            <!--begin::قیمت-->
                                            <td class="text-end">$1,060</td>
                                            <!--end::قیمت-->
                                            <!--begin::وضعیت-->
                                            <td class="text-end">
                                                <span class="badge py-3 px-4 fs-7 badge-light-primary">موجود</span>
                                            </td>
                                            <!--end::وضعیت-->
                                            <!--begin::تعداد-->
                                            <td class="text-end" data-order="124">
                                                <span class="text-gray-900 fw-bold">124 مورد</span>
                                            </td>
                                            <!--end::تعداد-->
                                        </tr>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::کارت body-->
                            </div>
                            <!--end::Table Widget 5-->
                        </div>
                        <!--end::Col-->
                    </div>

                </div>
            </div>


        </div>
    </div>


@endsection
