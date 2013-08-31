<?php
/* @var $this IssueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Consultas',
);

$this->menu=array(
	array('label'=>'Crear consulta', 'url'=>array('create')),
	array('label'=>'Administrar consulta', 'url'=>array('admin')),
);
?>

<h1>Consultas</h1>

<?php 
$dataProvider->sort->defaultOrder='create_time DESC';
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,        
	'summaryText'=>'Mostrando <b>{start}-{end}</b> de un total de <b>{count}</b> resultados.',
	'itemView'=>'_view',
        'sorterHeader'=>'Ordenar por:',
	'enableSorting' => true,
        'sortableAttributes'=>array(
            'create_time'=>'Fecha',
        ),
)); ?>
