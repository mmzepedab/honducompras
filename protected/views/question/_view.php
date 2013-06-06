<?php
/* @var $this QuestionController */
/* @var $data Question */
?>

<div class="view">

	<div style="float:left"><img src="images/question_answer_icon.jpg" width="30" height="30" />  </div>
	<div>
    	 <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
  		<br />
       	<b>R:/ </b> <?php echo CHtml::encode($data->answer); ?>
        <br />
    </div>
   
	
	
	

	


</div>