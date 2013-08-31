<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Issue', 'url'=>array('index')),
	array('label'=>'Manage Issue', 'url'=>array('admin')),
);
?>

<h1>Crear consulta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>