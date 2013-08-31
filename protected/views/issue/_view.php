<?php
/* @var $this IssueController */
/* @var $data Issue */
?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_number')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ticket_number), array('view', 'id'=>$data->id)); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->getCategory($data->category_id)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('assigned_to')); ?>:</b>
	<?php echo CHtml::encode($data->user->concatened); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('institution_name')); ?>:</b>
	<?php echo CHtml::encode($data->institution_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_number')); ?>:</b>
	<?php echo CHtml::encode($data->contact_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_email')); ?>:</b>
	<?php echo CHtml::encode($data->contact_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->statusText); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user')); ?>:</b>
	<?php echo CHtml::encode($data->create_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user')); ?>:</b>
	<?php echo CHtml::encode($data->update_user); ?>
	<br />

	*/ ?>

</div>