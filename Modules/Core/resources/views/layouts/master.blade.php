<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl" >
<head>
    <title>پنل ادمین مترونیک  </title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, حالت تیره, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="پنل ادمین مترونیک  " />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="مترونیک by ساتراس وب" />
    <link rel="stylesheet" rel="canonical" href="{{url('')}}" />
    <link rel="stylesheet" rel="shortcut icon" href="{{asset('assets/panel/media/logos/favicon.ico')}}" />
    <link rel="stylesheet" rel="stylesheet" href="https://fonts.googleapis.com/cssfamily=Inter:300,400,500,600,700" />
    <link rel="stylesheet" href="{{asset('assets/panel/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/panel/plugins/tagify/tagify.css')}}">

</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;

    if ( document.documentElement ) {
        if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if ( localStorage.getItem("data-bs-theme") !== null ) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
            <!--begin::Header container-->
            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                <!--begin::Sidebar mobile toggle-->
                <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="مشاهده">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <!--end::Sidebar mobile toggle-->
                <!--begin::Mobile logo-->
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="index.html" class="d-lg-none">
                        <img alt="Logo" src="{{asset('assets/panel/media/logos/default-small.svg')}}" class="h-30px" />
                    </a>
                </div>
                <!--end::Mobile logo-->
                <!--begin::Header wrapper-->
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                    <!--begin::Menu wrapper-->
                    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Navbar-->
                    <div class="app-navbar flex-shrink-0">
                        <div class="app-navbar-item ms-1 ms-md-4">
                            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" id="kt_activities_toggle">
                                <i class="ki-duotone ki-messages fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </div>
                        </div>
                        <div class="app-navbar-item ms-1 ms-md-4">
                            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                                <i class="ki-duotone ki-notification-status fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </div>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('assets/panel/media/misc/menu-header-bg.jpg')">
                                    <!--begin::Title-->
                                    <h3 class="text-white fw-semibold px-9 mt-10 mb-6">اعلان ها
                                        <span class="fs-8 opacity-75 ps-3">24 گزارش</span></h3>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                                        <li class="nav-item">
                                            <a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1">هشدارها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_2">بروزرسانی ها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_3">گزارش</a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Tab content-->
                                <div class="tab-content">
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade" id="kt_topbar_notifications_1" role="tabpanel">
                                        <!--begin::items-->
                                        <div class="scroll-y mh-325px my-5 px-8">
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
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
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">پروژه آلیس</a>
                                                        <div class="text-gray-500 fs-7">توسعه فاز 1</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">1 ساعت</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-danger">
																	<i class="ki-duotone ki-information fs-2 text-danger">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																	</i>
																</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="mb-0 me-2">
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">محرمانه</a>
                                                        <div class="text-gray-500 fs-7">اسناد محرمانه کارکنان</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">2 ساعت</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<i class="ki-duotone ki-briefcase fs-2 text-warning">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="mb-0 me-2">
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">کمپانی HR</a>
                                                        <div class="text-gray-500 fs-7">مشخصات کارکنان را شریک کنید</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">5 ساعت</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-success">
																	<i class="ki-duotone ki-abstract-12 fs-2 text-success">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="mb-0 me-2">
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">پروژه ریداکس</a>
                                                        <div class="text-gray-500 fs-7">تم ادمین جدید</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">2 روز</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<i class="ki-duotone ki-colors-square fs-2 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																		<span class="path4"></span>
																	</i>
																</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="mb-0 me-2">
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">پروژه بریفینگ</a>
                                                        <div class="text-gray-500 fs-7">به روز رسانی وضعیت راه اندازی محصول</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">21 Jan</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-info">
																	<i class="ki-duotone ki-picture fs-2 text-info"></i>
																</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="mb-0 me-2">
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">دارایی های بنر</a>
                                                        <div class="text-gray-500 fs-7">مجموعه ای از تصویر بنرها</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">21 Jan</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<i class="ki-duotone ki-color-swatch fs-2 text-warning">
																		<span class="path1"></span>
																		<span class="path2"></span>
																		<span class="path3"></span>
																		<span class="path4"></span>
																		<span class="path5"></span>
																		<span class="path6"></span>
																		<span class="path7"></span>
																		<span class="path8"></span>
																		<span class="path9"></span>
																		<span class="path10"></span>
																		<span class="path11"></span>
																		<span class="path12"></span>
																		<span class="path13"></span>
																		<span class="path14"></span>
																		<span class="path15"></span>
																		<span class="path16"></span>
																		<span class="path17"></span>
																		<span class="path18"></span>
																		<span class="path19"></span>
																		<span class="path20"></span>
																		<span class="path21"></span>
																	</i>
																</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Title-->
                                                    <div class="mb-0 me-2">
                                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">نماد دارایی ها</a>
                                                        <div class="text-gray-500 fs-7">مجموعه ای از ایکون ها</div>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">20 March</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                        </div>
                                        <!--end::items-->
                                        <!--begin::نمایش بیشتر-->
                                        <div class="py-3 text-center border-top">
                                            <a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">نمایش همه
                                                <i class="ki-duotone ki-arrow-left fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i></a>
                                        </div>
                                        <!--end::نمایش بیشتر-->
                                    </div>
                                    <!--end::Tab panel-->
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade show active" id="kt_topbar_notifications_2" role="tabpanel">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column px-9">
                                            <!--begin::Section-->
                                            <div class="pt-10 pb-0">
                                                <!--begin::Title-->
                                                <h3 class="text-gray-900 text-center fw-bold">دسترسی حرفه ای را دریافت کنید</h3>
                                                <!--end::Title-->
                                                <!--begin::Text-->
                                                <div class="text-center text-gray-600 fw-semibold pt-1">رئوس مطالب شما را صادق نگه می دارد. آنها جلوی شگفت انگیز بودن شما درمورد رانندگی را می گیرند</div>
                                                <!--end::Text-->
                                                <!--begin::Actions-->
                                                <div class="text-center mt-5 mb-9">
                                                    <a href="#" class="btn btn-sm btn-primary px-6" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">ارتقا دهید</a>
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Section-->
                                            <!--begin::Illustration-->
                                            <div class="text-center px-4">
                                                <img class="mw-100 mh-200px" alt="image" src="{{asset('assets/panel/media/illustrations/sketchy-1/1.png')}}" />
                                            </div>
                                            <!--end::Illustration-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Tab panel-->
                                    <!--begin::Tab panel-->
                                    <div class="tab-pane fade" id="kt_topbar_notifications_3" role="tabpanel">
                                        <!--begin::items-->
                                        <div class="scroll-y mh-325px my-5 px-8">
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-success me-4">200</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">سفارش جدید</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">فقط</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-danger me-4">500</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">مشتری جدید</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">2 ساعت</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-success me-4">200</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">پردازش درگاه</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">5 ساعت</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-warning me-4">300</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">جستجوی کوئری</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">2 روز</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-success me-4">200</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">ارتباط کلید دسترسی</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">1 هفته</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-success me-4">200</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">دیتابیس بازگرداندن</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">Mar 5</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-warning me-4">300</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">بروزرسانی سیستم</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">May 15</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-warning me-4">300</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">اپدیت سیستم عامل سرور</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">Apr 3</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-warning me-4">300</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">برگشت کلید دسترسی</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">Jun 30</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-danger me-4">500</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">روند بازپرداخت</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">Jul 10</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-danger me-4">500</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">روند برداشت</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">Sep 10</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                            <!--begin::item-->
                                            <div class="d-flex flex-stack py-4">
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Code-->
                                                    <span class="w-70px badge badge-light-danger me-4">500</span>
                                                    <!--end::Code-->
                                                    <!--begin::Title-->
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-semibold">وظایف نامه</a>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Section-->
                                                <!--begin::Tags-->
                                                <span class="badge badge-light fs-8">Dec 10</span>
                                                <!--end::Tags-->
                                            </div>
                                            <!--end::item-->
                                        </div>
                                        <!--end::items-->
                                        <!--begin::نمایش بیشتر-->
                                        <div class="py-3 text-center border-top">
                                            <a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">نمایش همه
                                                <i class="ki-duotone ki-arrow-left fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i></a>
                                        </div>
                                        <!--end::نمایش بیشتر-->
                                    </div>
                                    <!--end::Tab panel-->
                                </div>
                                <!--end::Tab content-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu wrapper-->
                        </div>

                        <div class="app-navbar-item ms-1 ms-md-4">
                            <!--begin::Menu toggle-->
                            <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                    <span class="path9"></span>
                                    <span class="path10"></span>
                                </i>
                                <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <!--begin::Menu toggle-->
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-night-day fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
												</span>
                                        <span class="menu-title">روشن</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-moon fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span>
                                        <span class="menu-title">تیره</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
												<span class="menu-icon" data-kt-element="icon">
													<i class="ki-duotone ki-screen fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
												</span>
                                        <span class="menu-title">سیستم</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Theme mode-->

                        <!--begin::کاربر menu-->
                        <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                            <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <img src="{{asset('assets/panel/media/avatars/300-3.jpg')}}" class="rounded-3" alt="user" />
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <div class="symbol symbol-50px me-5">
                                            <img alt="Logo" src="{{asset('assets/panel/media/avatars/300-3.jpg')}}" />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center fs-5">رابرت فاکس
                                                <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">حرفه ای</span></div>
                                            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">robert@kt.com</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">پروفایل من</a>
                                </div>
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">تغییر پسورد</a>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                    <a href="#" class="menu-link px-5">
												<span class="menu-title position-relative">حالت
												<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
													<i class="ki-duotone ki-night-day theme-light-show fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
														<span class="path5"></span>
														<span class="path6"></span>
														<span class="path7"></span>
														<span class="path8"></span>
														<span class="path9"></span>
														<span class="path10"></span>
													</i>
													<i class="ki-duotone ki-moon theme-dark-show fs-2">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>
												</span></span>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-0">
                                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-duotone ki-night-day fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="path4"></span>
																<span class="path5"></span>
																<span class="path6"></span>
																<span class="path7"></span>
																<span class="path8"></span>
																<span class="path9"></span>
																<span class="path10"></span>
															</i>
														</span>
                                                <span class="menu-title">روشن</span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-0">
                                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-duotone ki-moon fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>
                                                <span class="menu-title">تیره</span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-0">
                                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-duotone ki-screen fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
																<span class="path3"></span>
																<span class="path4"></span>
															</i>
														</span>
                                                <span class="menu-title">سیستم</span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">خروج</a>
                                </div>
                            </div>
                            <!--end::کاربر account menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::کاربر menu-->

                        <!--begin::Header menu toggle-->
                        <div class="app-navbar-item d-lg-none ms-2 me-n2" title="header menu">
                            <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
                                <i class="ki-duotone ki-element-4 fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <!--end::Header menu toggle-->
                        <!--begin::کناری toggle-->
                        <!--end::Header menu toggle-->
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Header wrapper-->
            </div>
            <!--end::Header container-->
        </div>
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
            <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <!--begin::Logo-->
                <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                    <!--begin::Logo image-->
                    <a href="{{url('')}}">
                        <img alt="Logo" src="{{asset('assets/panel/media/logos/default-dark.svg')}}" class="h-25px app-sidebar-logo-default" />
                        <img alt="Logo" src="{{asset('assets/panel/media/logos/default-small.svg')}}" class="h-20px app-sidebar-logo-minimize" />
                    </a>
                    <!--end::Logo image-->
                    <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                        <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <!--end::Logo-->
                <!--begin::sidebar menu-->
                <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                    <!--begin::Menu wrapper-->
                    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                        <!--begin::Scroll wrapper-->
                        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                            <!--begin::Menu-->
                            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                                @include('admin.rmenu')
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Scroll wrapper-->
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::sidebar menu-->
                <!--begin::Footer-->
                <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
                    <div class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" >
                        <span class="btn-label">پنل مدیریت</span>
                        <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Sidebar-->

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">چند منظوره</h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="{{url('')}}" class="text-muted text-hover-primary">خانه</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-muted">داشبورد ها</li>
                                </ul>
                            </div>
                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">ریلیز اپلیکیشن</a>
                                <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">افزودن هدف</a>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                <!--end::Content wrapper-->

                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer">
                    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                        <div class="text-gray-900 order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2025&copy;</span>
                            <div class="text-gray-800 text-hover-primary">Arch Developer</div>
                        </div>
                    </div>
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
    </div>
</div>

<!--begin::Reports -->
<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
    <div class="card shadow-none border-0 rounded-0">
        <div class="card-header" id="kt_activities_header">
            <h3 class="card-title fw-bold text-gray-900">گزارش ها</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
            </div>
        </div>
        <div class="card-body position-relative" id="kt_activities_body">
            <div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
                <div class="timeline timeline-border-dashed">
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-message-text-2 fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-5 fw-semibold mb-2">در پروژه اپلیکیشن موبایل  کار جدید برای شما وجود دارد:</div>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">اضافه شده در ساعت 4:12</div>
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                                        <img src="{{ asset('assets/panel/media/avatars/300-14.jpg') }}" alt="img" />
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto pb-5">
                                <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                    <a href="apps/projects/project.html" class="fs-5 text-gray-900 text-hover-primary fw-semibold w-375px min-w-200px">ملاقات با مشتری</a>
                                    <div class="min-w-175px pe-2">
                                        <span class="badge badge-light text-muted">طراح نرم افزار</span>
                                    </div>
                                    <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                                        <div class="symbol symbol-circle symbol-25px">
                                            <img src="{{ asset('assets/panel/media/avatars/300-2.jpg') }}" alt="img" />
                                        </div>
                                        <div class="symbol symbol-circle symbol-25px">
                                            <img src="{{ asset('assets/panel/media/avatars/300-14.jpg') }}" alt="img" />
                                        </div>
                                        <div class="symbol symbol-circle symbol-25px">
                                            <div class="symbol-label fs-8 fw-semibold bg-primary text-inverse-primary">A</div>
                                        </div>
                                    </div>
                                    <div class="min-w-125px pe-2">
                                        <span class="badge badge-light-primary">درحال پردازش</span>
                                    </div>
                                    <a href="apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">نمایش</a>
                                </div>
                                <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-0">
                                    <a href="apps/projects/project.html" class="fs-5 text-gray-900 text-hover-primary fw-semibold w-375px min-w-200px">آماده سازی تحویل پروژه</a>
                                    <div class="min-w-175px">
                                        <span class="badge badge-light text-muted">توسعه دهنده سیستم</span>
                                    </div>
                                    <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px">
                                        <div class="symbol symbol-circle symbol-25px">
                                            <img src="{{ asset('assets/panel/media/avatars/300-20.jpg') }}" alt="img" />
                                        </div>
                                        <div class="symbol symbol-circle symbol-25px">
                                            <div class="symbol-label fs-8 fw-semibold bg-success text-inverse-primary">B</div>
                                        </div>
                                    </div>
                                    <div class="min-w-125px">
                                        <span class="badge badge-light-success">کامل شد</span>
                                    </div>
                                    <a href="apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">نمایش</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon me-4">
                            <i class="ki-duotone ki-flag fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-5 fw-semibold mb-2">دعوت نامه برای ساخت طراحی های جذاب که کارگاه انسانی را بیان می کنند</div>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">ارسال شده در ساعت 4:23</div>
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Alan Nilson">
                                        <img src="{{ asset('assets/panel/media/avatars/300-1.jpg') }}" alt="img" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-disconnect fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <!--begin::تایم لاین heading-->
                            <div class="mb-5 pe-3">
                                <!--begin::Title-->
                                <a href="#" class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">3 پروژه ورودی جدید پرونده ها:</a>
                                <!--end::Title-->
                                <!--begin::توضیحات-->
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <!--begin::Info-->
                                    <div class="text-muted me-2 fs-7">ارسال شده در ساعت 10:30</div>
                                    <!--end::Info-->
                                    <!--begin::user-->
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Jan Hummer">
                                        <img src="{{ asset('assets/panel/media/avatars/300-23.jpg') }}" alt="img" />
                                    </div>
                                    <!--end::user-->
                                </div>
                                <!--end::توضیحات-->
                            </div>
                            <!--end::تایم لاین heading-->
                            <!--begin::تایم لاین details-->
                            <div class="overflow-auto pb-5">
                                <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                    <!--begin::item-->
                                    <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                        <!--begin::Icon-->
                                        <img alt="" class="w-30px me-3" src="{{ asset('assets/panel/media/svg/files/pdf.svg') }}" />
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-1 fw-semibold">
                                            <!--begin::Desc-->
                                            <a href="apps/projects/project.html" class="fs-6 text-hover-primary fw-bold">دارایی، مالیه، سرمایه گذاری </a>
                                            <!--end::Desc-->
                                            <!--begin::شماره کارت-->
                                            <div class="text-gray-500">1.9mb</div>
                                            <!--end::شماره کارت-->
                                        </div>
                                        <!--begin::Info-->
                                    </div>
                                    <!--end::item-->
                                    <!--begin::item-->
                                    <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                        <!--begin::Icon-->
                                        <img alt="apps/projects/project.html" class="w-30px me-3" src="{{ asset('assets/panel/media/svg/files/doc.svg') }}" />
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-1 fw-semibold">
                                            <!--begin::Desc-->
                                            <a href="#" class="fs-6 text-hover-primary fw-bold">مشتری نتایج تست</a>
                                            <!--end::Desc-->
                                            <!--begin::شماره کارت-->
                                            <div class="text-gray-500">18kb</div>
                                            <!--end::شماره کارت-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::item-->
                                    <!--begin::item-->
                                    <div class="d-flex flex-aligns-center">
                                        <!--begin::Icon-->
                                        <img alt="apps/projects/project.html" class="w-30px me-3" src="{{ asset('assets/panel/media/svg/files/css.svg') }}" />
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-1 fw-semibold">
                                            <!--begin::Desc-->
                                            <a href="#" class="fs-6 text-hover-primary fw-bold">دارایی، مالیه، سرمایه گذاری گزارشات</a>
                                            <!--end::Desc-->
                                            <!--begin::شماره کارت-->
                                            <div class="text-gray-500">20mb</div>
                                            <!--end::شماره کارت-->
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::item-->
                                </div>
                            </div>
                            <!--end::تایم لاین details-->
                        </div>
                        <!--end::تایم لاین content-->
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-abstract-26 fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-5 fw-semibold mb-2">وظیفه
                                    <a href="#" class="text-primary fw-bold me-1">#45890</a>ادغام با
                                    <a href="#" class="text-primary fw-bold me-1">#45890</a>داشبورد پروژه ها:</div>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">آغاز شده در 4:23 بعد از ظهر توسط</div>
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                                        <img src="{{ asset('assets/panel/media/avatars/300-14.jpg') }}" alt="img" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-pencil fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-5 fw-semibold mb-2">3 مفهوم جدید طراحی برنامه اضافه شده است:</div>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">ایجاد شده در 4:23 بعد از ظهر توسط</div>
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Marcus Dotson">
                                        <img src="{{ asset('assets/panel/media/avatars/300-2.jpg') }}" alt="img" />
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto pb-5">
                                <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
                                    <div class="overlay me-10">
                                        <div class="overlay-wrapper">
                                            <img alt="img" class="rounded w-150px" src="{{ asset('assets/panel/media/stock/600x400/img-29.jpg') }}" />
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                            <a href="#" class="btn btn-sm btn-primary btn-shadow">کاوش کنید</a>
                                        </div>
                                    </div>
                                    <div class="overlay me-10">
                                        <div class="overlay-wrapper">
                                            <img alt="img" class="rounded w-150px" src="{{ asset('assets/panel/media/stock/600x400/img-31.jpg') }}" />
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                            <a href="#" class="btn btn-sm btn-primary btn-shadow">کاوش کنید</a>
                                        </div>
                                    </div>
                                    <div class="overlay">
                                        <div class="overlay-wrapper">
                                            <img alt="img" class="rounded w-150px" src="{{ asset('assets/panel/media/stock/600x400/img-40.jpg') }}" />
                                        </div>
                                        <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                            <a href="#" class="btn btn-sm btn-primary btn-shadow">کاوش کنید</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::تایم لاین content-->
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-sms fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="تایم لاین-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-5 fw-semibold mb-2">کیس جدید
                                    <a href="#" class="text-primary fw-bold me-1">#67890</a>در پروژه چند پلتفرمی دیتابیس دیزاین به شما واگذار شده است</div>
                                <div class="overflow-auto pb-5">
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <div class="text-muted me-2 fs-7">اضافه شده در ساعت 4:12</div>
                                        <a href="#" class="text-primary fw-bold me-1">رضا علی ابادی</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-pencil fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-5 fw-semibold mb-2">رسید به دست شما سفارش جدید</div>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">در 5:05 صبح توسط</div>
                                    <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Robert Rich">
                                        <img src="{{ asset('assets/panel/media/avatars/300-4.jpg') }}" alt="img" />
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto pb-5">
                                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                                    <i class="ki-duotone ki-devices-2 fs-2tx text-primary me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                        <div class="mb-3 mb-md-0 fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">پردازش دیتابی کامل شد</h4>
                                            <div class="fs-6 text-gray-700 pe-7">وارد ادمین داشبورد شوید تا مطمئن شوید که یکپارچگی داده ها موفق است</div>
                                        </div>
                                        <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap">پردازش</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <i class="ki-duotone ki-basket fs-2 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div class="timeline-content mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-5 fw-semibold mb-2">سفارش جدید
                                    <a href="#" class="text-primary fw-bold me-1">#67890</a>برای برنامه ریزی کارگاه و برآورد بودجه قرار داده شده است</div>
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <div class="text-muted me-2 fs-7">در ساعت 4:23 بعد از ظهر توسط</div>
                                    <a href="#" class="text-primary fw-bold me-1">محسن علی ابادی</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer py-5 text-center" id="kt_activities_footer">
            <a href="pages/user-profile/activity.html" class="btn btn-bg-body text-primary">نمایش تمام فعالیت ها
                <i class="ki-duotone ki-arrow-left fs-3 text-primary">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </a>
        </div>
    </div>
</div>
<!--end::Reports drawer-->


<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up">
        <span class="path1"></span>
        <span class="path2"></span>
    </i>
</div>
<!--end::Scrolltop-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/panel/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('assets/panel/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/panel/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{asset('assets/panel/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/index.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/xy.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/xy.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/radar.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/animated.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/map.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/worldlow.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/continentsLow.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/usaLow.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/worldTimeZonesLow.js')}}"></script>
<script src="{{asset('assets/panel/plugins/amcharts/worldTimeZoneAreasLow.js')}}"></script>
<script src="{{asset('assets/panel/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/panel/plugins/tagify/tagify.js')}}"></script>

<script src="{{asset('assets/panel/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/panel/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/panel/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/panel/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/panel/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('assets/panel/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{asset('assets/panel/js/custom/utilities/modals/users-search.js')}}"></script>
</body>
</html>