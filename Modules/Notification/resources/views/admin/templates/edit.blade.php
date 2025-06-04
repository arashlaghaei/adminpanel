@extends('core::admin.layout.master')

@section('content')
    <x-core::form.page-header resource="قالب اعلان" page="ویرایش" />

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form class="form" method="post" action="{{ route('admin.notification-templates.update', $template->id) }}">
                @csrf
                @method('PUT')
                <div class="card card-flush py-4">
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
                            <div class="col-md-6 mb-7">
                                <label class="required form-label">کانال‌ها</label>
                                <select name="channels[]" class="form-select" data-control="select2" data-placeholder="انتخاب کنید" multiple required>
                                    <option value="database" {{ in_array('database', $template->channels ?? []) ? 'selected' : '' }}>database</option>
                                    <option value="mail" {{ in_array('mail', $template->channels ?? []) ? 'selected' : '' }}>mail</option>
                                    <option value="sms" {{ in_array('sms', $template->channels ?? []) ? 'selected' : '' }}>sms</option>
                                    <option value="whatsapp" {{ in_array('whatsapp', $template->channels ?? []) ? 'selected' : '' }}>whatsapp</option>
                                    <option value="telegram" {{ in_array('telegram', $template->channels ?? []) ? 'selected' : '' }}>telegram</option>
                                </select>
                            </div>
                            <div class="col-12 mb-7">
                                <label class="form-label">محتوا (JSON)</label>
                                <textarea name="content" class="form-control" rows="4">{{ old('content', json_encode($template->content)) }}</textarea>
                            </div>
                            <div class="col-12 mb-7">
                                <label class="form-label">عملیات (JSON)</label>
                                <textarea name="actions" class="form-control" rows="4">{{ old('actions', json_encode($template->actions)) }}</textarea>
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
