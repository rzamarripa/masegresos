 
<div classs="cotizacion" ng-controller="CotizacionController">

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'cotizacion-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
			'validateOnChange' => true,
			'beforeValidate' => 'js:function (form) { return validarCotizacion(form) }'
		)
	)); 
	?>

	<input type="hidden" name="Cotizacion[requisicion_did]" value="{{requisicion.id}}">

	<div class="row">
		<div class="<?php echo 'control-group'; ?>">			
			<!--label class='control-label' for="fechaEntrega_f">Fecha de entrega</label-->
			<?php echo $form->labelEx($model,'fechaEntrega_f',array('class'=>'control-label')); ?>
			<div class="controls">
				<div class="input-prepend">
				<span class="add-on">Fecha</span>	
								<?php
								if ($model->fechaEntrega_f!='') 
									$model->fechaEntrega_f=date('d-m-Y',strtotime($model->fechaEntrega_f));
								$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				                                       'model'=>$model,
				                                       'attribute'=>'fechaEntrega_f',
				                                       'value'=>$model->fechaEntrega_f,
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
														),)); ?>								
						<?php echo $form->error($model,'fechaEntrega_f'); ?>
				</div>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Artículo</th>
					<th>Observaciones</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="(key,item) in items">
					<td>
						{{item.articulo.nombre}}
						<input type="hidden" name="detalle[{{key}}][articulo_aid]" value="{{item.articulo.id}}" />
					</td>
					<td>
						{{item.observaciones}}
						<input type="hidden" name="detalle[{{key}}][observaciones]" value="{{item.observaciones}}" />
					</td>
					<td>
						{{item.cantidad}}
						<span class="control-group" ng-class="{error: item.error.cantidad}" >
							<input ng-change="calcularTotal(item)" class="input-mini" type="hidden" ng-model="item.cantidad" name="detalle[{{key}}][cantidad]" />
						</span>
					</td>
					<td>
						<div class="input-prepend control-group" ng-class="{error: item.error.precio}">
							<span class="add-on">$</span>
							<input ng-change="calcularTotal(item)" class="input-small" type="text" ng-model="item.precio" placeholder="0.00" name="detalle[{{key}}][precioUnitario]" />
						</div>
					</td>
					<td>
						{{item.importe | currency}}
						<input type="hidden" name="detalle[{{key}}][importe]" value="{{item.importe}}" />
					</td>
				</tr>
			</tbody>
			<tfoot class="cotizacion">
				<tr>
					<td colspan="4" align="right">Subtotal:</td>
					<td>
						{{totales.subtotal | currency}}
						<input type="hidden" name="Cotizacion[subtotal]" value="{{totales.subtotal}}" />
					</td>
				</tr>
				<tr>
					<td colspan="4" align="right">IVA:</td>
					<td>
						{{totales.iva | currency}}
						<input type="hidden" name="Cotizacion[iva]" value="{{totales.iva}}" />
					</td>
				</tr>
				<tr>
					<td colspan="4" align="right">Total:</td>
					<td>
						{{totales.total | currency}}
						<input type="hidden" name="Cotizacion[total]" value="{{totales.total}}" />
					</td>
				</tr>
			</tfoot>
		</table>
		
	</div>

	<!--input ng-click="validarCotizacion($event)" type="submit" class="btn btn-info" value="<?php //echo $model->isNewRecord ? 'Crear' : 'Guardar' ?>"-->

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'info',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>

	<script type="text/javascript">
		window.first = window.first || {};
		window.first.data = {
			requisicion: <?php echo json_encode($requisicion); ?>
		}
		<?php if (isset($detalle_cotizacion)) { ?>
			window.first.data.detalle_cotizacion = <?php echo json_encode($detalle_cotizacion); ?>
		<?php } ?>
	</script>

</div>