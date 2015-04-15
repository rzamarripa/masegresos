<table class="table table-striped table-bordered table-hover table-condensed">
	<thead class="thead">
		<tr>
			<td class="span1"><p class="text-center">No.</p></td>
			<td class="span1"><p class="text-center">Número OC.</p></td>
			<td class="span2" ><p class="text-center">Fecha</p></td>
			<td><p class="text-center">Proveedor</p></td>
			<td class="span1"><p class="text-center">Req.</p></td>
			<td class="span1"><p class="text-center">Subtotal</p></td>
			<td class="span1"><p class="text-center">IVA</p></td>
			<td class="span1"><p class="text-center">Total</p></td>
			<td class="span1"><p class="text-center">Estatus</p></td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$c = 0;
			foreach($ordenes as $orden){  $c++;
		?>
		<tr>
            <td><p class="text-center"><?php echo $c;?></p></td>                
            <td><p class="text-center"><?php echo $orden->numeroOrdenCompra; ?></p></td>
            <td><p class="text-center"><?php echo $orden->fecha_f; ?></p></td>
            <td><?php echo $orden->proveedor->nombre; ?></td>
            <td><p class="text-center"><?php echo $orden->requisicion->numeroRequisicion;?></p></td>
            <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($orden->subtotal); ?></p></td>
            <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($orden->iva); ?></p></td>
            <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($orden->total); ?></p></td>
            <td><p class="text-center"><?php echo $orden->estatus->cotizacion;?></p></td>                
        </tr>
        <?php } ?>				
    </tbody>
</table>