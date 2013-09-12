<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model, 'Por favor arregle los siguientes errores: </br></br>'); ?>

        
        
        <div class="row">
                <?php
                    /*
                    if(!$model->isNewRecord){
                        echo $model->password_hash;
                        //$model->temp_password = $model->password_hash;
                        echo '</br>';
                        echo $model->temp_password;
                    }
                     * 
                     */
                ?>
		<?php echo $form->labelEx($model,'user_password_hash'); ?>
		<?php echo $form->passwordField($model,'user_password_hash',
                        array(  'size'=>60,
                                'maxlength'=>255
                            )
                        ); ?>
		<?php echo $form->error($model,'user_password_hash'); ?>
	</div>
        
        <div class="row">
                
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',
                        array(  'size'=>60,
                                'maxlength'=>255
                            )
                        ); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>
        
        <div class="row">
                
		<?php echo $form->labelEx($model,'new_password_repeat'); ?>
		<?php echo $form->passwordField($model,'new_password_repeat',
                        array(  'size'=>60,
                                'maxlength'=>255
                            )
                        ); ?>
		<?php echo $form->error($model,'new_password_repeat'); ?>
	</div>
        
	

	<div class="row buttons">
		<?php echo CHtml::submitButton(false ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->