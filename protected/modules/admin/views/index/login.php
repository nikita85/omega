<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Admin Login',
);
?>

<div class="section login-page">

    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'verticalForm',
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

    <?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
    <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
    <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'htmlOptions'=>array('class'=>'newStyleContentButton'), 'label'=>'Login')); ?>

    <?php $this->endWidget(); ?>


