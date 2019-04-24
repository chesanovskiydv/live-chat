<?php

return [
    'role_structure' => [
        'super_admin' => [
            'workspaces' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'messages' => 'c,r'
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'messages' => 'c,r'
        ],
        'user' => [
            'messages' => 'c,r'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
