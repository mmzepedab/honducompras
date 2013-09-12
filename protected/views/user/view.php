<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Listar Usuarios', 'url'=>array('index'), 'visible'=> Yii::app()->user->checkAccess('helpdesk_admin')),
	array('label'=>'Crear Usuario', 'url'=>array('create'), 'visible'=> Yii::app()->user->checkAccess('helpdesk_admin')),
	array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Cambiar Contraseña', 'url'=>array('changePassword', 'id'=>$model->id)),
	array('label'=>'Eliminar Usuario', 'url'=>'#', 'visible'=> Yii::app()->user->checkAccess('helpdesk_admin'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Usuario', 'url'=>array('admin'), 'visible'=> Yii::app()->user->checkAccess('helpdesk_admin')),
);
?>

<h1>Ver Usuario <?php echo $model->username; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'username',
                'email',
		'first_name',
		'last_name',
                'is_help_desk',
	),
)); ?>
