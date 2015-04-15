
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'articulo-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div> 
	
	<?php echo $form->errorSummary($model); ?>

	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'codigo',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'codigo',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'codigo'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
			<?php echo $form->error($model,'nombre'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'unidad',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
				<?php echo $form->dropDownList($model,'unidad',CHtml::listData(Unidad::model()->findAll(), "id", "nombre")); ?>			
                <?php echo $form->error($model,'unidad'); ?>
			</div>
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
