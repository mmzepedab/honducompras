<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Consulta'=>array('index'),
	$model->ticket_number=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar consultas', 'url'=>array('index')),
	array('label'=>'Crear consulta', 'url'=>array('create')),
	array('label'=>'Ver consulta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar consulta', 'url'=>array('admin')),
);
?>

<h1>Actualizar ticket <?php echo $model->ticket_number; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>