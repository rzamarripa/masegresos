<?php $c = 0; ?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p class="text-center">No.</p></td>
					<td class="span1"><p class="text-center">Acciones</p></td>
					<td class="span1"><p class="text-center">Número Cot.</p></td>
					<td class="span2"><p class="text-center">Fecha</p></td>
					<td class=""><p class="text-center">Número Req.</p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizaciones as $cotizacion){ $c++;
								if($cotizacion->estatus_did == 6){?>
				<tr>
					<td><?php echo $c;?></td>	
					<td>
					    <?php
					    $this->widget('bootstrap.widgets.TbButtonGroup', array(
					        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					        'buttons'=>array(
					            array('items'=>array(
					                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$cotizacion->id)),
					                '---',
					                array('label'=>'Eliminar', 'icon'=>'trash', 'url'=>array('cambiarestatus','id'=>$cotizacion->id, 'estatus'=>5)),
					            )),
					        ),
					    )); ?>
					</td>
					<td><?php echo CHtml::link($cotizacion->numeroCotizacion,array('requisicion/view', 'id'=>$cotizacion->id));?></td>
					<td><?php echo $cotizacion->fecha_f;?></td>
					<td><?php echo $cotizacion->requisicion->numeroRequisicion;?></td>
				</tr>
				<?php }
				} ?>
			</tbody>
		</table>
		<div style="height:100px;"></div>
	</div>
</div>