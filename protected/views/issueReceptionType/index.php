<?php
/* @var $this IssueReceptionTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Issue Reception Types',
);

$this->menu=array(
	array('label'=>'Create IssueReceptionType', 'url'=>array('create')),
	array('label'=>'Manage IssueReceptionType', 'url'=>array('admin')),
);
?>

<h1>Issue Reception Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
