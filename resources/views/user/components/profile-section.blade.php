<div class="card mb-4">
    <div class="card-header">Información Básica</div>
    <div class="card-body">

    @if(session('message'))
        <div class="alert alert-success col-12" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-5 col-lg-4">
                    <!-- Imagen de perfil con opción de carga -->
                    <div class="text-center mb-4">
                        <img id="profile-image" 
                            src="{{ Storage::disk('images/profile')->has(auth()->user()->image) 
                                        ? url('profile/image/'.auth()->user()->image) 
                                        : asset('images/user/profile-default.svg') }}" 
                            alt="Imagen de perfil de {{ auth()->user()->name }}" 
                            class="rounded-circle img-thumbnail object-cover" 
                            style="width: 150px; height: 150px;">
                        <div class="mt-2">
                            <label for="image" class="btn btn-outline-primary btn-sm">Cambiar Imagen</label>
                            <input type="file" name="image" id="image" class="d-none">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8">
                    <div class="row">
                        <!-- Nombre de usuario -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}">
                            </div>
                        </div>

                        <!-- Apellidos de usuario -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="surname">Apellido</label>
                                <input type="text" name="surname" id="surname" class="form-control" value="{{ auth()->user()->surname }}">
                            </div>
                        </div>

                        <!-- Apodo o nombre de usuario -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nickname">Nickname</label>
                                <input type="text" name="nickname" id="nickname" class="form-control" value="{{ auth()->user()->nickname }}">
                            </div>
                        </div>

                        <!-- Email (no editable) -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>
                    </div><!-- Botón de guardar alineado a la derecha -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-4">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('js')
    <script>
        document.getElementById('image').addEventListener('change', function() {
            const img = document.getElementById('profile-image');
            img.src = URL.createObjectURL(this.files[0]);
            const fileName = this.files[0].name;
            document.querySelector('label[for="image"]').textContent = fileName;
        });
    </script>

@endsection