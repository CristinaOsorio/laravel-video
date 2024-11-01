@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">
                <i class="fas fa-user"></i> Información Personal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">
                <i class="fas fa-shield-alt"></i> Seguridad
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
                <i class="fas fa-cog"></i> Configuración
            </a>
        </li>
    </ul> 
    <div class="tab-content mt-4" id="myTabContent">
        
        <!-- Información Personal -->
        <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
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
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-5 col-lg-4">
                                <!-- Imagen de perfil con opción de carga -->
                                <div class="text-center mb-4">
                                    <img id="profile-image" 
                                        src="{{ asset('images/user/profile-default.svg') }}" 
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
        </div>

        <!-- Seguridad -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
            <div class="card mb-4 mt-4">
                <div class="card-header">Opciones de Seguridad</div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Contraseña actual -->
                        <div class="form-group">
                            <label for="current_password">Contraseña Actual</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                            </div>
                        </div>

                        <!-- Nueva contraseña -->
                        <div class="form-group mt-3">
                            <label for="new_password">Nueva Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                            </div>
                            <small class="form-text text-muted">Debe tener al menos 8 caracteres, incluyendo una letra mayúscula, un número y un símbolo.</small>
                        </div>

                        <!-- Confirmar nueva contraseña -->
                        <div class="form-group mt-3">
                            <label for="confirm_password">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                </div>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                            </div>
                        </div>

                        <!-- Botón de actualizar -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-danger mt-4">Actualizar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Configuración -->
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

            <div class="card mb-4 mt-4">
                <div class="card-header">Idioma y Ubicación</div>
                <div class="card-body">
                    <form action="#" method="GET">
                        <select name="locale" onchange="location = this.value;" class="form-control w-25">
                            <option value="en">English</option>
                            <option value="es">Español</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="card mb-4 mt-4">
                <div class="card-header text-danger font-weight-bold">Eliminar Cuenta</div>
                <div class="card-body">
                    <p class="text-muted">Esta acción es irreversible. Si eliminas tu cuenta, toda tu información será permanentemente eliminada y no podrá ser recuperada.</p>
                    <form action="#" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar mi cuenta</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

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






