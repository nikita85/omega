<?php

class BreadCrumbs extends Controller
{

    public static function getBreadCrumbs($activeItem)
    {
        $breadСrumbs = [
            'Classes' => [
                'url' => Yii::app()->createUrl('site/classes'),
                'items' => [
                    'Summer Seminars' => [
                        'url' => Yii::app()->createUrl('site/summerClasses'),
                        'items' => [
                            'Crafting the personal essay statement' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'essay_statement'])],
                            'Test prep boot camp' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'test_prep_boot_camp'])],
                            'Of myths and monsters' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'myths_and_monsters'])],
                            'Going to the dogs' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'the_dogs'])],
                            'Make‘em laugh' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'make‘em_laugh'])],
                            'The power of story' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'power_of_story'])],
                            'Intro to literary analysis' => ['url' => Yii::app()->createUrl('site/summerClasses', ['view' => 'literary_analysis'])],
                        ]
                    ],
                    'Creative Writing at Oak Knoll' => ['url' => Yii::app()->createUrl('site/classes', ['view' => 'knoll'])],
                    'Writing Workouts at Hillview' => ['url' => Yii::app()->createUrl('site/classes', ['view' => 'hillview'])],
                ]
            ],
        ];

        $formattedBreadCrumbs = [];
        $selector = explode('/', $activeItem);
        $stepArray = $breadСrumbs;

        foreach ($selector as $key => $selectorPart) {

            if (in_array($selectorPart, array_keys($stepArray))) {
                $formattedBreadCrumbs[$key] = [];
                foreach (array_keys($stepArray) as $stepItem) {
                    if ($stepItem == $selectorPart) {
                        $formattedBreadCrumbs[$key]['label'] = $stepItem;
                        $formattedBreadCrumbs[$key]['url'] = $stepArray[$stepItem]['url'];
                        if (!empty($stepArray[$stepItem]['items'])) {
                            $newStepArray = $stepArray[$stepItem]['items'];
                        }
                    } else {
                        $childElem = [];
                        $childElem['label'] = $stepItem;
                        $childElem['url'] = $stepArray[$stepItem]['url'];
                        $formattedBreadCrumbs[$key]['items'][] = $childElem;
                    }

                }

                if ($newStepArray) {
                    $stepArray = $newStepArray;
                }
            }

        }

        return $formattedBreadCrumbs;
    }

}