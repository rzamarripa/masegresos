<?php
$c = 0;
?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1 "><p class="text-center">No.</p></td>
					<td class="span1"><p class="text-center">Acciones</p></td>
					<td class="span2"><p class="text-center">Número Req.</p></td>
					<td class="span2"><p class="text-center">Fecha</p></td>
					<td class=""><p class="text-center">Unidad Organizacional</p></td>
					<td class="span2"><p class="text-center"></p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($requisiciones as $requisicion){ $c++;
								if($requisicion->estatus_did == 6){?>
				<tr>
					<td style='text-align:center;'><?php echo $c;?></td>	
					<td style='text-align:center;'>						
					    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
					        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					        'buttons'=>array(						        
					            array('items'=>array(
					                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$requisicion->id)),
					                '---',
					                array('label'=>'Recuperar', 'icon'=>'inbox', 'url'=>array('cambiarestatus','id'=>$requisicion->id, 'estatus'=>1)),
					            )),
					        ),					        
					    )); ?>						
					</td>
					<td style='text-align:center;'><?php echo CHtml::link($requisicion->numeroRequisicion,array('requisicion/view', 'id'=>$requisicion->id));?></td>
					<td style='text-align:center;'><?php echo $requisicion->fecha_f;?></td>
					<td><?php echo $requisicion->unidadOrganizacional->nombre;?></td>
					<td><?php echo "<span class='label label-warning'>" . $requisicion->estatus->requisicion . "</span>";?></td>
				</tr>
				<?php } 
					}
				?>
			</tbody>
		</table>
		<div style="height:100px;"></div>
	</div>
</div>