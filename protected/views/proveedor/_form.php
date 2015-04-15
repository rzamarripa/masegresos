
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'proveedor-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <div class="span4">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'codigo',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Texto</span><?php echo $form->textField($model,'codigo',array('size'=>20,'maxlength'=>20)); ?>
			        <?php echo $form->error($model,'codigo'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span8">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'usuario_did',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Selec</span>
							        <?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
								        'model'=>$model, 
								        'attribute'=>'usuario_did', 
								        'sourceUrl'=>Yii::app()->createUrl('usuario/autocompletesearch'), 
								        'showFKField'=>false,
								        'relName'=>'usuario', // the relation name defined above
								        'displayAttr'=>'usuario',  // attribute or pseudo-attribute to display
								        'options'=>array(
								            'minLength'=>1, 
								        ),
                                        'htmlOptions'=>array(
                                            'class'=>'span3',
                                        ),
							        )); ?>			<?php echo $form->error($model,'usuario_did'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
    
    <div class="row">
        <div class="span4">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'nombre',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Texto</span><?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
			        <?php echo $form->error($model,'nombre'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span8">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'rfc',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Texto</span><?php echo $form->textField($model,'rfc',array('size'=>45,'maxlength'=>45)); ?>
			        <?php echo $form->error($model,'rfc'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
    
     <div class="row">
        <div class="span4">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'direccion',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Texto</span><?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>200)); ?>
			        <?php echo $form->error($model,'direccion'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span8">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'correo',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Texto</span><?php echo $form->textField($model,'correo',array('size'=>45,'maxlength'=>45)); ?>
			        <?php echo $form->error($model,'correo'); ?>
			        </div>
		        </div>
	        </div>
        </div>
     </div>
     <div class="row">
     	<div class="span4">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Selec</span>
								        <?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(Estatus::model()->findAll('nombre IS NOT NULL'), "id", "nombre")); ?>			<?php echo $form->error($model,'estatus_did'); ?>
			        </div>
		        </div>
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