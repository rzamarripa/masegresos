<?php
	$sumaIva = 0;
	$sumaSubTotal = 0;
	$sumaTotal = 0;
	$sumaTotalFactura = 0;
?>
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
					  <h3 style="text-align:center;">CONTRARECIBO</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>	
</div>
<div class="container">
	<div class="row">
		<div class="span12">
			<table class="table table-bordered table-condensed">
				<tr>
					<td class="span1"><strong>Proveedor</strong></td>
					<td class="span9" ><?php echo $model->proveedor->nombre; ?></td>					
					<td class="span1"><strong>Contrarecibo</strong></td>
					<td class="span1"><?php echo CHtml::link($model->id,array('contrarecibo/index')); ?></td>
				</tr>
				<tr>
					
					<td colspan="3" class="span1" style="text-align:right"><strong>Fecha</strong></td>
					<td><?php echo $model->fecha_f; ?></td>
				</tr>				
			</table>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<table class="table table-bordered table-condesed">
				<tr>
					<th>Orden Compra</th>
					<th>Fecha</th>
					<th>Subtotal</th>
					<th>I.V.A</th>
					<th>Importe</th>
					<th>No. Factura</th>
					<th>F. Fact.</th>
					<th>Total Fact.</th>
					<th>Cheque</th>
					<th>Estatus</th>
				</tr>
				<tbody>
				<?php foreach($detalleContrarecibo as $detalle){ 
						$sumaSubTotal += $detalle->subtotal;
						$sumaIva += $detalle->iva;
						$sumaTotal += $detalle->total;
						$sumaTotalFactura += $detalle->totalFactura;

					?>
					<tr>						
						<td><?php echo $detalle->numeroOrdenCompra; ?></td>
						<td><?php echo $detalle->fechaOrdenCompra_f; ?></td>
						<td style="text-align:right"><?php echo "$" . number_format($detalle->subtotal,2); ?></td>
						<td style="text-align:right"><?php echo "$" . number_format($detalle->iva,2); ?></td>
						<td style="text-align:right"><?php echo "$" . number_format($detalle->total,2); ?></td>
						<td><?php echo $detalle->numeroFactura; ?></td>
						<td><?php echo $detalle->fechaFactura_f; ?></td>
						<td style="text-align:right"><?php echo "$" . number_format($detalle->totalFactura,2); ?></td>
						<td><?php echo $detalle->cheque; ?></td>
						<td><?php echo $detalle->estatus->contrarecibo; ?></td>
					</tr>
				<?php } ?>
					<tr>
						<td colspan="2">
						<td style="text-align:right"><?php echo "$" . number_format($sumaSubTotal,2);?></td>
						<td style="text-align:right"><?php echo "$" . number_format($sumaIva,2);?></td>
						<td style="text-align:right"><?php echo "$" . number_format($sumaTotal,2);?></td>
						<td colspan="2"></td>
						<td style="text-align:right"><?php echo "$" . number_format($sumaTotalFactura,2);?></td>
						<td colspan="2"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row" style="margin-top:50px;">
		<div class="span12">
			<div style="text-align:center">
				<u><strong><?php echo "LCP. Mariela Inzunza Conde"; ?></strong></u><br/><br/><br/><br/>
				<p class="small">Recibe</p>
			</div>
		</div>
	</div>
</div>

