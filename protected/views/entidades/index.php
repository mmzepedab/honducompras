<?php
/* @var $this EntidadesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entidades',
);

$this->menu=array(
	array('label'=>'Create Entidades', 'url'=>array('create')),
	array('label'=>'Manage Entidades', 'url'=>array('admin')),
);
?>

<h1>Entidades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
