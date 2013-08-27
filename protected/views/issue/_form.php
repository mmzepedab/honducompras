<?php
/* @var $this IssueController */
/* @var $model Issue */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issue-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <script type="text/javascript">
            //alert('my script');
        </script>
        <div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',$model->getCategories()); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'ticket_number'); ?>
		<?php echo $form->textField($model,'ticket_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ticket_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assigned_to'); ?>  
            
                <?php echo $form->dropDownList($model,'assigned_to',$model->getUsers()); ?>
		<?php /* echo $form->textField($model,'assigned_to',array('size'=>60,'maxlength'=>255)); */ ?> 
		<?php echo $form->error($model,'assigned_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'institution_name'); ?>
		<?php echo $form->textField($model,'institution_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'institution_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_number'); ?>
		<?php echo $form->textField($model,'contact_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contact_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textField($model,'contact_email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contact_email'); ?>
	</div>

	<div class="row">            
		<?php echo $form->labelEx($model,'status'); ?>
                <?php echo $form->dropDownList($model,'status',$model->getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->