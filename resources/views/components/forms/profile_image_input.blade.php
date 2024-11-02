<div class="text-center">
    <img 
        id="image-preview-{{ $id }}" 
        src="{{ $imagePath }}" 
        alt="Vista previa de {{ strtolower($label) }}" 
        class="rounded-circle img-thumbnail object-cover"
        style="width: 150px; height: 150px;"
    >

    <div class="mt-2">
        <label for="{{ $id }}" class="btn btn-outline-primary btn-sm" aria-live="polite">
            <span id="file-name-{{ $id }}">Cambiar Imagen</span>
        </label>
        <input 
            type="file" 
            name="{{ $name }}" 
            id="{{ $id }}" 
            class="d-none" 
            accept="image/*"
            onchange="previewImage(event, 'image-preview-{{ $id }}', 'file-name-{{ $id }}')"
        >
    </div>
</div>
