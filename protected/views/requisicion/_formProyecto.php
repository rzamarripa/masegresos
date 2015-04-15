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
																				'yearRange'=>'-10:+0', 
																				'showOn'=>'both',
																				'buttonText'=>'<i class="icon-calendar"></i>'
																			),)); ?>			<?php echo $form->error($model,'fecha_f'); ?>
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
					<!--select class="unidad" ui-select2 name="detalle[{{key}}][unidad]" ng-model="item.unidad">
						<option value=""></option>
						<option ng-repeat="unidad in unidades" value="{{unidad.id}}">{{unidad.nombre}}</option>
					</select-->
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
		<?php 		
		
		$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'info',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
