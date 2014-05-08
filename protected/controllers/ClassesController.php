<?php

class ClassesController extends Controller
{

    public $layout = '//layouts/default';
/*
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
    ];*/

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
        $this->render("summer_classes");
    }

    public function actionHillview()
    {
        $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Writing Workouts at Hillview');
        $this->render("hillview");
    }

    public function actionOakknoll()
    {
        $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Creative Writing at Oak Knoll');
        $this->render("knoll");
    }
    
    public function actionDetails( $classIdentifier )
    {
        switch ($classIdentifier) 
        {
            case 'test_prep_boot_camp':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/Test prep boot camp');
                $this->render("details/test_prep_boot_camp");
                
                break;

            case 'essay_statement':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/Crafting the personal essay statement');
                $this->render("details/essay_statement");
                
                break;
            case 'myths_and_monsters':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/Of myths and monsters');
                $this->render("details/myths_and_monsters");
                
                break;
            case 'the_dogs':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/Going to the dogs');
                $this->render("details/the_dogs");
                
                break;
            case 'make_them_laugh':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/Make‘em laugh');
                $this->render("details/make_them_laugh");
                
                break;
            case 'power_of_story':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/The power of story');
                $this->render("details/power_of_story");
                
                break;
            case 'literary_analysis':

                $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars/Intro to literary analysis');
                $this->render("details/literary_analysis");
                
                break;

            default:
                
                $this->redirect(array('classes/selection'));
                break;
        }
        
    }
    
    
    
}
