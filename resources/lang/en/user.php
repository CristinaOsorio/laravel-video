<?

return [
    'channel' =>[
        'joined' => 'Joined on :date',
        'video_count' => ':count videos',
        'channel_videos' => 'Videos from :user\'s channel',
        'filters' => [
            'recent' => 'Recent',
            'likes' => 'Likes',
            'comments' => 'Comments',
        ],
    ],
    'profile' => [
        'basic_info' => 'Basic Information',
        'profile_picture' => 'Profile Picture',
        'name' => 'Name',
        'surname' => 'Surname',
        'nickname' => 'Nickname',
        'email' => 'Email',
        'save_changes' => 'Save Changes',
        'message' => [
            'success' => 'Your changes have been saved successfully.'
        ]
    ],
    'security' => [
        'validation' => [
            'current_password' => 'The current password is required.',
            'new_password' => 'The new password is required.',
            'password_min' => 'The new password must be at least 8 characters.',
            'password_confirmed' => 'The password does not match.',
            'incorrect_password' => 'The current password is incorrect.',
        ],
        'message' => [
            'success' => 'Your password has been successfully updated.',
        ],
    ],
];
