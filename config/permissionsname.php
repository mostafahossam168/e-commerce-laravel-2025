<?php
$map = ['create', 'read', 'update', 'delete'];

return [
    'models' => [
        'users' => $map,
        'admins' => $map,
        'categories' => $map,
        'products' => $map,
        'orders' => $map,
        'settings' => ['read', 'update'],
        'home' => ['show_statistics'],
        // 'control_priorities' => array_merge($map, ['update_status', 'update_status_print']),
    ],
];