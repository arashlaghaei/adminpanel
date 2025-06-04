@props([
    'title' => '',
    'name' => '',
    'inputType' => 'text',
    'required' => false,
    'value' => '',
    'class' => '',
    'description' => null
])

<label class="{{ $required ? 'required' : '' }} form-label">{{ $title }}</label>

<input
        type="{{ $inputType }}"
        name="{{ $name }}"
        class="form-control mb-2 {{ $errors->has($name) ? 'is-invalid' : '' }} {{ $class }}"
        placeholder="{{ $title }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
/>

@if($description)
    <div class="text-muted fs-7">{{ $description }}</div>
@endif

@error($name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div>{{ $message }}</div>
</div>
@enderror
