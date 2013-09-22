<?php
/* @var $this EntidadesController */
/* @var $model Entidades */

$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Entidades', 'url'=>array('index')),
	array('label'=>'Manage Entidades', 'url'=>array('admin')),
);
?>

<h1>Create Entidades</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>