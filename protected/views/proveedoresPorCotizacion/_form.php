
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'proveedores-por-cotizacion-form',
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
		<?php echo $form->labelEx($model,'cotizacion_aid',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
							<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
						      'model'=>$model, 
						      'attribute'=>'cotizacion_aid', 
						      'sourceUrl'=>Yii::app()->createUrl('cotizacion/autocompletesearch'), 
						      'showFKField'=>false,
						      'relName'=>'cotizacion', // the relation name defined above
						      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display
	
						      'options'=>array(
						          'minLength'=>1, 
						      ),
						 )); ?>			<?php echo $form->error($model,'cotizacion_aid'); ?>
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
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
