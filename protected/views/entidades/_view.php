<?php
/* @var $this EntidadesController */
/* @var $data Entidades */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('codent')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->codent), array('view', 'id'=>$data->codent)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('siglas')); ?>:</b>
	<?php echo CHtml::encode($data->siglas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('web')); ?>:</b>
	<?php echo CHtml::encode($data->web); ?>
	<br />

	*/ ?>

</div>