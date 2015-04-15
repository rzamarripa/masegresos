<?php $detalleOrdenCompra = DetalleOrdenCompra::model()->findAll("ordenCompra_did = " . $model->id); ?>
<div class="row">
	<div class="span12">
		<table style="text-align:center;">
			<tr>
				<td class="span3" style="text-align:right;">
					<img src="<?php echo Yii::app()->baseUrl;?>/images/uaslogo.jpg" alt="logoUas" width="150" height="150">
				</td>
				<td class="span8">
					<h3>UNIVERSIDAD AUTÓNOMA DE SINALOA</h3>
					<p class="lead muted">DIRECCIÓN DE CONTROL DE BIENES E INVENTARIOS</p>
					<address class="muted">
					  GRAL. ÁNGEL FLORES PONIENTE. SIN NÚMERO<br>
					  COL. CENTRO C.P. 80000<br>
					  TELS. 759-77-74<br>
					  CULIACÁN ROSALES, SINALOA<br/><br/><br/>
					  <h3 style="text-align:center;">ORDEN DE COMPRA</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Proveedor</strong></td>
					<td class="span4"><?php echo $model->proveedor->nombre; ?></td>
					<td class="span2"><strong>Orden de Compra</strong></td>
					<td class="span3"><?php echo $model->numeroOrdenCompra; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php echo $model->proveedor->direccion; ?></td>
					<td><strong>Fecha</strong></td>
					<td><?php echo date("d-m-Y", strtotime($model->fecha_f)); ?></td>
				</tr>

			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span12">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2">
						<strong>Unidad Organizacional</strong>
					</td>
					<td class="span4">
						<?php echo $model->unidadOrganizacional->codigo . " - " . $model->unidadOrganizacional->nombre;?>
					</td>
					<td class="span2"><strong>No. Req.</strong></td>
					<td class="span3"><?php echo $model->requisicion->numeroRequisicion; ?></td>
				</tr>
				<tr>
					<td class="span2">
						<strong>Comentario Requisición</strong>
					</td>
					<td colspan="3" class="span9">
						<?php echo $model->requisicion->comentarios;?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span12">
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
					<td class="ajustar"><?php echo $detalle->articulo->nombre; ?></td>
					<td style="text-align:center"><?php echo $detalle->articulo->unidad; ?></td>
					<td style="text-align:center"><?php echo $detalle->cantidad; ?></td>
					<td style="text-align:right"><?php echo number_format($detalle->precioUnitario,2); ?></td>
					<td style="text-align:right"><?php echo number_format($detalle->importe,2); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span8" rowspan="4">
						<strong>Cantidad con letra</strong><br/><br/><?php $this->widget('ext.numaletras.numerosALetras', array('valor'=>$model->total)); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right"><strong>Subtotal</strong></td>
					<td style="text-align:right" class="span2"><?php echo number_format($model->subtotal,2); ?></td>
				</tr>
				<tr>
					<td style="text-align:right"><strong>IVA</strong></td>
					<td style="text-align:right" class="span2"><?php echo number_format($model->iva,2); ?></td>
				</tr>
				<tr>
					<td style="text-align:right"><strong>Total</strong></td>
					<td style="text-align:right" class="span2"><?php echo number_format($model->total,2); ?></td>
				</tr>
			</tbody>
		</table>
		<br/><br/>
		<div style="text-align:center">
			<u><strong><?php echo $model->requisicion->director; ?></strong></u>
			<p class="small">DIRECTOR DE CONTROL DE BIENES E INVENTARIOS</p>
		</div>
	</div>
</div>