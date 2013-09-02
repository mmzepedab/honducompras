<?php
/* @var $this IssueReceptionTypeController */
/* @var $model IssueReceptionType */

$this->breadcrumbs=array(
	'Metodos de recepcion de consultas'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Listar metodos de recepcion', 'url'=>array('index')),
	array('label'=>'Crear metodos de recepcion', 'url'=>array('create')),
	array('label'=>'Actualizar metodos de recepcion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar metodos de recepcion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar metodos de recepcion', 'url'=>array('admin')),
);
?>

<h1>Ver método de recepción de consultas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
