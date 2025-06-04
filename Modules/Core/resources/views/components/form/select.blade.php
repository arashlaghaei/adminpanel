@props([
    'title' => '',
    'name' => '',
    'options' => [],
    'required' => false,
    'value' => null,
    'class' => '',
    'description' => null,
    'searchable' => false
])

<label class="{{ $required ? 'required' : '' }} form-label">{{ $title }}</label>

<select
        name="{{ $name }}"
        class="form-select mb-2 {{ $class }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
        data-control="select2"
        data-placeholder="انتخاب کنید"
        {{ !$searchable ? 'data-hide-search=true' : '' }}
        {{ $required ? 'required' : '' }}
>
    <option></option>
    @foreach($options as $key => $option)
        <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>
            {{ $option }}
        </option>
    @endforeach
</select>

@if($description)
    <div class="text-muted fs-7">{{ $description }}</div>
@endif

@error($name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div>{{ $message }}</div>
</div>
@enderror
