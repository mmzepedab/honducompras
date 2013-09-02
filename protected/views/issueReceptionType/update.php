<?php
/* @var $this IssueReceptionTypeController */
/* @var $model IssueReceptionType */

$this->breadcrumbs=array(
	'Issue Reception Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List IssueReceptionType', 'url'=>array('index')),
	array('label'=>'Create IssueReceptionType', 'url'=>array('create')),
	array('label'=>'View IssueReceptionType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IssueReceptionType', 'url'=>array('admin')),
);
?>

<h1>Update IssueReceptionType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>