<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Lista de Preguntas', 'url'=>array('index')),
	array('label'=>'Administrar Pregunta', 'url'=>array('admin')),
);
?>

<h1>Crear Pregunta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>