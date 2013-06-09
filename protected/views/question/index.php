<?php
/* @var $this QuestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Preguntas',
);

$this->menu=array(
	array('label'=>'Crear Pregunta', 'url'=>array('create')),
	array('label'=>'Administrar Preguntas', 'url'=>array('admin')),
	array('label'=>'Exportar a Excel', 'url'=>array('toExcel','string'=>(isset($_GET['string'])) ? $_GET['string'] : '', array('id'=>'string'))),
	
);
?>

<h1>Preguntas</h1>


<?php 
    $defaultValue = isset($_GET['dId']) ? $_GET['dId'] : 'prompt';
    echo CHtml::beginForm(CHtml::normalizeUrl(array('question/index')), 'get', array('id'=>'filter-form'))
    . CHtml::textField('string', (isset($_GET['string'])) ? $_GET['string'] : '', array('id'=>'string'))
    . CHtml::dropDownList('dId', 
            'promt', 
            Question::model()->getDeptOptions(), 
            array('prompt'=>'Por departamento...',
                            'options'=>array($defaultValue=>array('selected'=>'selected'))
                            ))
    . CHtml::submitButton('Buscar', array('name'=>''))
    . CHtml::link('Mostrar todos los resultados',array('question/index'),array('style'=>'font-size:smaller;text-decoration:none;'))
    . CHtml::endForm();
	?>
    
<?php /* Yii::app()->clientScript->registerScript('search',
    "var ajaxUpdateTimeout;
    var ajaxRequest;
    $('input#string').keyup(function(){
        ajaxRequest = $(this).serialize();
        clearTimeout(ajaxUpdateTimeout);
        ajaxUpdateTimeout = setTimeout(function () {
            $.fn.yiiListView.update(
// this is the id of the CListView
                'ajaxListView',
                {data: ajaxRequest}
            )
        },
// this is the delay
        300);
    });"
); */ 
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'emptyText'=>'No existe ningun registro',
	'summaryText'=>'Mostrando <b>{start}-{end}</b> de un total de <b>{count}</b> resultados.',
	'id'=>'ajaxListView',
	'sorterHeader'=>'Ordenar por:',
	'enableSorting' => true,
        'sortableAttributes'=>array(
            'create_time'=>'Fecha',
			'title'=>'Pregunta',
        ),
)); ?>
