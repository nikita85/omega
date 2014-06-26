<?php

$this->breadcrumbs = array(
	EnrollFormHillview::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . EnrollFormHillview::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . EnrollFormHillview::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(EnrollFormHillview::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 