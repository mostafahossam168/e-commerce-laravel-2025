<?php
$map = ['create', 'read', 'update', 'delete'];

return [
    'models' => [
        'users' => $map,
        'roles' => $map,
        'admins' => $map,
        'categories' => $map,
        'products' => $map,
        'orders' => $map,
        'settings' => ['read', 'update'],
        'notifications' => ['read'],
        'contact-us' => ['read', 'delete'],
        'home' => ['show_statistics', 'show-room'],
    ],
];