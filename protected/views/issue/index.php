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
Numero de ticket:
<?php 
    $defaultValue = isset($_GET['uId']) ? $_GET['uId'] : 'prompt';
    $defaultValueStatus = isset($_GET['sId']) ? $_GET['sId'] : 'prompt';
    echo CHtml::beginForm(CHtml::normalizeUrl(array('issue/index')), 'get', array('id'=>'filter-form'))
    . CHtml::textField('tNumber', (isset($_GET['string'])) ? $_GET['string'] : '', array('id'=>'tNumber'))
    . CHtml::dropDownList('uId', 
            'promt', 
            User::model()->getHelpDeskUsers(), 
            array('prompt'=>'Por oficial de mesa de ayuda',
                            'options'=>array($defaultValue=>array('selected'=>'selected'))
                            ))
    . CHtml::dropDownList('sId', 
    'promt', 
    Issue::model()->getStatusOptions(), 
    array('prompt'=>'Estado',
                    'options'=>array($defaultValueStatus=>array('selected'=>'selected'))
                    )) 
    . CHtml::submitButton('Buscar', array('name'=>''))
    . CHtml::link('Mostrar todos los resultados',array('issue/index'),array('style'=>'font-size:smaller;text-decoration:none;'))
    . CHtml::endForm();
	?>

<?php 
$dataProvider->sort->defaultOrder='create_time DESC';
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'emptyText'=>'No existe ningun registro',
	'summaryText'=>'Mostrando <b>{start}-{end}</b> de un total de <b>{count}</b> resultados.',
        'id'=>'ajaxListView',
	'itemView'=>'_view',
        'sorterHeader'=>'Ordenar por:',
	'enableSorting' => true,
        'sortableAttributes'=>array(
            'create_time'=>'Fecha',
        ),
)); ?>
