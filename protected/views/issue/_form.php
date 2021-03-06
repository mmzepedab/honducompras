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

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',$model->getCategories()); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'reception_type_id'); ?>
		<?php echo $form->dropDownList($model,'reception_type_id',$model->getReceptionTypes()); ?>
		<?php echo $form->error($model,'reception_type_id'); ?>
	</div>
        

	<div class="row">
		<?php echo $form->labelEx($model,'assigned_to'); ?>  
            
                <?php echo $form->dropDownList($model,'assigned_to',$model->getUsers()); ?>
		<?php /* echo $form->textField($model,'assigned_to',array('size'=>60,'maxlength'=>255)); */ ?> 
		<?php echo $form->error($model,'assigned_to'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'institution_id'); ?>  
            
                <?php echo $form->dropDownList($model,'institution_id',  array(NULL => 'Seleccione una...',0=>'Otras') + $model->getInstitutions()); ?>
		<?php /* echo $form->textField($model,'assigned_to',array('size'=>60,'maxlength'=>255)); */ ?> 
		<?php echo $form->error($model,'institution_id'); ?>
	</div>

	<div class="row" id="institution_name_div">
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
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('maxlength' => 300, 'rows' => 10, 'cols' => 70)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">            
		<?php echo $form->labelEx($model,'status'); ?>
                <?php echo $form->dropDownList($model,'status',$model->getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $("#institution_name_div").hide();
      $( "#Issue_institution_id" ).change(function() {
            if($( "#Issue_institution_id option:selected" ).val() == 0){
                $("#institution_name_div").show();
            }else{
                $("#institution_name_div").hide();
            }
          
      });
</script>