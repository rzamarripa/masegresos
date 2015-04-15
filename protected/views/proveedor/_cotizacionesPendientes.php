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
					<td class="span1"><p style='text-align:center;'>Número</p></td>
					<td class="">Unidad Organizacional</td>
					<td class="span2"></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizacionesPendientes as $cotizacionPendiente){ 
							    $c++;
                ?>
				<tr>
	                <td style='text-align:center;'><?php echo $c;?></td>
	                <td style='text-align:center;'><?php 					    
	                        $this->widget('bootstrap.widgets.TbButtonGroup', array(
						        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
						        'buttons'=>array(
						            array('items'=>array(
						                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array(
						                	'requisicion/view','id'=>$cotizacionPendiente->requisicion_aid,
						                	'origen'=>'proveedor',
						                	'proveedorId' => $cotizacionPendiente->proveedor_aid)),
						                array('label'=>'Imprimir Req.', 'icon'=>'print', 'url'=>array('requisicion/imprimir','id'=>$cotizacionPendiente->requisicion_aid)),
						                '---',

						                array('label'=>'Eliminar', 'icon'=>'trash', 'url'=>array('cambiarestatus','id'=>$cotizacionPendiente->requisicion_aid, 'estatus'=>6, 'proveedorId'=>$cotizacionPendiente->proveedor_aid)),
						            )),
						        ),
						    )); ?>
					</td>
	                <td style='text-align:center;'><?php echo $cotizacionPendiente->requisicion->numeroRequisicion;?></td>
	                <td><?php echo $cotizacionPendiente->requisicion->unidadOrganizacional->nombre; ?></td>
	                <td style='text-align:center;'>
	                		<?php $this->widget('bootstrap.widgets.TbButton', array(
							    'label'=>'Cotizar',
							    'type'=>'info',
							    'icon'=>'file white',
	                            'url'=>array('cotizacion/create','requisicion_id'=>$cotizacionPendiente->requisicion_aid),
							)); ?>
	                </td>
				</tr>
                <?php } ?>
            </tbody>
        </table>
        <div style='height:100px;'></div>
    </div>
</div>

<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) { //save the latest tab; use cookies if you like 'em better: 
				localStorage.setItem('ultimoContenidoCotizacionProveedor', $(e.target).attr('href')); 
		}); //go to the latest tab, if it exists: 
		 
		var ultimoContenidoCotizacionProveedor = localStorage.getItem('ultimoContenidoCotizacionProveedor'); 
		if (ultimoContenidoCotizacionProveedor) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoCotizacionProveedor +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoCotizacionProveedor).addClass('active');
		} 
	});
</script>