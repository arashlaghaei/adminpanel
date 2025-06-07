@extends('core::admin.layout.master')

@section('content')
    <x-core::form.page-header resource="قالب اعلان" page="ویرایش" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form class="form" method="post" action="{{ route('admin.notification-templates.update', $template->id) }}">
                @csrf
                @method('PUT')
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>ویرایش قالب اعلان</h2>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.notification-templates.index') }}" class="btn btn-light-primary">
                                <i class="ki-duotone ki-arrow-left fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                بازگشت به لیست
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 mb-7">
                                <x-core::form.input name="name" title="عنوان" required="true" :value="$template->name" />
                            </div>
                            <div class="col-md-6 mb-7">
                                <x-core::form.input name="key" title="کلید" required="true" :value="$template->key" />
                            </div>
                            <div class="col-md-6 mb-7">
                                <x-core::form.input name="notification_type" title="نوع" required="true" :value="$template->notification_type" />
                            </div>
                            <div class="col-12 mb-7">
                                <label class="required form-label mb-2">کانال‌ها</label>
                                @php($channels = array_keys(array_filter(config('notification.channels'))))
                                <div class="card bg-light">
                                    <div class="card-body py-3">
                                        <div class="row">
                                            @foreach($channels as $channel)
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-check form-check-custom form-check-solid me-10">
                                                        <input class="form-check-input h-20px w-20px" type="checkbox" name="channels[]" value="{{ $channel }}" {{ in_array($channel, old('channels', $template->channels ?? ['database'])) ? 'checked' : '' }}>
                                                        <span class="form-check-label fw-semibold">
                                                            @switch($channel)
                                                                @case('database')
                                                                    اعلان داخلی
                                                                    @break
                                                                @case('mail')
                                                                    ایمیل
                                                                    @break
                                                                @case('sms')
                                                                    پیامک
                                                                    @break
                                                                @case('whatsapp')
                                                                    واتس‌اپ
                                                                    @break
                                                                @case('telegram')
                                                                    تلگرام
                                                                    @break
                                                                @case('slack')
                                                                    اسلک
                                                                    @break
                                                                @case('discord')
                                                                    دیسکورد
                                                                    @break
                                                                @default
                                                                    {{ $channel }}
                                                            @endswitch
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-7">
                                <label class="form-label">محتوا (JSON)</label>
                                <textarea name="content" class="form-control font-monospace" rows="4" placeholder="{\n    \"title\": \"...\"\n}">{{ old('content', json_encode($template->content)) }}</textarea>
                            </div>
                            <div class="col-12 mb-7">
                                <label class="form-label">عملیات (JSON)</label>
                                <textarea name="actions" class="form-control font-monospace" rows="4" placeholder="[]">{{ old('actions', json_encode($template->actions)) }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $template->is_active ? 'checked' : '' }}>
                                    <span class="form-check-label">فعال باشد</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2 me-2"></i> ذخیره
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
