<?php
declare(strict_types=1);



return [
    'routes' => [
        [
            'name' => 'Owners',
            'route' => 'owners.index',
            'icon' => 'users',
            'children' => [
                [
                    'name' => 'Mülkiyyətçilər',
                    'route' => 'owners.index',
                    'icon' => 'users',
                ],
                [
                    'name' => 'Yeni Mülkiyyətçi',
                    'route' => 'owners.create',
                    'icon' => 'plus',
                ],
            ]        
        ]
    ]
];