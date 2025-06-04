@props([
    'title' => 'انتخاب تاریخ',
    'name' => '',
    'required' => false,
    'value' => '',
    'class' => '',
    'description' => null
])

<label class="{{ $required ? 'required' : '' }} form-label">{{ $title }}</label>

<div class="input-group">
    <input
            type="text"
            id="{{ $name }}"
            name="{{ $name }}"
            class="form-control persian-datepicker {{ $errors->has($name) ? 'is-invalid' : '' }} {{ $class }}"
            placeholder="{{ $title }}"
            value="{{ old($name, $value) }}"
            autocomplete="off"
            {{ $required ? 'required' : '' }}
    >
    <button class="btn btn-primary clear-date" type="button">
        <i class="fa fa-calendar-xmark"></i> پاک کردن
    </button>
</div>

@if($description)
    <div class="text-muted fs-7">{{ $description }}</div>
@endif

@error($name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div>{{ $message }}</div>
</div>
@enderror

@once
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets/panel/plugins/datepicker/persian-datepicker.css')}}">
    @endpush

    @push('scripts')
        <script src="{{asset('assets/panel/plugins/datepicker/persiandate.js')}}"></script>
        <script src="{{asset('assets/panel/plugins/datepicker/persian-datepicker.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.persian-datepicker').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    autoClose: true,
                    toolbox: {
                        calendarSwitch: { enabled: true },
                        todayButton: { enabled: true },
                        submitButton: { enabled: true },
                        clearButton: { enabled: true }
                    },
                    responsive: true,
                    showGregorianDate: true,
                    initialValue: false,
                    observer: true
                });

                $('.clear-date').on('click', function () {
                    $(this).siblings('input').val('');
                });
            });
        </script>
    @endpush
@endonce
