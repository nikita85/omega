<?php

$menu = [
    [
        'label' => AdminModule::t('ui', 'Seminar'),
        'url' => ['/admin/seminar/index'],
    ],
    [
        'label' => AdminModule::t('ui', 'Tutors'),
        'url' => ['/admin/tutor/index'],
    ],
    [
        'label' => AdminModule::t('ui', "Tutors' Students"),
        'url' => ['/admin/tutorStudent/index'],
    ],
    [
        'label' => AdminModule::t('ui', 'Day Off'),
        'url' => ['/admin/dayOff/index'],
    ],
    [
        'label' => AdminModule::t('ui', 'Month Puzzle'),
        'url' => ['/admin/monthPuzzle/index'],
    ],
    [
        'label' => AdminModule::t('ui', 'Grade'),
        'url' => ['/admin/grade/index'],
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