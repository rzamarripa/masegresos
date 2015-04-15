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
            <?php foreach($ordenesAgendadas as $ordenesAgendada){ 
                            $c++;?>
				<tr>
					<td><p class="text-center"><?php echo $c;?></p></td>
                    <td><p class="text-center"><?php echo CHtml::link($ordenesAgendada->numeroOrdenCompra,array('ordenCompra/view', 'id'=>$ordenesAgendada->id)); ?></p></td>
                    <td><p class="text-center"><?php echo $ordenesAgendada->fecha_f; ?></p></td>
                    <td><?php echo $ordenesAgendada->proveedor->nombre; ?></td>
                    <td><?php echo $ordenesAgendada->unidadOrganizacional->nombre; ?></td>
                    <td><p class="text-center"><?php echo $ordenesAgendada->requisicion-> numeroRequisicion; ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenesAgendada->subtotal); ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenesAgendada->iva); ?></p></td>
                    <td><p class="text-right"><?php echo "$" . Cotizacion::model()->formatMoney($ordenesAgendada->total); ?></p></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>