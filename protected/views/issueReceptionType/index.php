<?php
/* @var $this IssueReceptionTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Metodos de recepcion de consultas',
);

$this->menu=array(
	array('label'=>'Crear metodos de recepcion', 'url'=>array('create')),
	array('label'=>'Administrar metodos de recepcion', 'url'=>array('admin')),
);
?>

<h1>Métodos de recepción de consultas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
