@section('css')
    <style>
        /* Estilos generales para el formulario */
        .upload-form {
            max-width: 600px;
            margin: auto;
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Encabezado del formulario */
        .upload-form h2 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            font-weight: bold;
            text-align: center;
            color: #333;
        }
        
        /* Subtítulo del formulario */
        .upload-form p {
            font-size: 1rem;
            color: #666;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        /* Estilos de input */
        .form-control,
        .custom-select {
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        /* Indicador de caracteres en el campo de descripción */
        .char-counter {
            font-size: 0.875rem;
            color: #999;
            text-align: right;
        }

        /* Botones */
        .btn-upload,
        .btn-cancel {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        /* Vista previa de miniatura */
        .image-preview {
            display: block;
            width: 200px;
            height: 140px;
            object-fit: cover;
            margin-top: 1rem;
            border-radius: 5px;
        }

        /* Vista previa de video */
        .video-preview {
            display: block;
            width: 100%;
            height: 20rem;
            margin-top: 1rem;
            border-radius: 5px;
        }
    </style>
@endsection
<div class="upload-form">
    <h2>{{ $formTitle ?? trans('videos.video_form.title') }}</h2>
    <p>{{ $formSubtitle ?? trans('videos.video_form.subtitle') }}</p>

    <form id="videoUploadForm" action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($isEdit) && $isEdit)
            @method('PUT')
        @endif

        <!-- Errors -->
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Campo Título del video -->
        <div class="form-group">
            <label for="title">{{ trans('videos.video_form.form.title') }}</label>
            <input type="text" id="title" name="title" 
                   value="{{ old('title', $video->title ?? '') }}" 
                   class="form-control" 
                   placeholder="{{ trans('videos.video_form.form.title') }}">
        </div>

        <!-- Campo Descripción con contador de caracteres -->
        <div class="form-group">
            <label for="description">{{ trans('videos.video_form.form.description') }}</label>
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="{{ trans('videos.video_form.form.description') }}" maxlength="500">{{ old('description', $video->description ?? '') }}</textarea>
            <div class="char-counter" id="charCounter">{{ trans('videos.video_form.form.char_counter') }}</div>
        </div>

        <!-- Cargar miniatura con vista previa -->
        <div class="form-group">
            <label for="image">{{ trans('videos.video_form.form.upload_thumbnail') }}</label>
            <input type="file" id="image" name="image" class="form-control-file" accept="image/*" aria-describedby="imageHelpBlock">
            <small id="imageHelpBlock" class="form-text text-muted">{{ trans('videos.video_form.form.thumbnail_help') }}</small>
            
            <img id="imagePreview" class="image-preview" src="{{ isset($video) && $video->image ? '/miniatura/'.$video->image : '' }}" style="{{ isset($video) && $video->image ? '' : 'display: none;' }}" />
        </div>

        <!-- Campo de carga del video y vista previa -->
        <div class="form-group">
            <label for="video">{{ trans('videos.video_form.form.upload_video') }}</label>
            <input type="file" id="video" name="video" class="form-control-file" accept="video/*">
            <video id="videoPreview" class="video-preview bg-dark" controls style="{{ isset($video) && $video->video_path ? '' : 'display: none;' }}">
                @if (isset($video) && $video->video_path)
                    <source src="{{ route('video-file', ['filename' => $video->video_path]) }}" />
                @endif
            </video>
        </div>

        <!-- Botones de acción -->
        <button type="submit" class="btn btn-primary btn-upload">{{ $buttonText ?? trans('videos.video_form.form.submit') }}</button>
        <a href="{{ url('user.channel', auth()->id()) }}" class="btn btn-secondary btn-cancel">{{ trans('videos.video_form.form.cancel') }}</a>
    </form>
</div>

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const descriptionInput = document.getElementById('description');
            const charCounter = document.getElementById('charCounter');
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const videoInput = document.getElementById('video');
            const videoPreview = document.getElementById('videoPreview');

            const updateCharCounter = () => {
                charCounter.textContent = `${descriptionInput.value.length} / 250`;
            };

            const showimagePreview = (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            };

            const showVideoPreview = (event) => {
                const file = event.target.files[0];
                if (file) {
                    const videoURL = URL.createObjectURL(file);
                    videoPreview.src = videoURL;
                    videoPreview.style.display = 'block';
                } else {
                    videoPreview.style.display = 'none';
                }
            };

            descriptionInput.addEventListener('input', updateCharCounter);
            imageInput.addEventListener('change', showimagePreview);
            videoInput.addEventListener('change', showVideoPreview);
        });

    </script>
@endsection
