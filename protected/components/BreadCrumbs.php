<?php

class BreadCrumbs
{
    public static $breadcrumbs = [
        'Classes' => [
            'url' => '',
            'items' => [
                'Summer Seminars' => [
                    'url' => '',
                    'items' => [
                        'Test prep boot camp' => ['url' => ''],
                        'Of myths and monsters' => ['url' => ''],
                        'Going to the dogs' => ['url' => ''],
                        'Make‘em laugh' => ['url' => ''],
                        'The power of story' => ['url' => ''],
                        'Intro to literary analysis' => ['url' => ''],
                    ]
                ],
                'Creative Writing at Oak Knoll' => ['url' => ''],
                'Writing Workouts at Hillview' => ['url' => ''],
            ]
        ],
    ];

    public static function getBreadCrumbs($activeItem)
    {
        $formattedBreadCrumbs = [];
        $selector = explode('/', $activeItem);

        foreach ($selector as $key => $part) {
            $formattedBreadCrumbs[$key] = [
                'label' => $part,
                'url' => self::$breadcrumbs[$part]['url']
            ];
        }

        return current(self::$breadcrumbs[$part]);

        return $formattedBreadCrumbs;
    }



    public $bradcrumbs = [
        ['label' =>'Classes','url' => '/student/profile'],
        ['label' =>'Summer Seminars','url' => 'adadadadadads',
            'items' => [
                ['label' => 'Creative Writing at Oak Knoll', 'url' => '4355'],
                ['label' => ' Writing Workouts at Hillview', 'url' => 'csdc']
            ]
        ],
        ['label' => 'Crafting the personal essay statement', 'url' => 'site/fpfp',
            'items' => [
                ['label' => 'Test prep boot camp ', 'url' => '4355'],
                ['label' => 'Of myths and monsters', 'url' => 'csdc'],
                ['label' => 'Going to the dogs', 'url' => 'csdc'],
                ['label' => ' Make‘em laugh ', 'url' => 'csdc'],
                ['label' => ' The power of story ', 'url' => 'csdc'],
                ['label' => 'Intro to literary analysis', 'url' => 'csdc'],

            ]
        ]
    ];

}