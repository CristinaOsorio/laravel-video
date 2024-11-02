<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    
    <div class="input-group {{ $errors->has($name) ? 'is-invalid' : '' }}">
        <input 
            type="{{ $type === 'password' ? 'password' : $type }}" 
            name="{{ $name }}" 
            id="{{ $id }}" 
            class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
            aria-describedby="{{ $id }}Feedback"
            value="{{ old($name, $value ?? '') }}" 
            {{ $attributes ?? '' }}
        >
        
        @if($type === 'password')
            <div class="input-group-append">
                <button 
                    type="button" 
                    class="btn btn-outline-secondary" 
                    onclick="togglePasswordVisibility('{{ $id }}')">
                    <i class="fas fa-eye" id="toggleIcon-{{ $id }}"></i>
                </button>
            </div>
        @endif
    </div>

    @if ($errors->has($name))
        <div id="{{ $id }}Feedback" class="invalid-feedback">
            <strong>{{ $errors->first($name) }}</strong>
        </div>
    @endif
</div>

