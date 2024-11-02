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
            @include('user.components.profile-section')
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







