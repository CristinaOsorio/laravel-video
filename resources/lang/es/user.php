<?php

return [
    'channel' => [
        'joined' => 'Se unió el :date',
        'video_count' => ':count videos',
        'channel_videos' => 'Videos del canal de :user',
        'filters' => [
            'recent' => 'Recientes',
            'likes' => 'Me gusta',
            'comments' => 'Comentarios',
        ],
    ],
    'profile' => [
        'basic_info' => 'Información Básica',
        'profile_picture' => 'Foto de perfil',
        'name' => 'Nombre',
        'surname' => 'Apellido',
        'nickname' => 'Nickname',
        'email' => 'Correo Electrónico',
        'save_changes' => 'Guardar Cambios',
        'message' => [
            'success' => 'Tus cambios han sido guardados exitosamente.'
        ],
    ],
    'security' => [
        'validation' => [
            'current_password' => 'La contraseña actual es obligatoria.',
            'new_password' => 'La nueva contraseña es obligatoria.',
            'password_min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password_confirmed' => 'La contraseña no coincide.',
            'incorrect_password' => 'La contraseña actual no es correcta.',
        ],
        'message' => [
            'success' => 'Tu contraseña ha sido actualizada exitosamente.',
        ],
    ],
];
