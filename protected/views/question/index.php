<?php
/* @var $this QuestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Preguntas',
);

$this->menu=array(
	array('label'=>'Crear Pregunta', 'url'=>array('create')),
	array('label'=>'Administrar Preguntas', 'url'=>array('admin')),
);
?>

<h1>Preguntas</h1>

<?php echo CHtml::beginForm(CHtml::normalizeUrl(array('question/index')), 'get', array('id'=>'filter-form'))
    . CHtml::textField('string', (isset($_GET['string'])) ? $_GET['string'] : '', array('id'=>'string'))
    . CHtml::submitButton('Buscar', array('name'=>''))
    . CHtml::endForm();
	?>
    
<?php Yii::app()->clientScript->registerScript('search',
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
); 
?>
    

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'emptyText'=>'No existe ningun registro',
	'summaryText'=>'Mostrando {start}-{end} de un total de {count} resultados.',
	'id'=>'ajaxListView',
)); ?>
