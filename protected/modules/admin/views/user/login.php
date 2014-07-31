<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="wrapper">
    <div class="login-form">
        <?php
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm', array(
                'id'          => 'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => array('class' => 'well')
            )
        ); ?>
        <fieldset>
            <legend><?php echo 'Login'; ?></legend>
            <?php echo $form->errorSummary($model); ?>
            <div class='row-fluid'>
                <?php echo $form->textFieldRow($model, 'username', array('class' => 'span12')); ?>
                <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12')); ?>

                <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>


            </div>
            <?php if (Yii::app()->user->getState('badLoginCount', 0) >= 3): ?>
                <div class='row-fluid'>
                    <?php if (CCaptcha::checkRequirements('gd')): ?>
                        <?php echo $form->labelEx($model, 'verifyCode'); ?>
                        <div>
                            <?php $this->widget('CCaptcha', array('showRefreshButton' => true)); ?>
                            <?php echo $form->textField($model, 'verifyCode'); ?>
                            <?php echo $form->error($model, 'verifyCode'); ?>
                        </div>
                        <div class="hint">
                            <?php echo 'Enter numbers'; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </fieldset>
        <div class="form-actions">
            <?php
            $this->widget(
                'bootstrap.widgets.TbButton', array(
                    'buttonType'  => 'submit',
                    'type'        => 'primary',
                    'label'       => 'Sign In',
                    'htmlOptions' => array(
                        'class' => 'btn-block'
                    ),
                )
            );
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
</div>

