<div class="card mb-4">
    <div class="card-header">{{ __('user.profile.basic_info') }}</div>
    <div class="card-body">

        @if(session('message'))
            <div class="alert alert-success col-12" role="alert">
                {{ __('user.profile.message.success') }}
            </div>
        @endif

        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-5 col-lg-4">
                    <!-- Imagen de perfil con opción de carga -->
                    <div class="text-center mb-4">
                        @include('components.forms.profile_image_input', [
                            'label' => __('user.profile.profile_picture'), 
                            'name' => 'image', 
                            'id' => 'image',
                            'imagePath' => Storage::disk('images/profile')->has(auth()->user()->image) 
                                                    ? url('profile/image/'.auth()->user()->image) 
                                                    : asset('images/user/profile-default.svg')
                        ])
                    </div>
                </div>
                <div class="col-md-7 col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Nombre de usuario -->
                            @include('components.forms.input', [
                                'label' => __('user.profile.name'), 
                                'name' => 'name', 
                                'id' => 'name', 
                                'type' => 'text', 
                                'value' => auth()->user()->name ?? '', 
                                'attributes' => 'required'
                            ])
                        </div>

                        <div class="col-lg-6">
                            <!-- Apellido de usuario -->
                            @include('components.forms.input', [
                                'label' => __('user.profile.surname'), 
                                'name' => 'surname', 
                                'id' => 'surname', 
                                'type' => 'text', 
                                'value' => auth()->user()->surname ?? '', 
                                'attributes' => 'required'
                            ])
                        </div>

                        <div class="col-lg-6">
                            <!-- Apodo o nombre de usuario -->
                            @include('components.forms.input', [
                                'label' => __('user.profile.nickname'), 
                                'name' => 'nickname', 
                                'id' => 'nickname', 
                                'type' => 'text', 
                                'value' => auth()->user()->nickname ?? '', 
                                'attributes' => 'required'
                            ])
                        </div>

                        <div class="col-lg-6">
                            <!-- Correo Electrónico (no editable) -->
                            @include('components.forms.input', [
                                'label' => __('user.profile.email'), 
                                'name' => 'email', 
                                'id' => 'email', 
                                'type' => 'email', 
                                'value' => auth()->user()->email ?? '', 
                                'attributes' => 'readonly'
                            ])
                        </div>
                    </div>
                    <!-- Botón de guardar alineado a la derecha -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-4">{{ __('user.profile.save_changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
