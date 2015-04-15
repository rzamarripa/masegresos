
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'orden-compra-form',
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
		<?php echo $form->labelEx($model,'numeroOrdenCompra',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'numeroOrdenCompra',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'numeroOrdenCompra'); ?>
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
																		'showOn'=>'both',
																		'buttonText'=>'<i class="icon-calendar"></i>'
																	),)); ?>			<?php echo $form->error($model,'fecha_f'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'proveedor_aid',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
							<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
						      'model'=>$model, 
						      'attribute'=>'proveedor_aid', 
						      'sourceUrl'=>Yii::app()->createUrl('proveedor/autocompletesearch'), 
						      'showFKField'=>false,
						      'relName'=>'proveedor', // the relation name defined above
						      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display
	
						      'options'=>array(
						          'minLength'=>1, 
						      ),
						 )); ?>			<?php echo $form->error($model,'proveedor_aid'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'unidadOrganizacional_aid',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
							<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
						      'model'=>$model, 
						      'attribute'=>'unidadOrganizacional_aid', 
						      'sourceUrl'=>Yii::app()->createUrl('unidadOrganizacional/autocompletesearch'), 
						      'showFKField'=>false,
						      'relName'=>'unidadOrganizacional', // the relation name defined above
						      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display
						      'options'=>array(
						          'minLength'=>1, 
						      ),
						 )); ?>			<?php echo $form->error($model,'unidadOrganizacional_aid'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'requisicion_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'requisicion_did',CHtml::listData(Requisicion::model()->findAll(), "id", "numeroRequisicion")); ?>			<?php echo $form->error($model,'requisicion_did'); ?>
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
								<?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(Estatus::model()->findAll('nombre is not null'), "id", "nombre")); ?>			<?php echo $form->error($model,'estatus_did'); ?>
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
