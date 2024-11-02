<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" 
        {{ $attributes ?? '' }}
    >{{ old($name, $value ?? '') }}</textarea>
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
