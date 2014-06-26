<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'enroll-form-hillview-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'enroll_form_id'); ?>
		<?php echo $form->dropDownList($model, 'enroll_form_id', GxHtml::listDataEx(EnrollForms::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'enroll_form_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'student_name'); ?>
		<?php echo $form->textField($model, 'student_name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'student_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent_name'); ?>
		<?php echo $form->textField($model, 'parent_name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'parent_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model, 'address', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'address'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model, 'city', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'city'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent_email'); ?>
		<?php echo $form->textField($model, 'parent_email', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'parent_email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent_phone'); ?>
		<?php echo $form->textField($model, 'parent_phone', array('maxlength' => 12)); ?>
		<?php echo $form->error($model,'parent_phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'food_alergies'); ?>
		<?php echo $form->textField($model, 'food_alergies', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'food_alergies'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'additional_comments'); ?>
		<?php echo $form->textArea($model, 'additional_comments'); ?>
		<?php echo $form->error($model,'additional_comments'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'grade'); ?>
		<?php echo $form->textField($model, 'grade', array('maxlength' => 4)); ?>
		<?php echo $form->error($model,'grade'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'class_day'); ?>
		<?php echo $form->textField($model, 'class_day', array('maxlength' => 9)); ?>
		<?php echo $form->error($model,'class_day'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'order_id'); ?>
		<?php echo $form->dropDownList($model, 'order_id', GxHtml::listDataEx(Orders::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'order_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model, 'created'); ?>
		<?php echo $form->error($model,'created'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->