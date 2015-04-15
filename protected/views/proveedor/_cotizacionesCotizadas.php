<?php $c = 0; 	 ?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p style='text-align:center;'>No.</p></td>
					<td class="span1">Acciones</td>
					<td class="span1"><p style='text-align:center;'>Número</p></td>
					<td class="span2"><p style='text-align:center;'>Fecha de Entrega</p></td>
					<td class="">Unidad Organizacional</td>
					<td class="span2"></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizacionesCotizadas as $cotizacionCotizada){ 
                            $c++;
				?>
				<tr>
                    <td style='text-align:center;'><?php echo $c;?></td>
                    <td style='text-align:center;'><?php 					    
                            $this->widget('bootstrap.widgets.TbButtonGroup', array(
					            'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					            'buttons'=>array(
					                array('items'=>array(
					                    array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('cotizacion/view','id'=>$cotizacionCotizada->id,'origen'=> $cotizacionCotizada->proveedor_aid )),
					                    array('label'=>'Imprimir Cot.', 'icon'=>'print', 'url'=>array('cotizacion/imprimir','id'=>$cotizacionCotizada->id)),
					                    array('label'=>'Actualizar Cot.', 'icon'=>'pencil', 'url'=>array('cotizacion/update','id'=>$cotizacionCotizada->id)),					                    
					                )),
					            ),
					        )); ?>
				    </td>
                    <td style='text-align:center;'><?php echo $cotizacionCotizada->numeroCotizacion; ?></td>
                    <td><?php echo $cotizacionCotizada->fechaEntrega_f; ?></td>
                    <td><?php echo $cotizacionCotizada->requisicion->unidadOrganizacional->nombre; ?></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div style='height:100px;'></div>
    </div>
</div>