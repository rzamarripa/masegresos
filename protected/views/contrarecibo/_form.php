<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/controllers/contrarecibo.js"></script>
<div class="contrarecibo" ng-controller="ContrareciboController">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'contrarecibo-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
			'beforeValidate' => 'js:function (form) { return validateFacturas(form); }'
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
				                                               'language' =>'es',
				                                               'htmlOptions' => array('readonly'=>""),
				                                              'options'=> array(
															        'dateFormat'=>'yy-mm-dd',
															        'altFormat'=>'yy-mm-dd',
															        'changeMonth'=>'true',
															        'changeYear'=>'true',
															        'yearRange'=>'-10:+0',
															        'showOn'=>'both',
															        'buttonText'=>'<i class="icon-calendar"></i>'
														        ),)); ?>
								        <?php echo $form->error($model,'fecha_f'); ?>
				</div>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Proveedor</label>
			<div class="controls">
				<?php if ($model->id) { ?>
					<span class="proveedor-nombre"><?php echo $model->proveedor->nombre; ?></span>
				<?php } else { ?>
					<input class="proveedores" type="hidden" ui-select2="proveedoresOptions" name="Contrarecibo[proveedor_did][{{key}}][id]" ng-model="contrarecibo.proveedor" ng-change="buscarOrdenesCompra()" />
				<?php } ?>
			</div>
		</div>
		</div>
		<div class="span6 text-center">

			<span class="alert alert-success" style="font-size: 20pt;">
				Sumatoria:
				<a href="#" onclick="sumatoria()" class="btn btn-primary">
					<i class="icon icon-refresh icon-white"></i>
				</a>
			</span><br/><br/>
			<span id="sumatoria" type="number" class="input currencyLabel" disabled style="font-size: 14pt;"></span>
		</div>
	</div>
	<p ng-show="message">
		<strong>No hay Órdenes de Compra pendientes para este Proveedor</strong>
	</p>

	<table ng-show="ordenes.length" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Orden Compra</th>
				<th>Fecha</th>
				<th>Subtotal</th>
				<th>I.V.A.</th>
				<th>Total</th>
				<th>No. Factura</th>
				<th>F. Factura</th>
				<th>Total Factura</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="(key, orden) in ordenes">
				<td>
					{{orden.numeroOrdenCompra}}
					<input type="hidden" name="Contrarecibo[ordenes][{{key}}][id]" value="{{orden.id}}" />
				</td>
				<td>
					{{orden.fecha}}
					<input type="hidden" name="Contrarecibo[ordenes][{{key}}][fechaOrdenCompra_f]" value="{{orden.fecha}}" />
				</td>
				<td>
					{{orden.subtotal | currency}}
					<input type="hidden" name="Contrarecibo[ordenes][{{key}}][subtotal]" value="{{orden.subtotal}}" />
				</td>
				<td>
					{{orden.iva | currency}}
					<input type="hidden" name="Contrarecibo[ordenes][{{key}}][iva]" value="{{orden.iva}}" />
				</td>
				<td>
					{{orden.total | currency}}
					<input type="hidden" name="Contrarecibo[ordenes][{{key}}][total]" value="{{orden.total}}" />
				</td>
				<td class="facturas">
					<span ng-repeat="(i,factura) in orden.facturas" class="control-group" ng-class="{error: factura.error.numeroFactura}">
						<a ng-click="removeFactura(orden, factura, $event)" href="#" class="btn btn-mini"><i class="icon-minus">&nbsp;</i></a>&nbsp;
						<input type="text" ng-model="factura.numeroFactura" class="input-small" name="Contrarecibo[ordenes][{{key}}][facturas][{{i}}][numeroFactura]" class="error" />
					</span>
					<a ng-click="addFactura(orden, $event)" href="#" class="btn btn-mini"><i class="icon-plus">&nbsp;</i></a>
				</td>
				<td class="fecha_facturas">
					<span ng-repeat="(i, factura) in orden.facturas" class="control-group" ng-class="{error: factura.error.fechaFactura}">
						<input type="text" ng-model="factura.fechaFactura" class="input-small" name="Contrarecibo[ordenes][{{key}}][facturas][{{i}}][fechaFactura_f]" first-date-picker />
					</span>
				</td>

				<td class="fecha_facturas">
					<span ng-repeat="(i, factura) in orden.facturas" class="control-group" ng-class="{error: factura.error.totalFactura}">
						<input type="text" ng-model="factura.totalFactura" class="input-small totalFactura" ng-change="sumatoria();" name="Contrarecibo[ordenes][{{key}}][facturas][{{i}}][totalFactura]" />
					</span>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'SinOrdenes'));?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Aviso</h4>
        </div>

        <div class="modal-body">
            <p>No puedes guardar contrarecibos sin órdenes de compras</p>
        </div>

        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Aceptar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>

    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'SinFacturas'));?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Aviso</h4>
        </div>

        <div class="modal-body">
            <p>No puedes guardar contrarecibos sin facturas</p>
        </div>

        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Aceptar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
   <!--
 <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'Confirmacion'));?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Confirmación</h4>
        </div>

        <div class="modal-body">
            <p>¿Está seguro de crear el contrarecibo?</p>
        </div>

        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Aceptar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cancelar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
-->

<?php $this->endWidget(); ?>

	<script type="text/javascript">
		window.first = window.first || {};
		window.first.data = {

		};

		<?php if (isset($detalle)) { ?>
			window.first.data.detalle = <?php echo json_encode($detalle); ?>
		<?php } ?>

		function sumatoria(){
			var sum = 0;
			$('.totalFactura').each(function(){
			    sum += parseFloat(this.value);
			});

			$('#sumatoria').html(sum);
			$('#sumatoria').formatCurrency();
		}


	</script>
</div>


