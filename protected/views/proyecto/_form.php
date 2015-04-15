
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'proyecto-form',
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
		<?php echo $form->labelEx($model,'nombre',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
			<?php echo $form->error($model,'nombre'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'investigador',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Texto</span><?php echo $form->textField($model,'investigador',array('size'=>60,'maxlength'=>100)); ?>
			<?php echo $form->error($model,'investigador'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'fechaInicio_f',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Fecha</span>	
							<?php
							if ($model->fechaInicio_f!='') 
								$model->fechaInicio_f=date('d-m-Y',strtotime($model->fechaInicio_f));
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	                                       'model'=>$model,
	                                       'attribute'=>'fechaInicio_f',
	                                       'value'=>$model->fechaInicio_f,
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
											),)); ?>			<?php echo $form->error($model,'fechaInicio_f'); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'fechaFin_f',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Fecha</span>	
							<?php
							if ($model->fechaFin_f!='') 
								$model->fechaFin_f=date('d-m-Y',strtotime($model->fechaFin_f));
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	                                       'model'=>$model,
	                                       'attribute'=>'fechaFin_f',
	                                       'value'=>$model->fechaFin_f,
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
											),)); ?>			<?php echo $form->error($model,'fechaFin_f'); ?>
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
		<?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on">Selec</span>
								<?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(Estatus::model()->findAll("nombre is not null"), "id", "nombre")); ?>			<?php echo $form->error($model,'estatus_did'); ?>
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
