<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Proveedor</strong></td>
					<td class="span5"><?php echo $model->proveedor->nombre; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php echo $model->proveedor->direccion; ?></td>
				</tr>				
			</tbody>
		</table>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Orden de Compra</strong></td>
					<td class="span2"><?php echo $model->numeroOrdenCompra; ?></td>
				</tr>
				<tr>
					<td><strong>Fecha</strong></td>
					<td><?php echo $model->fecha_f; ?></td>
				</tr>				
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2">
						<strong>Unidad Organizacional</strong>
					</td>
					<td class="span9">
						<?php echo $model->unidadOrganizacional->nombre;?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>	
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<thead>
				<tr>
					<td style="text-align:center"><strong>Código</strong></td>
					<td style="text-align:center"><strong>Descripción</strong></td>
					<td style="text-align:center"><strong>Unidad</strong></td>
					<td style="text-align:center"><strong>Cantidad</strong></td>
					<td style="text-align:center"><strong>P. Unitario</strong></td>
					<td style="text-align:center"><strong>Total</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleOrdenCompra as $detalle){ ?>
				<tr>
					<td style="text-align:center"><?php echo $detalle->articulo->id; ?></td>
					<td><?php echo $detalle->articulo->nombre; ?></td>
					<td style="text-align:center"><?php echo $detalle->articulo->unidad; ?></td>
					<td style="text-align:center"><?php echo $detalle->cantidad; ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->precioUnitario); ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->importe); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>	
</div>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span7"><strong>Cantidad con letra</strong><br><?php $this->widget('ext.numaletras.numerosALetras', array('valor'=>$model->total)); ?></td>
				</tr>
			</tbody>
		</table>
		<div class="text-center">
			<u><strong><?php echo $model->requisicion->director; ?></strong></u>
			<p class="small">DIRECTOR DE CONTROL DE BIENES E INVENTARIOS</p>
		</div>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Subtotal</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->subtotal); ?></td>
				</tr>
				<tr>
					<td class="span2"><strong>IVA</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->iva); ?></td>
				</tr>
				<tr>
					<td class="span2"><strong>Total</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->total); ?></td>	
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php } else{ ?>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Proveedor</strong></td>
					<td class="span5"><?php echo $model->proveedor->nombre; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php echo $model->proveedor->direccion; ?></td>
				</tr>				
			</tbody>
		</table>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Orden de Compra</strong></td>
					<td class="span2"><?php echo $model->numeroOrdenCompra; ?></td>
				</tr>
				<tr>
					<td><strong>Fecha</strong></td>
					<td><?php echo $model->fecha_f; ?></td>
				</tr>				
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2">
						<strong>Unidad Organizacional</strong>
					</td>
					<td class="span9">
						<?php echo $model->unidadOrganizacional->codigo . " - " . $model->unidadOrganizacional->nombre;?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>	
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<thead>
				<tr>
					<td style="text-align:center"><strong>Código</strong></td>
					<td style="text-align:center"><strong>Descripción</strong></td>
					<td style="text-align:center"><strong>Unidad</strong></td>
					<td style="text-align:center"><strong>Cantidad</strong></td>
					<td style="text-align:center"><strong>P. Unitario</strong></td>
					<td style="text-align:center"><strong>Total</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleOrdenCompra as $detalle){ ?>
				<tr>
					<td style="text-align:center"><?php echo $detalle->articulo->codigo; ?></td>
					<td><?php echo $detalle->articulo->nombre; ?></td>
					<td style="text-align:center"><?php echo $detalle->articulo->unidad; ?></td>
					<td style="text-align:center"><?php echo $detalle->cantidad; ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->precioUnitario); ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->importe); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>	
</div>
<?php } 
	
	if($usuarioActual->tipoUsuario->nombre == "Almacen" && $model->estatusAlmacen_did >= 2){
		$detalleBitacoras = BitacoraAlmacenes::model()->findAll("ordenCompra_did = :o", array(':o' =>$model->id)); 
		$b = 0;
		?>
		<hr>
		<div class="well">
			<h3>Historial de movimientos</h3>
			<table class="table table-striped table-bordered table-condensed">
				<thead class="thead">
					<tr>
						<td style="text-align:center">No.</td>
						<td style="text-align:center">Fecha Movimiento</td>
						<td style="text-align:center">Responsable</td>
						<td style="text-align:center">Tipo de Movimiento</td>
						<td style="text-align:center">Almacenista</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($detalleBitacoras as $detalleBit){ $b++; ?>
					<tr>
						<td style="text-align:center"><?php echo $b;?></td>	
						<td style="text-align:center"><?php echo $detalleBit->fechaCreacion_f;?></td>	
						<td style="text-align:center"><?php echo $detalleBit->usuario->usuario;?></td>			
						<td style="text-align:center"><?php 
								if($detalleBit->estatus_did == 1)
									echo '<span class="label label-success">' . $detalleBit->estatus->bitacora . '</span>';
								else if($detalleBit->estatus_did == 2)
									echo '<span class="label label-important">' . $detalleBit->estatus->bitacora . '</span>';
							?></td>	
						<td style="text-align:left"><?php echo $detalleBit->nombreRecibioAlmacen;?></td>	
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
	<?php } ?>
	<hr>
	<?php
		if($usuarioActual->tipoUsuario->nombre == "Almacen"){ ?>
	<div class="row">
		<div class="span5 offset6 img-rounded" style="border: 1px solid #cecece">
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'orden-compra-form',
				'type'=>'horizontal',
				'enableAjaxValidation'=>false,
			)); ?>
			
			<?php echo $form->errorSummary($model); ?>
			
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'comentarioAlmacenista',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<?php echo $form->textArea($model,'comentarioAlmacenista'); ?>
					<?php echo $form->error($model,'comentarioAlmacenista'); ?>
					</div>
				</div>
			</div>
			
			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'info',
					'label'=>$model->isNewRecord ? 'Comentar' : 'Guardar',
				)); ?>
			</div>
		
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<?php } ?>