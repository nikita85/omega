<?php

$menu = [
    [
        'label' => AdminModule::t('ui', 'Seminar'),
        'url' => ['/admin/seminar/index'],
    ],
    [
        'label' => AdminModule::t('ui', 'Curriculum'),
        'items' => [
            [
                'label' => AdminModule::t('ui', 'Education subjects'),
                'url' => ['/admin/educationSubject/index']
            ],
            [
                'label' => AdminModule::t('ui', 'Places'),
                'url' => ['/admin/place/index']
            ],
            [
                'label' => AdminModule::t('ui', 'Education courses'),
                'url' => ['/admin/educationCourse/index']
            ],
            [
                'label' => AdminModule::t('ui', 'Subjects'),
                'url' => ['/admin/curriculumSubject/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Lessons'),
                'url' => ['/admin/lesson/index'],
            ],

            [
                'label' => AdminModule::t('ui', 'Webinars'),
                'url' => ['/admin/webinar/index'],
            ],
        ],
    ],
    [
        'label' => AdminModule::t('ui', 'People'),
        'items' => [
            [
                'label' => AdminModule::t('ui', 'Education groups'),
                'url' => ['/admin/educationGroup/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Students'),
                'url' => ['/admin/student/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Parents'),
                'url' => ['/admin/parent/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Teachers'),
                'url' => ['/admin/teacher/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Admins'),
                'url' => ['/admin/adm/index'],
            ],

        ],
    ],
    [
        'label' => AdminModule::t('ui', 'Market'),
        'items' => [
            [
                'label' => AdminModule::t('ui', 'Education courses'),
                'url' => ['/admin/educationCourse/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Payments'),
                'url' => ['/admin/payment/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Discounts'),
                'url' => ['/admin/discount/index'],
            ],
            [
                'label' => AdminModule::t('ui', 'Contracts'),
                'url' => ['/admin/contract/index'],
            ],
        ],
    ],
    [
        'label' => AdminModule::t('ui', 'Reports'),
        'items' => [
            [
                'label' => AdminModule::t('ui', 'Students attendance'),
                'url' => ['/admin/reports/index']
            ],
        ],
    ],
    [
        'label' => AdminModule::t('ui', 'Admin Logout'),
        'url'=>['/user/logout'],
    ],

];

$filter = function($menu) {

    function filter(&$items)
    {
        foreach ($items as $key => $item) {

            if (!empty($item['items'])) {

                filter($items[$key]['items']);

            }

/*            if ( (!empty($item['url']) && !Yii::app()->user->checkAccess(preg_replace('/^\/{1}/', '', $item['url'][0]))) || (empty($item['url']) && empty($item['items'])) ) {
                unset ($items[$key]);
            }*/

        }
    }

    filter($menu);

    return $menu;
};



return $filter($menu);