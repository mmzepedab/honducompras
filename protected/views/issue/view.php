<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	$model->ticket_number,
);

$this->menu=array(
	array('label'=>'Listar consultas', 'url'=>array('index')),
	array('label'=>'Crear consultas', 'url'=>array('create') , 'visible'=>Yii::app()->user->checkAccess('helpdesk_central')),
	array('label'=>'Actualizar consultas', 'url'=>array('update', 'id'=>$model->id) , 'visible'=>Yii::app()->user->checkAccess('helpdesk_central') ),
        array('label'=>'Borrar consulta', 'url'=>'#', 'visible'=>Yii::app()->user->checkAccess('helpdesk_admin'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este item?')), 
	array('label'=>'Administrar consultas', 'visible'=>Yii::app()->user->checkAccess('helpdesk_admin'), 'url'=>array('admin')),
);
?>

<h1>Ticket <?php echo $model->ticket_number; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array('name'=>'Asignado a','value'=>isset($model->user)?CHtml::encode($model->user->concatened):"Desconocido"),
		array('name'=>'Categoria','value'=>CHtml::encode($model->getCategory($model->category_id))),		
                'institution_name',
                'contact_number',
		'contact_email',
		'statusText',
		'create_time',
		'create_user',
		'update_user',
	),
)); ?>
