{{-- 
    This file can be included in the Core module's master layout to register the notification widget.
    Use it like: @include('notification::components.register')
--}}

@once
    @push('navbar-items')
        @include('notification::components.notification-widget')
    @endpush
@endonce 