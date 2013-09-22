<?php
/* @var $this EntidadesController */
/* @var $model Entidades */

$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	$model->codent,
);

$this->menu=array(
	array('label'=>'List Entidades', 'url'=>array('index')),
	array('label'=>'Create Entidades', 'url'=>array('create')),
	array('label'=>'Update Entidades', 'url'=>array('update', 'id'=>$model->codent)),
	array('label'=>'Delete Entidades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codent),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Entidades', 'url'=>array('admin')),
);
?>

<h1>View Entidades #<?php echo $model->codent; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codent',
		'nombre',
		'siglas',
		'codigo_tipo',
		'direccion',
		'telefono',
		'fax',
		'web',
	),
)); ?>
