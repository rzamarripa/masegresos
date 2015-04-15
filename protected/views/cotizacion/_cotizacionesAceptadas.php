<?php $c = 0; ?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p class="text-center">No.</p></td>
					<td class="span1"><p class="text-center">Acciones</p></td>
					<td class="span2"><p class="text-center">Núm Cot.</p></td>
					<td class="span2"><p class="text-center">Núm Ord Comp.</p></td>
					<td class="span2"><p class="text-center">Fecha</p></td>
					<td class=""><p class="text-center">Unidad Organizacional</p></td>
					<td class=""><p class="text-center">Proveedor</p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizaciones as $cotizacion){ 
						if($cotizacion->estatus_did == 4){
                        $c++;  
                        $ordenCompra = OrdenCompra::model()->find("requisicion_did = ".$cotizacion->requisicion_did);
				?>
				<tr>
					<td style='text-align:center;'><?php echo $c; ?></td>	
					<td style='text-align:center;'>
					    <?php
					    	echo CHtml::link('Imprimir',array('view','id'=>$cotizacion->id),array('class'=>'btn btn-info btn-mini'));
					    /*$this->widget('bootstrap.widgets.TbButtonGroup', array(
					        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					        'buttons'=>array(
					            array('items'=>array(
					                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>
					                	array('view','id'=>$cotizacion->id)),
					                
					            )),
					        ),
					    ));*/ ?>
					</td>
					<td style='text-align:center;'><?php echo CHtml::link($cotizacion->numeroCotizacion,array('cotizacion/view', 'id'=>$cotizacion->id));?></td>
					<td style='text-align:center;'><?php echo (isset($ordenCompra->numeroOrdenCompra)) ? $ordenCompra->numeroOrdenCompra : "";?></td>
					<td style='text-align:center;'><?php echo $cotizacion->fecha_f;?></td>
					<td><?php echo $cotizacion->requisicion->unidadOrganizacional->nombre;?></td>
					<td><?php echo $cotizacion->proveedor->nombre;?></td>
				</tr>
				<?php }
				} ?>
			</tbody>
		</table>
		<div style="height:100px;"></div>
	</div>
</div>