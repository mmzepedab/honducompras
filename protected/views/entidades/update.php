<?php
/* @var $this EntidadesController */
/* @var $model Entidades */

$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	$model->codent=>array('view','id'=>$model->codent),
	'Update',
);

$this->menu=array(
	array('label'=>'List Entidades', 'url'=>array('index')),
	array('label'=>'Create Entidades', 'url'=>array('create')),
	array('label'=>'View Entidades', 'url'=>array('view', 'id'=>$model->codent)),
	array('label'=>'Manage Entidades', 'url'=>array('admin')),
);
?>

<h1>Update Entidades <?php echo $model->codent; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>