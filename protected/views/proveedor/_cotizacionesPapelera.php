<?php
    $c = 0;
?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p style='text-align:center;'>No.</p></td>
					<td class="span1"></td>
                    <td class="span1"><p style='text-align:center;'>Número</p></td>
					<td class="span2"><p style='text-align:center;'>Fecha</p></td>
					<td class="">Unidad Organizacional</td>
					<td class="span2"></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizacionesEliminadas as $cotizacionEliminada){
                $c++;
				?>
				<tr>

                <td style='text-align:center;'><?php echo $c;?></td>
                <td></td>
                <td style='text-align:center;'><?php echo $cotizacionEliminada->requisicion->numeroRequisicion;?></td>
                <td><?php echo $cotizacionEliminada->requisicion->fecha_f;?></td>
                <td><?php echo $cotizacionEliminada->requisicion->unidadOrganizacional->nombre?></td>
                <td style='text-align:center;'>
                		<?php $this->widget('bootstrap.widgets.TbButton', array(
						    'label'=>'Recuperar',
						    'type'=>'info',
						    'icon'=>'file white',
						    'url'=>array('cambiarestatus','id'=>$cotizacionEliminada->requisicion_aid, 'estatus'=>2, 'proveedorId'=>$cotizacionEliminada->proveedor_aid),
						)); ?>
                </td>
                <?php } ?>
				</tr>
      </tbody>
    </table>
		<div style='height:100px;'></div>
  </div>
</div>