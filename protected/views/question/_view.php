<?php
/* @var $this QuestionController */
/* @var $data Question */
?>

<div class="view">

	
    <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />

	<b>R:/ </b>
	<?php echo CHtml::encode($data->answer); ?>
	<br />

	


</div>