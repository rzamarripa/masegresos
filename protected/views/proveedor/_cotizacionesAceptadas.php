<?php
    $c = 0;
?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p style='text-align:center;'>No.</p></td>
					<td class="span1">Acciones</td>
					<td class="span2">Cotizacion</td>
					<td class="span2"><p style='text-align:center;'>Fecha de Entrega</p></td>
					<td class="">Unidad Organizacional</td>
					<td class="span2">Orden de Compra</td>

				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizacionesAceptadas as $cotizacionAceptada){
				//echo '<pre>';print_r($cotizacionAceptada); echo "</pre>";
//				exit;
                            $c++;
                            $ordenCompra = OrdenCompra::model()->find("requisicion_did = " . $cotizacionAceptada->requisicion_did);
				?>
				<tr>
                </tr>
                <td style='text-align:center;'><?php echo $c;?></td>
                <td style='text-align:left;'><?php
                        $this->widget('bootstrap.widgets.TbButtonGroup', array(
					        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					        'buttons'=>array(
					            array('items'=>array(
									array('label'=>'Ver Cotización', 'icon'=>'list-alt', 'url'=>array('cotizacion/view','id'=>$cotizacionAceptada->id,'origen'=> $cotizacionAceptada->proveedor_aid )),
									array('label'=>'Ver Requisición', 'icon'=>'list-alt', 'url'=>array('requisicion/view', 'id'=>$cotizacionAceptada->requisicion_did,'origen'=> $cotizacionAceptada->proveedor_aid )),
									array('label'=>'Ver Orden de Compra', 'icon'=>'list-alt', 'url'=>array('ordenCompra/view', 'id'=>$ordenCompra->id,'origen'=> $cotizacionAceptada->proveedor_aid )),
									            )),
									        ),
									    )); ?>
								</td>
								<td style='text-align:center;'><?php echo $ordenCompra->cotizacion->numeroCotizacion;?></td>
                <td><?php echo $cotizacionAceptada->fechaEntrega_f;?></td>
                <td><?php echo $cotizacionAceptada->requisicion->unidadOrganizacional->nombre; ?></td>
                <td style='text-align:center;'><?php echo $ordenCompra->estatus->ordenCompra;?></td>

                <?php } ?>
            </tbody>
        </table>
        <div style='height:100px;'></div>
    </div>
</div>