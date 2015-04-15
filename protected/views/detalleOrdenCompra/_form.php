
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'detalle-orden-compra-form',
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
		<?php echo $form->labelEx($model,'cantidad',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'cantidad'); ?>
			<?php echo $form->error($model,'cantidad'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'articulo_aid',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
							<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
						      'model'=>$model, 
						      'attribute'=>'articulo_aid', 
						      'sourceUrl'=>Yii::app()->createUrl('articulo/autocompletesearch'), 
						      'showFKField'=>false,
						      'relName'=>'articulo', // the relation name defined above
						      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display
	
						      'options'=>array(
						          'minLength'=>1, 
						      ),
						 )); ?>			<?php echo $form->error($model,'articulo_aid'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'precioUnitario',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'precioUnitario'); ?>
			<?php echo $form->error($model,'precioUnitario'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'importe',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'importe'); ?>
			<?php echo $form->error($model,'importe'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'ordenCompra_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'ordenCompra_did',CHtml::listData(OrdenCompra::model()->findAll(), "id", "nombre")); ?>			<?php echo $form->error($model,'ordenCompra_did'); ?>
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
