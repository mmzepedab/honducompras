<?php
/* @var $this IssueReceptionTypeController */
/* @var $model IssueReceptionType */

$this->breadcrumbs=array(
	'Issue Reception Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IssueReceptionType', 'url'=>array('index')),
	array('label'=>'Manage IssueReceptionType', 'url'=>array('admin')),
);
?>

<h1>Create IssueReceptionType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>