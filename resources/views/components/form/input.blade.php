<div class="form-group">
    <label class="form-label" for="{{ $name }}">{{ $text }}:
        @if ($required)
            <span class="error error-star">*</span>
        @endif
    </label>
    <input class="form-control" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
        value="{{ $value ?? ($model != '' ? old($name, $model->$name) : old($name)) }}" {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}>
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
