@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">
                <i class="fas fa-user"></i> {{ trans('user.settings.profile') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">
                <i class="fas fa-shield-alt"></i> {{ trans('user.settings.security') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
                <i class="fas fa-cog"></i> {{ trans('user.settings.settings') }}
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
            @include('user.components.security-section')

        </div>
        
        <!-- Configuración -->
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            @include('user.components.settings-section')
        </div>
    </div>
</div>

@endsection







