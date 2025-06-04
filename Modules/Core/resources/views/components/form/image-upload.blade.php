@props([
    'title' => 'تصویر شاخص',
    'name' => 'image',
    'image' => null,
])

<h4>{{ $title }}</h4>

<!--begin::Image input-->
<div id="image-input-{{ $name }}" class="image-input image-input-outline {{ $image ? '' : 'image-input-empty' }}" data-kt-image-input="true">
    <!--begin::Image preview wrapper-->
    <div class="image-input-wrapper w-150px h-150px"
         style="background-image: url('{{ $image ? asset($image) : asset('/assets/panel/media/svg/files/blank-image-dark.svg') }}');">
    </div>
    <!--end::Image preview wrapper-->

    <!--begin::Edit button-->
    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-30px h-30px bg-body shadow"
           data-kt-image-input-action="change"
           data-bs-toggle="tooltip"
           title="تعویض تصویر">
        <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
        <input type="file" name="{{ $name }}" accept=".png, .jpg, .jpeg" />
        <input type="hidden" name="{{ $name }}_remove" />
    </label>
    <!--end::Edit button-->

    <!--begin::Remove button-->
    <span class="btn btn-icon btn-circle btn-active-color-primary w-30px h-30px bg-body shadow remove-image"
          data-kt-image-input-action="remove"
          data-bs-toggle="tooltip"
          title="حذف تصویر"
          style="{{ $image ? '' : 'display: none;' }}">
        <i class="ki-outline ki-cross fs-2x"></i>
    </span>
    <!--end::Remove button-->
</div>
<!--end::Image input-->

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let imageInputContainer = document.getElementById('image-input-{{ $name }}');
            let imageWrapper = imageInputContainer.querySelector(".image-input-wrapper");
            let fileInput = imageInputContainer.querySelector("input[type='file']");
            let removeButton = imageInputContainer.querySelector("[data-kt-image-input-action='remove']");
            let hiddenRemoveInput = imageInputContainer.querySelector("input[name='{{ $name }}_remove']");

            // ✅ تابعی برای دریافت تصویر پیش‌فرض بر اساس تم
            function getDefaultImage() {
                let mode = KTThemeMode.getMode();
                return mode === 'dark'
                    ? '{{ asset('/assets/panel/media/svg/files/blank-image-dark.svg') }}'
                    : '{{ asset('/assets/panel/media/svg/files/blank-image.svg') }}';
            }

            // ✅ تنظیم تصویر پیش‌فرض هنگام لود شدن صفحه
            if (!'{{ $image }}') {
                imageWrapper.style.backgroundImage = `url(${getDefaultImage()})`;
            }

            // ✅ کلیک روی تصویر، باز شدن انتخابگر فایل
            imageWrapper.addEventListener("click", function () {
                fileInput.click();
            });

            // ✅ حذف تصویر
            removeButton.addEventListener("click", function () {
                imageWrapper.style.backgroundImage = `url(${getDefaultImage()})`;
                removeButton.style.display = "none";
                hiddenRemoveInput.value = "1";
                imageInputContainer.classList.add("image-input-empty");
            });

            // ✅ مدیریت دکمه حذف پس از انتخاب تصویر جدید
            fileInput.addEventListener("change", function () {
                if (fileInput.files.length > 0) {
                    removeButton.style.display = "block"; // دکمه حذف را فعال کن
                    imageInputContainer.classList.remove("image-input-empty");
                }
            });

            // ✅ راه‌اندازی مجدد کامپوننت متروتیک
            KTImageInput.createInstances();
        });
    </script>
@endpush
