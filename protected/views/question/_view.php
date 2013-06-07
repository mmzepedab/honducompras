<?php
/* @var $this QuestionController */
/* @var $data Question */
?>

<div class="view">

	<div style="float:left; margin: 5px;"><img src="images/question_answer_icon.jpg" width="30" height="30" />  </div>
	<div>
    	 <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
  		<br />
       	 <div align="justify"><b>R:/ </b><?php echo CHtml::encode($data->answer); ?></div>
        <br />
        <div align="right" style="font-size: smaller; color:#999;">        	
        	<b>Creado por:</b> <?php echo CHtml::encode($data->create_user); ?>
        	<b> &nbsp;&nbsp;&nbsp; Fecha creado:</b> <?php echo CHtml::encode($data->create_time); ?>
        </div>
    </div>
   
	
	
	

	


</div>