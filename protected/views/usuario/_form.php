
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'usuario-form',
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
		        <?php echo $form->labelEx($model,'usuario',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			            <span class="add-on">Texto</span><?php echo $form->textField($model,'usuario',array('size'=>60,'maxlength'=>100)); ?>
			                                            <?php echo $form->error($model,'usuario'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span8">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'tipoUsuario_did',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Selec</span>
								        <?php echo $form->dropDownList($model,'tipoUsuario_did',CHtml::listData(TipoUsuario::model()->findAll(), "id", "nombre")); ?>			
                                        <?php echo $form->error($model,'tipoUsuario_did'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
    
    <div class="row">
        <div class="span4">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'contrasena',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			            <span class="add-on">Texto</span><?php echo $form->passwordField($model,'contrasena',array('size'=>60,'maxlength'=>20)); ?>
			                                            <?php echo $form->error($model,'contrasena'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span8">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
			        <span class="add-on">Selec</span>
					  		<?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(Estatus::model()->findAll('nombre is not null'), "id", "nombre")); ?>			
					  		<?php echo $form->error($model,'estatus_did'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
    
    <div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'comprobarPass',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			    <span class="add-on">Texto</span><?php echo $form->passwordField($model,'comprobarPass',array('size'=>60,'maxlength'=>20)); ?>
			                                    <?php echo $form->error($model,'comprobarPass'); ?>
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
