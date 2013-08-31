<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	$model->ticket_number,
);

$this->menu=array(
	array('label'=>'Listar consultas', 'url'=>array('index')),
	array('label'=>'Crear consultas', 'url'=>array('create')),
	array('label'=>'Actualizar consultas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar consulta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar consultas', 'url'=>array('admin')),
);
?>

<h1>Ticket <?php echo $model->ticket_number; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array('name'=>'Asignado a','value'=>isset($model->user)?CHtml::encode($model->user->concatened):"unknown"),
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
