<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('enroll_form_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->enroll_form_id), array('view', 'id' => $data->enroll_form_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('student_name')); ?>:
	<?php echo GxHtml::encode($data->student_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('grade')); ?>:
	<?php echo GxHtml::encode($data->grade); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parent_name')); ?>:
	<?php echo GxHtml::encode($data->parent_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('address')); ?>:
	<?php echo GxHtml::encode($data->address); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parent_email')); ?>:
	<?php echo GxHtml::encode($data->parent_email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parent_phone')); ?>:
	<?php echo GxHtml::encode($data->parent_phone); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('food_alergies')); ?>:
	<?php echo GxHtml::encode($data->food_alergies); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('additional_comments')); ?>:
	<?php echo GxHtml::encode($data->additional_comments); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('order_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->order)); ?>
	<br />
	*/ ?>

</div>