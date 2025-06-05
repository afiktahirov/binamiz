<?php
declare(strict_types=1);



return [
    'routes' => [
        [
            'name' => 'Əsas səhifə',
            'route' => 'account.dashboard',
            'icon' => 'home',
        ],
        [
            'name' => 'Garajlar',
            'route' => 'account.garage.index',
            'icon' => 'garage',
        ],
        [
            'name' => 'Obyektlər',
            'route' => 'account.object.index',
            'icon' => 'building',
        ],
        [
            'name' => 'Mənzillər',
            'route' => 'account.apartment.index',
            'icon' => 'apartment',
        ],
        [
            'name' => 'Nəqliyyat Vasitələri',
            'route' => 'account.vehicle.index',
            'icon' => 'car',
        ]
    ]
];