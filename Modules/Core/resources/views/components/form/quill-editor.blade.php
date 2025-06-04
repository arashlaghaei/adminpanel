@props([
    'title' => 'توضیحات متا تگ',
    'name' => 'meta_description',
    'placeholder' => 'متن خود را وارد کنید...',
    'value' => '',
    'description' => '',
])

<h4>{{ $title }}</h4>

<div class="mb-10">
    <div id="quill-editor-{{ $name }}" class="min-h-100px mb-2 quill-editor">{!! $value !!}</div>
    <textarea name="{{ $name }}" id="quill-input-{{ $name }}" hidden>{{ $value }}</textarea>
    @if($description)
        <div class="text-muted fs-7">{{$description}}</div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let quill = new Quill("#quill-editor-{{ $name }}", {
                modules: {
                    toolbar: [
                        [{ 'font': [] }, { 'size': [] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'direction': 'rtl' }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'sub' }, { 'script': 'super' }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'align': [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ],
                },
                placeholder: "{{ $placeholder }}",
                theme: "snow"
            });

            quill.format("direction", "rtl");
            quill.format("align", "right");

            quill.on("text-change", function () {
                document.querySelector("#quill-input-{{ $name }}").value = quill.root.innerHTML;
            });
        });
    </script>
@endpush
