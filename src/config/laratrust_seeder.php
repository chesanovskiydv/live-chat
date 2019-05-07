<?php

return [
    'role_structure' => [
        'super_admin' => [
            'workspaces' => 'c,v,u,d,r,fd',
            'users' => 'c,v,u,d,r,fd',
        ],
        'admin' => [
            'users' => 'c,v,u,d,r,fd',
            'api_keys' => 'c,v,u,d,r,fd',
            'visitors' => 'v',
            'chats' => 'v',
            'messages' => 'c,v'
        ],
        'user' => [
            'visitors' => 'v',
            'chats' => 'v',
            'messages' => 'c,v'
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'v' => 'view',
        'u' => 'update',
        'd' => 'delete',
        'r' => 'restore',
        'fd' => 'force_delete'
    ]
];
