<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->enroll_form_id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->enroll_form_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
array(
			'name' => 'enrollForm',
			'type' => 'raw',
			'value' => $model->enrollForm !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->enrollForm)), array('enrollForms/view', 'id' => GxActiveRecord::extractPkValue($model->enrollForm, true))) : null,
			),
'student_name',
'parent_name',
'address',
'city',
'parent_email',
'parent_phone',
'food_alergies',
'additional_comments',
'grade',
'class_day',
array(
			'name' => 'order',
			'type' => 'raw',
			'value' => $model->order !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->order)), array('orders/view', 'id' => GxActiveRecord::extractPkValue($model->order, true))) : null,
			),
'created',
	),
)); ?>

