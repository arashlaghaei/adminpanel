<label class="{{isset($required)?'required':''}} form-label">{{$title}}</label>
<input
        type="{{isset($input_type)?$input_type:'text'}}"
        name="{{$name}}"
        class="form-control mb-2 {{$errors->has($name)?"is-invalid":""}} {{isset($class)?$class:''}}"
        placeholder="{{$title}}"
        value="{{isset($value)?old($name,$value):old($name)}}"
        {{isset($required)?'required':''}}
/>
@if(isset($description))
    <div class="text-muted fs-7">{{$description}}</div>
@endif

@if ($errors->has($name))
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="email_input" data-validator="emailAddress">
            {{ $errors->first($name) }}
        </div>
    </div>
@endif
