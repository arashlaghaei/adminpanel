@extends('core::admin.layout.master')

@push('styles')
    {{-- استایل‌های سفارشی برای تب‌ها --}}
    <style>
        .channel-tab-pane {
            display: none;
        }
        .channel-tab-pane.active {
            display: block;
        }
        .nav-link.active {
            background-color: #f1f1f1;
        }
    </style>
@endpush

@section('content')
    <x-core::form.page-header resource="قالب اعلان" page="ایجاد" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="notification_template_form" class="form d-flex flex-column flex-lg-row" method="post" action="{{ route('admin.notification-templates.store') }}">
                @csrf

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>اطلاعات اصلی</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-6 mb-7">
                                    <x-core::form.input name="name" title="عنوان" required="true" placeholder="مثلا: ارسال کد تایید"/>
                                </div>
                                <div class="col-md-6 mb-7">
                                    <x-core::form.input name="key" title="کلید (Key)" required="true" placeholder="مثلا: verification-code"/>
                                </div>
                                <div class="col-md-6 mb-7">
                                    <x-core::form.input name="notification_type" title="نوع اعلان (Type)" required="true" placeholder="مثلا: App\Notifications\Auth\VerificationCode"/>
                                </div>
                                <div class="col-md-6 mb-7">
                                    <label class="form-check form-switch form-check-custom form-check-solid mt-10">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        <span class="form-check-label fw-semibold text-gray-700">فعال باشد</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::General options-->

                    <!--begin::Content & Actions-->
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>محتوا و عملیات کانال‌ها</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <!--begin::Nav tabs-->
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-b border-gray-300 mb-5" role="tablist">
                                {{-- تب‌ها به صورت داینامیک اینجا اضافه می‌شوند --}}
                            </ul>
                            <!--end::Nav tabs-->

                            <!--begin::Tab content-->
                            <div class="tab-content" id="channel_tab_content">
                                @php($available_channels = array_keys(array_filter(config('notification.channels'))))
                                @php($languages = ['fa' => 'فارسی', 'en' => 'English'])

                                @foreach($available_channels as $channel)
                                    <div class="tab-pane fade" id="tab_pane_{{ $channel }}" role="tabpanel">
                                        <h4 class="mb-5">تنظیمات محتوا برای کانال: <strong class="text-primary">{{ $channel }}</strong></h4>

                                        <!--begin::Content-->
                                        @foreach($languages as $lang_code => $lang_name)
                                            <div class="mb-7">
                                                <label class="form-label">محتوای {{ $lang_name }} ({{ $lang_code }})</label>
                                                <textarea name="content[{{ $channel }}][{{ $lang_code }}]" class="form-control form-control-solid content-editor" rows="3" placeholder="سلام @{{ name }} عزیز ..."></textarea>
                                            </div>
                                        @endforeach
                                        <!--end::Content-->

                                        <div class="separator separator-dashed my-8"></div>

                                        <!--begin::Actions Repeater-->
                                        <div id="actions_repeater_{{ $channel }}">
                                            <h5 class="mb-5">عملیات‌ها (دکمه‌ها)</h5>
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="actions[{{ $channel }}]">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-5">
                                                                <label class="form-label">متن دکمه</label>
                                                                <input type="text" name="button_text" class="form-control form-control-solid mb-2 mb-md-0" placeholder="مثلا: ورود به داشبورد" />
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label class="form-label">لینک دکمه</label>
                                                                <input type="text" name="button_url" class="form-control form-control-solid" placeholder="https://example.com" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    افزودن عملیات
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Actions Repeater-->
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Tab content-->
                        </div>
                    </div>
                    <!--end::Content & Actions-->

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.notification-templates.index') }}" class="btn btn-light me-5">انصراف</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره قالب</span>
                            <span class="indicator-progress">لطفا صبر کنید...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
                <!--end::Main column-->

                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 ms-lg-10">
                    <!--begin::Channels-->
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>کانال‌های ارسال</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            @foreach($available_channels as $channel)
                                <div class="mb-3">
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-20px w-20px channel-toggle" type="checkbox" name="channels[]" value="{{ $channel }}" data-channel-id="{{ $channel }}">
                                        <span class="form-check-label fw-semibold">
                                            @switch($channel)
                                                @case('database') اعلان داخلی @break
                                                @case('mail') ایمیل @break
                                                @case('sms') پیامک @break
                                                @case('whatsapp') واتس‌اپ @break
                                                @case('telegram') تلگرام @break
                                                @case('slack') اسلک @break
                                                @case('discord') دیسکورد @break
                                                @default {{ $channel }}
                                            @endswitch
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Channels-->

                    <!--begin::Variables-->
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>متغیرهای قابل استفاده</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <p class="text-muted fs-7">با کلیک روی هر متغیر، به متن اضافه می‌شود.</p>
                            <div id="variable-buttons">
                                <span class="btn btn-light-info btn-sm me-2 mb-2 variable-btn" data-variable="@{{ name }}">name</span>
                                <span class="btn btn-light-info btn-sm me-2 mb-2 variable-btn" data-variable="@{{ code }}">code</span>
                                <span class="btn btn-light-info btn-sm me-2 mb-2 variable-btn" data-variable="@{{ link }}">link</span>
                                <span class="btn btn-light-info btn-sm me-2 mb-2 variable-btn" data-variable="@{{ user_name }}">user_name</span>
                                <!-- بقیه متغیرها -->
                            </div>
                        </div>
                    </div>
                    <!--end::Variables-->
                </div>
                <!--end::Aside column-->
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- پلاگین Repeater برای مدیریت عملیات‌ها --}}
    <script src="{{ asset('assets/panel/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            let lastFocusedEditor = null;
            const tabContainer = $('.nav-tabs');
            const tabContentContainer = $('#channel_tab_content');

            // مقداردهی اولیه Repeaters برای هر کانال
            @foreach($available_channels as $channel)
            $('#actions_repeater_{{ $channel }}').repeater({
                initEmpty: true,
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                // برای جلوگیری از تداخل name ها
                // name: `actions[{{ $channel }}][{{ $lang_code }}]`
                // این بخش نیاز به تنظیم دقیق‌تر در سمت سرور برای پردازش دارد
                // ساده‌ترین راه این است که repeater یک آرایه ساده بسازد
            });
            @endforeach

            // نمایش/مخفی کردن تب‌ها بر اساس انتخاب کانال
            $('.channel-toggle').on('change', function() {
                const channel = $(this).data('channel-id');
                const channelName = $(this).siblings('.form-check-label').text().trim();

                if ($(this).is(':checked')) {
                    // افزودن تب
                    const newTab = `
                        <li class="nav-item" role="presentation" data-tab-for="${channel}">
                            <a class="nav-link text-active-primary" data-bs-toggle="tab" href="#tab_pane_${channel}" role="tab">${channelName}</a>
                        </li>
                    `;
                    tabContainer.append(newTab);
                    $(`#tab_pane_${channel}`).addClass('channel-tab-pane'); // برای اطمینان
                } else {
                    // حذف تب
                    tabContainer.find(`[data-tab-for="${channel}"]`).remove();
                    $(`#tab_pane_${channel}`).removeClass('active');
                }

                // فعال کردن اولین تب موجود
                tabContainer.find('.nav-link').removeClass('active');
                tabContentContainer.find('.tab-pane').removeClass('active show');

                if(tabContainer.find('.nav-item').length > 0) {
                    tabContainer.find('.nav-item:first .nav-link').addClass('active');
                    const firstTabId = tabContainer.find('.nav-item:first .nav-link').attr('href');
                    $(firstTabId).addClass('active show');
                }
            });

            // ذخیره آخرین ویرایشگر فعال برای درج متغیر
            $('.content-editor').on('focus', function() {
                lastFocusedEditor = $(this);
            });

            // افزودن متغیر به ویرایشگر
            $('.variable-btn').on('click', function() {
                if(lastFocusedEditor) {
                    const variable = $(this).data('variable');
                    const currentVal = lastFocusedEditor.val();
                    const cursorPos = lastFocusedEditor[0].selectionStart;
                    const newVal = currentVal.substring(0, cursorPos) + ' ' + variable + ' ' + currentVal.substring(cursorPos);
                    lastFocusedEditor.val(newVal).focus();

                    // Move cursor after the inserted variable
                    const newCursorPos = cursorPos + variable.length + 2; // +2 for spaces
                    lastFocusedEditor[0].selectionStart = newCursorPos;
                    lastFocusedEditor[0].selectionEnd = newCursorPos;
                } else {
                    Swal.fire({
                        text: "لطفا ابتدا روی یک فیلد محتوا کلیک کنید.",
                        icon: "info",
                        buttonsStyling: false,
                        confirmButtonText: "متوجه شدم!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });

            // به صورت پیش‌فرض کانال database را فعال می‌کنیم
            $('.channel-toggle[value="database"]').prop('checked', true).trigger('change');

        });
    </script>
@endpush
