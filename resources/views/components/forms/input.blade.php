<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <input 
        type="{{ $type ?? 'text' }}" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" 
        value="{{ old($name, $value ?? '') }}" 
        {{ $attributes ?? '' }}
    >
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
