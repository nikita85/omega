<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'enroll_form_id'); ?>
		<?php echo $form->dropDownList($model, 'enroll_form_id', GxHtml::listDataEx(EnrollForms::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'student_name'); ?>
		<?php echo $form->textField($model, 'student_name', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'parent_name'); ?>
		<?php echo $form->textField($model, 'parent_name', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'address'); ?>
		<?php echo $form->textField($model, 'address', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'city'); ?>
		<?php echo $form->textField($model, 'city', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'parent_email'); ?>
		<?php echo $form->textField($model, 'parent_email', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'parent_phone'); ?>
		<?php echo $form->textField($model, 'parent_phone', array('maxlength' => 12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'food_alergies'); ?>
		<?php echo $form->textField($model, 'food_alergies', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'additional_comments'); ?>
		<?php echo $form->textArea($model, 'additional_comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'grade'); ?>
		<?php echo $form->textField($model, 'grade', array('maxlength' => 4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'class_day'); ?>
		<?php echo $form->textField($model, 'class_day', array('maxlength' => 9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'order_id'); ?>
		<?php echo $form->dropDownList($model, 'order_id', GxHtml::listDataEx(Orders::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created'); ?>
		<?php echo $form->textField($model, 'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
