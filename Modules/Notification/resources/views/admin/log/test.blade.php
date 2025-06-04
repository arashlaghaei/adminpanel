@extends('core::admin.layout.master')

@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bold">آزمایش ارسال اعلان</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-light-primary me-3">
                        <i class="ki-duotone ki-arrow-left fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        بازگشت به لیست
                    </a>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <form action="{{ route('admin.notifications.test.send') }}" method="POST">
                @csrf
                
                <div class="row mb-8">
                    <div class="col-md-6">
                        @include('core::components.form.select', [
                            'title' => 'قالب اعلان',
                            'name' => 'template_id',
                            'required' => true,
                            'options' => $templates->pluck('name', 'id')->toArray(),
                            'value' => old('template_id'),
                            'description' => 'قالب اعلانی که می‌خواهید ارسال کنید را انتخاب کنید.'
                        ])
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                @include('core::components.form.select', [
                                    'title' => 'نوع گیرنده',
                                    'name' => 'recipient_type',
                                    'required' => true,
                                    'options' => [
                                        'user' => 'کاربر',
                                        'admin' => 'ادمین',
                                        'customer' => 'مشتری',
                                    ],
                                    'value' => old('recipient_type', 'user'),
                                ])
                            </div>
                            <div class="col-md-8">
                                @include('core::components.form.input', [
                                    'title' => 'شناسه گیرنده',
                                    'name' => 'recipient_id',
                                    'required' => true,
                                    'inputType' => 'number',
                                    'value' => old('recipient_id'),
                                    'description' => 'شناسه کاربر، ادمین یا مشتری را وارد کنید.'
                                ])
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-8">
                    <div class="col-12">
                        <label class="form-label fw-bold">کانال‌های ارسال</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($channels as $channel)
                                        <div class="col-md-3">
                                            <label class="form-check form-check-custom form-check-solid me-10">
                                                <input class="form-check-input h-20px w-20px" type="checkbox" name="channels[]" value="{{ $channel }}" 
                                                    {{ in_array($channel, old('channels', ['database'])) ? 'checked' : '' }}/>
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
                </div>
                
                <div class="row mb-8">
                    <div class="col-12">
                        <div class="card bg-light-primary">
                            <div class="card-body">
                                <p class="fs-6 mb-0">
                                    <i class="ki-duotone ki-information-5 text-primary me-2 fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    اعلان آزمایشی به کاربر مورد نظر ارسال خواهد شد. این اعلان برای تست سیستم اعلان‌رسانی است.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                <i class="ki-duotone ki-send fs-2 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                ارسال اعلان آزمایشی
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
@endsection 