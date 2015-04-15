<div ng-controller="RequisicionFormCtrl">
	<script type="text/javascript">
		window.first = window.first || {};
		window.first.data = window.first.data || {};
		<?php if (isset($detalle)) { ?>
			window.first.data.detalle = <?php echo json_encode($detalle); ?>;
		<?php } else { ?>
			window.first.data.detalle = null;
		<?php } ?>
	</script>

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'requisicion-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13'),
		'clientOptions' => array(
			'validateOnSubmit' => true,
			'beforeValidate' => 'js:function (form) { return validateDetalle(form) }'
		)
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span6">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'numeroRequisicion',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Texto</span><?php echo $form->textField($model,'numeroRequisicion',array('size'=>20,'maxlength'=>20)); ?>
					<?php echo $form->error($model,'numeroRequisicion'); ?>
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
										$model->fecha_f=date('Y-m-d',strtotime($model->fecha_f));
									    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
									                                           'model'=>$model,
									                                           'attribute'=>'fecha_f',
									                                           'value'=>$model->fecha_f,
									                                           'language' => 'es',
									                                           'htmlOptions' => array('readonly'=>""),
									                                          'options'=> array(
																				    'dateFormat'=>'yy-mm-dd', 
																				    'altFormat'=>'yy-mm-dd', 
																				    'changeMonth'=>'true', 
																				    'changeYear'=>'true', 
																				    'showOn'=>'both',
																				    'buttonText'=>'<i class="icon-calendar"></i>'
																			    ),)); ?>			<?php echo $form->error($model,'fecha_f'); ?>
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
                                      'htmlOptions'=>array(
                                            'class'=>'span4',
                                      ),
								 )); ?>			<?php echo $form->error($model,'unidadOrganizacional_aid'); ?>
					</div>
				</div>
			</div>
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'comentarios',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Texto</span><?php echo $form->textArea($model,'comentarios',array('rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'comentarios'); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="span6">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'director',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Texto</span><?php echo $form->textField($model,'director',array('size'=>60,'maxlength'=>100, "value" => "C. Norma Alicia Aguilar Navarro", "readonly" => "readonly")); ?>
					<?php echo $form->error($model,'director'); ?>
					</div>
				</div>
			</div>
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'titular',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Texto</span><?php echo $form->textField($model,'titular',array('size'=>60,'maxlength'=>100)); ?>
					<?php echo $form->error($model,'titular'); ?>
					</div>
				</div>
			</div>
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'recibio',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Texto</span><?php echo $form->textField($model,'recibio',array('size'=>60,'maxlength'=>100)); ?>
					<?php echo $form->error($model,'recibio'); ?>
					</div>
				</div>
			</div>
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'entrego',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Texto</span><?php echo $form->textField($model,'entrego',array('size'=>60,'maxlength'=>100)); ?>
					<?php echo $form->error($model,'entrego'); ?>
					</div>
				</div>
			</div>
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'estatus_did',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<span class="add-on">Selec</span>
						<?php echo $form->dropDownList($model,'estatus_did',CHtml::listData(Estatus::model()->findAll("nombre IS NOT NULL"), "id", "nombre")); ?>			
						<?php echo $form->error($model,'estatus_did'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Cantidad</th>
				<th>Descripción</th>
				<th>Unidad</th>
				<th>Observaciones</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(key,item) in items">
				<td>
					<span class="control-group" ng-class="{true: 'error', false: ''}[item.error.cantidad]">
						<input id="item_{{key}}" name="detalle[{{key}}][cantidad]" ng-keypress="enter(item, $event)" type="text" ng-model="item.cantidad" class="input-mini" />
					</span>
				</td>
				<td>
					<span class="control-group" ng-class="{true: 'error', false: ''}[item.error.articulo]">
						<input class="articulo" type="hidden" ui-select2="articulosOptions" name="detalle[{{key}}][articulo]" ng-model="item.articulo" />
					</span>
				</td>
				<td>
					{{item.articulo.unidad}}					
				</td>
				<td>
					<input name="detalle[{{key}}][observaciones]" ng-keypress="enter(item, $event)" type="text" ng-model="item.observaciones" />
				</td>
				<td>
					<button ng-click="cancelar(item, $event)" class="btn btn-mini btn-danger">Cancelar</button>
				</td>
			</tr>
		</tbody>
	</table>
	<a ng-click="agregar()" href="" class="btn"><i class="icon-plus">&nbsp;</i></a>

	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'info',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
            'htmlOptions'=>array(
                'data-toggle'=>'modal',
                'data-target'=>'#myModal',
                'style'=>'float:right; width:57px;',
            ),
        )); ?>

    	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'info',
			'label'=>"Cancelar",
			'htmlOptions'=>array(
				'data-toggle'=>'modal',
                'data-target'=>'#myModalCanc',
				'style'=>'float:right;margin-right:15px;',
			),
		)); ?>
        
        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Confirmación</h4>
            </div>
 
            <div class="modal-body">
                <p>¿Está seguro de que desea crear esta requisición ?</p>
            </div>
 
            <div class="modal-footer">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'type'=>'info',
                    'label'=>'Guardar',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal','onclick'=>'$("#requisicion-form").submit()'),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Cancelar',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>
            </div>
 
        <?php $this->endWidget(); ?>

        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModalCanc')); ?>
 
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4>Confirmación</h4>
            </div>
 
            <div class="modal-body">
                <p>¿Está seguro de que desea cancelar ?</p>
            </div>
 
            <div class="modal-footer">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'No',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'info',
                    'label'=>'Si',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal','onclick'=>'window.location.href="index"'),
                )); ?>
            </div>
 
        <?php $this->endWidget(); ?>
	</div>
    
	<?php $this->endWidget(); ?>
</div>
