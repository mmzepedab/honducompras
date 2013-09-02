<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Consultas', 'url'=>array('index')),
	array('label'=>'Administrar Consultas', 'url'=>array('admin')),
);
?>

<h1>Crear consulta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>