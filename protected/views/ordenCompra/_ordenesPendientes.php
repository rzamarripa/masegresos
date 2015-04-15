<?php
    $c = 0; 
?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p class="text-center">No.</p></td>
					<td class="span1"><p class="text-center">Orden Comp</p></td>
					<td class="span1"><p class="text-center">Fecha</p></td>
					<td class="span2"><p class="text-center">Proveedor</p></td>
                    <td class="span3"><p class="text-center">Unidad Org</p></td>
                    <td class="span1"><p class="text-center">Número<br/>Req</p></td>
                    <td class="span1"><p class="text-center">Subtotal</p></td>
                    <td class="span1"><p class="text-center">Iva</p></td>
                    <td class="span1"><p class="text-center">Total</p></td>
				</tr>
			</thead>
			<tbody>
            <?php foreach($ordenesPendientes as $ordenPendiente){ 
                            $c++;?>
				<tr>
					<td><p class="text-center"><?php echo $c;?></p></td>
                    <td><p class="text-center"><?php echo CHtml::link($ordenPendiente->numeroOrdenCompra,array('ordenCompra/view', 'id'=>$ordenPendiente->id)); ?></p></td>
                    <td><p class="text-center"><?php echo $ordenPendiente->fecha_f; ?></p></td>
                    <td><?php echo $ordenPendiente->proveedor->nombre; ?></td>
                    <td><?php echo $ordenPendiente->unidadOrganizacional->nombre; ?></td>
                    <td><p class="text-center"><?php echo $ordenPendiente->requisicion-> numeroRequisicion; ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenPendiente->subtotal); ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenPendiente->iva); ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenPendiente->total); ?></p></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>