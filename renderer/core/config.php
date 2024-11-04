<?php
return [
    // Renderer
    'DB_HOST'         => '127.0.0.1',
    'DB_NAME'         => 'ysnsexrqqr',
    'DB_USER'         => 'ysnsexrqqr',
    'DB_PASS'         => 'MWdEj2YmfG',
    'SERIOUS_KEY'     => 'key',
    'ALLOWED_TYPES'   => ['item', 'user', 'preview'],
    'FOCUS_ITEMS'     => false,
    'FACES_PNG'       => false,

    // Site
    'SITE_NAME' => 'Roblox Clone',

    // Directories
    'DIRECTORIES' => [
        'ROOT'       => '/var/www/ysnsexrqqr/storage/app/public',
        'UPLOADS'    => '/var/www/ysnsexrqqr/storage/app/public/uploads',
        'THUMBNAILS' => '/var/www/ysnsexrqqr/public/storage/thumbnails'
    ],

    // Colors
    'ITEM_BODY_COLOR' => '#d3d3d3',

    // Avatar
    'AVATARS' => [
        'DEFAULT' => '/var/www/ysnsexrqqr/renderer/blend/vextoria_main_avi.blend',
        'GADGET'  => '/var/www/ysnsexrqqr/renderer/blend/vextoria_main_toolii.blend',
    ],

    // Headshot Camera
    'HEADSHOT_CAMERA' => [
        'LOCATION' => [
            'X' => '-0.03658',
            'Y' => '-2.36005',
            'Z' => '2.44025'
        ],

        'ROTATION' => [
            'X' => '85.208',
            'Y' => '-0.351',
            'Z' => '-0.999'
        ]
    ],

    // Image Sizes
    'IMAGE_SIZES' => [
        'USER_AVATAR'   => 512,
        'USER_HEADSHOT' => 256,
        'ITEM'          => 375
    ]
];
