@extends('core::layouts.master')

@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bold">تنظیمات اعلان‌ها</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <form action="{{ route('notifications.preferences.update') }}" method="POST">
                @csrf
                
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
                                    تنظیمات اعلان‌های خود را از این قسمت تغییر دهید. می‌توانید برای هر نوع اعلان، کانال‌های مورد نظر خود را فعال یا غیرفعال کنید.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-300px rounded-start">نوع اعلان</th>
                                <th class="min-w-100px text-center">فعال‌سازی</th>
                                @foreach(array_keys(array_filter(config('notification.channels'))) as $channel)
                                    <th class="min-w-100px text-center">
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
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notificationTypes as $type)
                                @php
                                    $preference = $preferences->where('notification_type', $type['key'])->first();
                                    $isEnabled = $preference ? $preference->is_enabled : true;
                                    $channels = $preference ? $preference->channels : array_keys(array_filter(config('notification.channels')));
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <span class="text-dark fw-bold text-hover-primary fs-6">{{ $type['name'] }}</span>
                                                <input type="hidden" name="preferences[{{ $loop->index }}][notification_type]" value="{{ $type['key'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <label class="form-check form-check-custom form-check-solid form-check-sm">
                                            <input 
                                                class="form-check-input notification-type-toggle" 
                                                type="checkbox" 
                                                name="preferences[{{ $loop->index }}][is_enabled]" 
                                                value="1" 
                                                {{ $isEnabled ? 'checked' : '' }}
                                                data-type-index="{{ $loop->index }}"
                                            >
                                        </label>
                                    </td>
                                    @foreach(array_keys(array_filter(config('notification.channels'))) as $channel)
                                        <td class="text-center">
                                            <label class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input 
                                                    class="form-check-input channel-checkbox type-{{ $loop->parent->index }}" 
                                                    type="checkbox" 
                                                    name="preferences[{{ $loop->parent->index }}][channels][]" 
                                                    value="{{ $channel }}" 
                                                    {{ in_array($channel, $channels) && $isEnabled ? 'checked' : '' }}
                                                    {{ $isEnabled ? '' : 'disabled' }}
                                                >
                                            </label>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="row mt-8">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                <i class="ki-duotone ki-check fs-2 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                ذخیره تنظیمات
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle channel checkboxes based on notification type toggle
        document.querySelectorAll('.notification-type-toggle').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                const typeIndex = this.getAttribute('data-type-index');
                const channelCheckboxes = document.querySelectorAll(`.channel-checkbox.type-${typeIndex}`);
                
                channelCheckboxes.forEach(function(checkbox) {
                    checkbox.disabled = !toggle.checked;
                    if (!toggle.checked) {
                        checkbox.checked = false;
                    }
                });
            });
        });
    });
</script>
@endpush 