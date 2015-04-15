<?php	
	$contrarecibos = DetalleContrarecibo::model()->findAll("proyecto_aid = " . $_GET["id"]);
	$con = 0;
?>
<table class="table table-striped table-bordered table-condensed">
	<thead class="thead">
		<tr>
			<td>No.</td>
			<td>Contrarecibo</td>
			<td>Orden Compra</td>
			<td>Total O.C.</td>
			<td>Número Fact.</td>
			<td>Total Fact.</td>
			<td>Cheque</td>
			<td>Fecha Factura</td>
			<td>Estatus</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($contrarecibos as $contrarecibo){ $con++; ?>
		<tr>
			<td><?php echo $con;?></td>	
			<td><?php echo $contrarecibo->contrarecibo->id;?></td>	
			<td><?php echo $contrarecibo->ordenCompra->numeroOrdenCompra;?></td>
			<td><?php echo $contrarecibo->total;?></td>	
			<td><?php echo $contrarecibo->numeroFactura;?></td>	
			<td><?php echo $contrarecibo->totalFactura;?></td>
			<td><?php echo $contrarecibo->cheque;?></td>
			<td><?php echo $contrarecibo->fechaFactura_f;?></td>	
			<td><?php echo $contrarecibo->estatus->contrarecibo;?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>