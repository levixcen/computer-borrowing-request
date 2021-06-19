<?php

return [

    'admin' => [
        [
            'navs' => [
                [
                    'name' => 'Requests',
                    'route' => 'admin.borrowing-requests.index',
                ],
                [
                    'name' => 'Schedules',
                    'route' => 'admin.schedules.index',
                ],
                [
                    'name' => 'Rooms',
                    'route' => 'admin.rooms.index',
                ],
            ],
        ],
    ],

    'user' => [
        [
            'navs' => [
                [
                    'name' => 'Home',
                    'route' => 'home',
                ],
                [
                    'name' => 'Borrowing Request',
                    'route' => 'borrowing-requests.index',
                ],
            ],
        ],
    ],

];
