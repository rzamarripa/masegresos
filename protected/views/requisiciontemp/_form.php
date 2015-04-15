
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'requisiciontemp-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>

		<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'numero',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'numero',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'numero'); ?>
			</div>
		</div>
	</div>
	
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'unidadOrganizacional_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<?php	echo $form->dropDownList($model,'unidadOrganizacional_did', 
						CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),
						array('style'=>'width:90%;','class'=>'select2minimun4')
       );?>	
			<?php echo $form->error($model,'unidadOrganizacional_did'); ?>
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
