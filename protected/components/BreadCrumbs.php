<?php

class BreadCrumbs extends Controller
{

    public static function getBreadCrumbs($activeItem)
    {
        $breadСrumbs = [
            'Classes' => [
                'url' => Yii::app()->createUrl('classes/selection'),
                'items' => [
                    'Summer Seminars' => [
                        'url' => Yii::app()->createUrl('classes/summer'),
                        'items' => [
                            'Crafting the personal essay statement' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'essay_statement'])],
                            'Test prep boot camp' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'test_prep_boot_camp'])],
                            'Of myths and monsters' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'myths_and_monsters'])],
                            'Going to the dogs' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'the_dogs'])],
                            'Make‘em laugh' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'make‘em_laugh'])],
                            'The power of story' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'power_of_story'])],
                            'Intro to literary analysis' => ['url' => Yii::app()->createUrl('classes/details', ['classIdentifier' => 'literary_analysis'])],
                        ]
                    ],
                    'Creative Writing at Oak Knoll' => ['url' => Yii::app()->createUrl('classes/oakknoll')],
                    'Writing Workouts at Hillview' => ['url' => Yii::app()->createUrl('classes/hillview')],
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