<?php $c=0; ?>
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
					  <h3 style="text-align:center;">COTIZACIÓN</h3>
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
					<td class="span5"><?php echo $model->proveedor->nombre; ?></td>
					<td class="span1"><strong>No Req.</strong></td>
					<td class="span1"><?php echo $model->requisicion->numeroRequisicion; ?></td>
					<td class="span1"><strong>No Cot.</strong></td>
					<td class="span1"><?php echo $model->numeroCotizacion; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td colspan="3"><?php echo $model->proveedor->direccion; ?></td>
					<td><strong>Fecha</strong></td>
					<td><?php echo date("d-m-Y", strtotime($model->fecha_f)); ?></td>
				</tr>	
				<tr>
					<td><strong>Unidad Organizacional</strong></td>
					<td colspan="5"><?php echo $model->requisicion->unidadOrganizacional->nombre; ?></td>
				</tr>			
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>					
					<td class="span2"><p class="text-center ">Cantidad</p></td>
					<td>Artículo</td>
					<td>Unidad</td>
					<td class="span2"><p class="text-center ">Precio Unitario</p></td>
					<td class="span2"><p class="text-center ">Importe</p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleCotizacion as $detalle){ $c++;?>
				<tr>					
					<td><p class="text-center"><?php echo $detalle->cantidad;?></p></td>
					<td><?php echo $detalle->articulo->nombre;?></td>
					<td><?php echo $detalle->articulo->unidad;?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->precioUnitario,2);?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->importe,2);?></td>
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
					<td class="span9" rowspan="4">
						<strong>Cantidad con letra</strong><br/><br/><?php $this->widget('ext.numaletras.numerosALetras', array('valor'=>$model->total)); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right"><strong>Subtotal</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->subtotal,2); ?></td>
				</tr>
				<tr>
					<td style="text-align:right"><strong>IVA</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->iva,2); ?></td>
				</tr>
				<tr>
					<td style="text-align:right"><strong>Total</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->total,2); ?></td>	
				</tr>
			</tbody>
		</table>
		<br/><br/><br/><br/>
		<div style="text-align:center">
			<u><strong><?php echo $model->requisicion->director; ?></strong></u>
			<p class="small">DIRECTOR DE CONTROL DE BIENES E INVENTARIOS</p>
		</div>
	</div>
</div>