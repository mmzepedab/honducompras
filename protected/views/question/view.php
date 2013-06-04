<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Preguntas'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar Preguntas', 'url'=>array('index')),
	array('label'=>'Crear Pregunta', 'url'=>array('create')),
	array('label'=>'Actualizar Pregunta', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Pregunta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Pregunta', 'url'=>array('admin')),
);
?>

<h1>Ver Pregunta #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'answer',
		'create_time',
		'create_user',
		'update_user',
	),
)); ?>
