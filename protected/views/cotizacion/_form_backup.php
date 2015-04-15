
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'cotizacion-form',
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
		<?php echo $form->labelEx($model,'numeroCotizacion',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'numeroCotizacion',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'numeroCotizacion'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'fecha_f',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Fecha</span>	
							<?php
							if ($model->fecha_f!='') 
								$model->fecha_f=date('d-m-Y',strtotime($model->fecha_f));
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							                                       'model'=>$model,
							                                       'attribute'=>'fecha_f',
							                                       'value'=>$model->fecha_f,
							                                       'language' => 'es',
							                                       'htmlOptions' => array('readonly'=>""),
							                                      'options'=> array(
																		'dateFormat'=>'yy-mm-dd', 
																		'altFormat'=>'dd-mm-yy', 
																		'changeMonth'=>'true', 
																		'changeYear'=>'true', 
																		'yearRange'=>'-10:+0',
																		'showOn'=>'both',
																		'buttonText'=>'<i class="icon-calendar"></i>'
																	),)); ?>			<?php echo $form->error($model,'fecha_f'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'director',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'director',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'director'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'subtotal',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'subtotal'); ?>
			<?php echo $form->error($model,'subtotal'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'iva',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'iva'); ?>
			<?php echo $form->error($model,'iva'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'total',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'total'); ?>
			<?php echo $form->error($model,'total'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(Estatus::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'estatus_did'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'requisicion_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'requisicion_did',CHtml::listData(Requisicion::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'requisicion_did'); ?>
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
