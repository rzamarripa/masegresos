<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'detalle-inventario-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>false,
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
			<?php echo $form->labelEx($model,'articulo_aid',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php
					echo $form->dropDownList($model,'articulo_aid', CHtml::listData($articulos, 'id', 'nombre'),
						array('style'=>'width:90%;','class'=>'select2minimun2')
                 );
               ?>
			 <?php echo $form->error($model,'articulo_aid'); ?>
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'unidadOrganizacional_did',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php
					echo $form->dropDownList($model,'unidadOrganizacional_did', CHtml::listData($uos, 'id', 'nombre'),
						array(
							'style'=>'width:90%;',
							'class'=>'select2minimun4',
		                'ajax'=>array(
		                    'type'=>'POST'
		                    ,'url'=>CController::createUrl('inventario/espacios')
		                    ,'update'=>'#DetalleInventario_funcion_aid'
		                ),
		            ));
               ?>
			 <?php echo $form->error($model,'unidadOrganizacional_did'); ?>
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'espacio_aid',array('class'=>'control-label')); 
			        $funciones = CHtml::listData(Funcion::model()->findAllbySql(
			                                'SELECT 
			                                    F.id
			                                    ,F.nombre
			                                FROM Funcion as F
			                                INNER JOIN Espacio as E
			                                    ON F.id = E.funcion_did
			                                INNER JOIN UnidadOrganizacional AS U
			                                    ON E.uO_did = U.codigo
			                                WHERE U.id ='. $model->unidadOrganizacional_did.'
			                                ORDER BY nombre ASC'
			                                ), 'id', 'nombre');
			        
			        
		        ?>
		        <div class="controls">
	           		<?php	echo $form->dropDownList($model,'funcion_aid',$funciones,array(
	           									'style'=>'width:90%;border:1px black red;',
	           									'class'=>'select2',
	           									));
				         echo $form->error($model,'funcion_aid'); 
				      ?>
		        </div>
	        </div>
	</div>
</div>
<div class="row">
	<div class="span3">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'marca_aid',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php
					echo $form->dropDownList($model,'marca_aid', CHtml::listData($marcas, 'id', 'nombre'),
						array('style'=>'width:90%;','class'=>'select2minimun2')
                 );
               ?>
			 <?php echo $form->error($model,'marca_aid'); ?>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'modelo',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'modelo',array('size'=>60,'maxlength'=>100,)); ?>
				<?php echo $form->error($model,'modelo'); ?>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'serie',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'serie',array('size'=>60,'maxlength'=>100, )); ?>
				<?php echo $form->error($model,'serie'); ?>
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'costoAdquisicion',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'costoAdquisicion'); ?>
				<?php echo $form->error($model,'costoAdquisicion'); ?>
			</div>
		</div>
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php
					echo $form->dropDownList($model,'estatus_did', CHtml::listData(Estatus::model()->findAll("nombre is not null"), 'id', 'nombre'),
						array('style'=>'width:90%;','class'=>'select2minimun2')
                 );
               ?>
			 <?php echo $form->error($model,'estatus_did'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'observaciones',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'observaciones',array('rows'=>6,'style'=>'width:95%')); ?>
				<?php echo $form->error($model,'observaciones'); ?>
			</div>
		</div>
		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'info',
				'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar Inventario',
				'icon'=>'pencil white',
			)); ?>
		</div>
	</div>
</div>
	
	

<?php $this->endWidget(); ?>
