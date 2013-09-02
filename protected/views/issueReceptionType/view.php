<?php
/* @var $this IssueReceptionTypeController */
/* @var $model IssueReceptionType */

$this->breadcrumbs=array(
	'Issue Reception Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List IssueReceptionType', 'url'=>array('index')),
	array('label'=>'Create IssueReceptionType', 'url'=>array('create')),
	array('label'=>'Update IssueReceptionType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete IssueReceptionType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IssueReceptionType', 'url'=>array('admin')),
);
?>

<h1>View IssueReceptionType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
