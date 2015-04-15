<div class="form">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'usuario-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>

	<?php echo $form->errorSummary($model,"Por favor verifique la información:"); ?>

	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'usuario',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'usuario'); ?>
		</div>
	</div>
	<?php $model->contrasena = ""; ?>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'contrasena'); ?>
		<div class="input">			
			<?php echo $form->passwordField($model,'contrasena',array('size'=>60,'maxlength'=>150)); ?>
			<?php echo $form->error($model,'contrasena'); ?>
		</div>
	</div>
	
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'comprobarPass'); ?>
			<div class="input">
				<?php echo $form->passwordField($model,'comprobarPass',array('size'=>60,'maxlength'=>20)); ?>
				<?php echo $form->error($model,'comprobarPass'); ?>
			</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div>