<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Preguntas'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista de preguntas', 'url'=>array('index')),
	array('label'=>'Crear Pregunta', 'url'=>array('create')),
	array('label'=>'Ver Pregunta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Preguntas', 'url'=>array('admin')),
);
?>

<h1>Actualizar pregunta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>