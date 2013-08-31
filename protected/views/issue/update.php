<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Consulta'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar consultas', 'url'=>array('index')),
	array('label'=>'Crear consulta', 'url'=>array('create')),
	array('label'=>'Ver consulta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar consulta', 'url'=>array('admin')),
);
?>

<h1>Actualizar consulta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>