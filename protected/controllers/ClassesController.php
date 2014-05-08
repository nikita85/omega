<?php

class ClassesController extends Controller
{

    public $layout = '//layouts/default';

    public $breadcrumbs = [
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

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('main');
    }

    public function actionSelection()
    {
        $this->render('main');
    }

    public function actionSummer()
    {
        $summerSeminars = Seminar::model()->findAllByAttributes(['type' => 'summer']);
        $timesMax = $gradesMax = $datePeriodsMax = 0;


        foreach($summerSeminars as $seminar){
            if($seminar->timesCount > $timesMax){
                $timesMax = $seminar->timesCount;
            }
            if($seminar->gradesCount > $gradesMax){
                $gradesMax = $seminar->gradesCount;
            }
            if($seminar->datePeriodsCount > $datePeriodsMax){
                $datePeriodsMax = $seminar->datePeriodsCount;
            }

        }

        $this->render("summer_classes", [
            'seminars' => $summerSeminars,
            'timesMax' => $timesMax,
            'gradesMax' => $gradesMax,
            'datePeriodsMax' => $datePeriodsMax,
        ]);
    }

    public function actionHillview()
    {
        $this->render("hillview");
    }

    public function actionOakknoll()
    {
        $this->render("knoll");
    }
    
    public function actionDetails( $classIdentifier )
    {
        switch ($classIdentifier) 
        {
            case 'test_prep_boot_camp':

                $this->render("details/test_prep_boot_camp");
                
                break;

            case 'essay_statement':

                $this->render("details/essay_statement");
                
                break;
            case 'myths_and_monsters':

                $this->render("details/myths_and_monsters");
                
                break;
            case 'the_dogs':

                $this->render("details/the_dogs");
                
                break;
            case 'make_them_laugh':

                $this->render("details/make_them_laugh");
                
                break;
            case 'power_of_story':

                $this->render("details/power_of_story");
                
                break;
            case 'literary_analysis':

                $this->render("details/literary_analysis");
                
                break;

            default:
                
                $this->redirect(array('classes/selection'));
                break;
        }
        
    }
    
    
    
}
