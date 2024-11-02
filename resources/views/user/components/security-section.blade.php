<div class="card mb-4 mt-4">
    <div class="card-header">Opciones de Seguridad</div>
    <div class="card-body">

        @if(session('message'))
            <div class="row">
                <div class="alert alert-success col-12" role="alert">
                    {{ __('user.profile.message.success') }}
                </div>
            </div>
        @endif

        <form action="{{ route('user.update-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-6">
                    <!-- Contraseña actual -->
                    @include('components.forms.input', [
                        'label' =>'Contraseña Actual', 
                        'name' => 'current_password', 
                        'id' => 'current_password', 
                        'type' => 'password', 
                        'value' => '', 
                        'attributes' => 'required'
                    ])
                </div>
                
                <div class="col-lg-6">
                    <!-- Nueva contraseña -->
                    @include('components.forms.input', [
                        'label' =>'Nueva Contraseña', 
                        'name' => 'new_password', 
                        'id' => 'new_password', 
                        'type' => 'password', 
                        'value' => '', 
                        'attributes' => 'required'
                    ])
                </div>

                <div class="col-lg-6">
                    <!-- Confirmar nueva contraseña -->
                    @include('components.forms.input', [
                        'label' =>'Confirmar Contraseña', 
                        'name' => 'new_password_confirmation', 
                        'id' => 'confirm_password', 
                        'type' => 'password', 
                        'value' => '', 
                        'attributes' => 'required'
                    ])
                </div>
            </div>

            <!-- Botón de actualizar -->
            <div class="text-right">
                <button type="submit" class="btn btn-danger mt-4">Actualizar Contraseña</button>
            </div>
        </form>
    </div>
</div>