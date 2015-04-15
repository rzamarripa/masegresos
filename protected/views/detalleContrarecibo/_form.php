
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'detalle-contrarecibo-form',
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
		<?php echo $form->labelEx($model,'id',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'id'); ?>
			<?php echo $form->error($model,'id'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'idContrarecibo',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'idContrarecibo'); ?>
			<?php echo $form->error($model,'idContrarecibo'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'idOrdenCompra',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'idOrdenCompra'); ?>
			<?php echo $form->error($model,'idOrdenCompra'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'numeroOrdenCompra',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'numeroOrdenCompra',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'numeroOrdenCompra'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'fechaOrdenCompra_f',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Fecha</span>	
							<?php
							if ($model->fechaOrdenCompra_f!='') 
								$model->fechaOrdenCompra_f=date('d-m-Y',strtotime($model->fechaOrdenCompra_f));
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							                                       'model'=>$model,
							                                       'attribute'=>'fechaOrdenCompra_f',
							                                       'value'=>$model->fechaOrdenCompra_f,
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
																	),)); ?>			<?php echo $form->error($model,'fechaOrdenCompra_f'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'subtotal',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'subtotal',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'subtotal'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'iva',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'iva',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'iva'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'total',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'total',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'total'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'numeroFactura',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'numeroFactura',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'numeroFactura'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'fechaFactura_f',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Fecha</span>	
							<?php
							if ($model->fechaFactura_f!='') 
								$model->fechaFactura_f=date('d-m-Y',strtotime($model->fechaFactura_f));
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							                                       'model'=>$model,
							                                       'attribute'=>'fechaFactura_f',
							                                       'value'=>$model->fechaFactura_f,
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
																	),)); ?>			<?php echo $form->error($model,'fechaFactura_f'); ?>
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
