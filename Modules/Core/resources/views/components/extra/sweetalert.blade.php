@if(session('message'))
    @push('scripts')
        <script>
            {{--Swal.fire({--}}
            {{--    title: "{{ session('message.title') }}",--}}
            {{--    text: "{{ session('message.body') }}",--}}
            {{--    icon: "{{ session('message.type') }}",--}}
            {{--    @if(session('message.type') !== 'error' && session('message.timer') == true)--}}
            {{--    timer: 2000,--}}
            {{--    showConfirmButton: false,--}}
            {{--    @else--}}
            {{--    showConfirmButton: true,--}}
            {{--    @endif--}}
            {{--});--}}
            KTUtil.onDOMContentLoaded(function () {
                Swal.fire({
                    title: '{{ session('message.title') }}',
                    text: "{{ session('message.body') }}",
                    icon: "{{ session('message.type') }}",
                    confirmButtonText: "تایید",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    },
                    @if(session('message.type') !== 'error' && session('message.timer') == true)
                    timer: 2000,
                    showConfirmButton: false,
                    @else
                    showConfirmButton: true,
                    @endif
                });
            });
        </script>
    @endpush
    @php session()->forget('message') @endphp
@endif
