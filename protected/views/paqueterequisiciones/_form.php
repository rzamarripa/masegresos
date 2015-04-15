
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'paqueterequisiciones-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>

		<div class="control-group">
			<?php echo $form->labelEx($model,'nombre',array('class'=>'control-label')); ?>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">Texto</span>
					<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>100)); ?>
				</div>
				<?php echo $form->error($model,'nombre'); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'enviadoa',array('class'=>'control-label')); ?>
			<div class="controls">
			<div class="input-prepend">
				<span class="add-on">Texto</span>
				<?php echo $form->dropDownList($model,'enviadoa',array("0"=>"Almacén", "1"=>"Pagos"), array("empty"=>"--Departamento--", "style"=>"width:200px;")); ?>
			</div>
			<?php echo $form->error($model,'enviadoa'); ?>			
		</div>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Agregar Requisiciones' : 'Guardar',
		)); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>
