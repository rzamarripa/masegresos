<?php 
	$modelProveedor = Proveedor::model()->find("id = " . $proveedor);
	$contrarecibos = Contrarecibo::model()->findAll("proveedor_did = ". $proveedor);
	foreach($contrarecibos as $contrarecibo){
		$detalles = DetalleContrarecibo::model()->findAll("estatus_did = 1 && contrarecibo_did = :c", array(":c" => $contrarecibo->id));
		if(count($detalles)>0){
			$c = 1;
			foreach($detalles as $detalle)
				$facturaspendientes[] = [$detalle["contrarecibo_did"],$detalle["numeroFactura"],$detalle["fechaFactura_f"],$detalle["totalFactura"]]; 
		}
	}
	$c=0;
	$totalFacturasPendientes = 0;

?> 
<div class="row">
	<div class="span12">
		<table  style="text-align:center;">
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
					  TELS. 713-90-11 Y 712-52-21<br>
					  CULIACÁN ROSALES, SINALOA<br/><br/><br/>
					  <h3 style="text-align:center;">PASIVO POR PROVEEDOR: <?php echo $modelProveedor->nombre; ?></h3>
					</address>
				</td>
			</tr>
		</table>
	</div>	
</div>
<br/><br/>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered">
			<thead class="thead">
				<tr>
				<th  style="text-align:center";>No.</th>
				<th  style="text-align:center";>Contrarecibo</th>
				<th  style="text-align:center";>Factura</th>
				<th  style="text-align:center";>Fecha</th>
				<th  style="text-align:center";>Importe</th>
				</tr>				
			</thead>
			<tbody>
			<?php foreach($facturaspendientes as $facturaPendiente){ $c++; $totalFacturasPendientes += $facturaPendiente[3]; ?>
				<tr>	
					<td style="text-align:center;"><?php echo $c; ?></td>
					<td style="text-align:center;"><?php echo $facturaPendiente[0]; ?></td>
					<td style="text-align:center;"><?php echo $facturaPendiente[1]; ?></td>
					<td style="text-align:center;"><?php echo $facturaPendiente[2]; ?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($facturaPendiente[3],2); ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="3"></td>
				<td><strong>Total</strong></td>
				<td style="text-align:right"><strong><?php echo "$" . number_format($totalFacturasPendientes,2); ?></strong></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
