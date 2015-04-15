
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'paqueterequisicionesdetalle-form',
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
		<?php echo $form->labelEx($model,'paqueteRequisicion_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'paqueteRequisicion_did',CHtml::listData(paqueterequisiciones::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'paqueteRequisicion_did'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'requisicion_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'requisicion_did',CHtml::listData(requisicion::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'requisicion_did'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'usuario_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'usuario_did',CHtml::listData(usuario::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'usuario_did'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(estatus::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'estatus_did'); ?>
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
