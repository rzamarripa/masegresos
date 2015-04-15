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
                    <td class="span1"><p class="text-center">Número Req</p></td>
                    <td class="span1"><p class="text-center">Subtotal</p></td>
                    <td class="span1"><p class="text-center">Iva</p></td>
                    <td class="span1"><p class="text-center">Total</p></td>
				</tr>
			</thead>
			<tbody>
            <?php foreach($ordenesCanceladas as $ordenCancelada){ 
                            $c++;?>
				<tr>
					<td><p class="text-center"><?php echo $c;?></p></td>
                    <td><p class="text-center"><?php echo CHtml::link($ordenCancelada->numeroOrdenCompra,array('ordenCompra/view', 'id'=>$ordenCancelada->id)); ?></p></td>
                    <td><p class="text-center"><?php echo $ordenCancelada->fecha_f; ?></p></td>
                    <td><?php echo $ordenCancelada->proveedor->nombre; ?></td>
                    <td><?php echo $ordenCancelada->unidadOrganizacional->nombre; ?></td>
                    <td><p class="text-center"><?php echo $ordenCancelada->requisicion-> numeroRequisicion; ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenCancelada->subtotal); ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenCancelada->iva); ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenCancelada->total); ?></p></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>