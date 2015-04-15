<?php $c = 0; ?>
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
					<td class="span3"><p class="text-center">Proveedores</p></td>
					<td class="span2"><p class="text-center"></p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($requisiciones as $requisicion){ $c++;
								if($requisicion->estatus_did == 2 || $requisicion->estatus_did == 3){
										$cotizacion = Cotizacion::model()->find('requisicion_did = ' . $requisicion->id);
								?>
				<tr>
					<td style='text-align:center;'><?php echo $c;?></td>	
					<td>
					    <?php
					    $this->widget('bootstrap.widgets.TbButtonGroup', array(
					        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					        'buttons'=>array(
					            array('items'=>array(
					                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$requisicion->id)),
					                array('label'=>'Actualizar', 'icon'=>'pencil', 'url'=>array('update','id'=>$requisicion->id)),
					                '---',
					                array('label'=>'Eliminar', 'icon'=>'trash', 'url'=>array('cambiarestatus','id'=>$requisicion->id, 'estatus'=>6)),
					            )),
					        ),
					    )); ?>
					</td>
					<td style='text-align:center;'><?php echo CHtml::link($requisicion->numeroRequisicion,array('requisicion/view', 'id'=>$requisicion->id));?></td>
                    <td style='text-align:center;'><?php echo $requisicion->fecha_f;?></td>
					<td><?php echo $requisicion->unidadOrganizacional->nombre;?></td>
					<td>
						<div class="row-fluid">
							<div class="span6">
								<p class="text-center">
									<?php
										$proveedoresPorRequisicion = ProveedoresPorRequisicion::model()->count('estatus_did = 2 && requisicion_aid = ' . $requisicion->id);
									?>
									<span class="label label-info">Pendientes <?php echo $proveedoresPorRequisicion; ?></span>
								</p>
							</div>
							<div class="span6">
								<p class="text-center">
									<?php
										$cotizacionesRealizadas = ProveedoresPorRequisicion::model()->count('requisicion_aid = :r && estatus_did = 3', 
											array(':r'=> $requisicion->id));
										if($cotizacionesRealizadas >= 1 )
											echo CHtml::link('<span class="label label-success">Cotizadas ' .  $cotizacionesRealizadas . 
												'</span>',array('cotizacion/cotporreq','id'=>$requisicion->id));
										else
											 echo '<span class="label label-success">Cotizadas ' .  $cotizacionesRealizadas . '</span>';
									?>
								</p>
							</div>
						</div>
					</td>
					<td>
						<p class="text-center">
							<?php $this->widget('bootstrap.widgets.TbButton', array(
						    'label'=>'Cotizar',
						    'type'=>'info',
						    'icon'=>'file white',
						    'size'=>'mini',
						    'url'=>array("requisicion/formcotproves", 'id'=>$requisicion->id),
						)); ?>
						</p>								
					</td>					
				</tr>
				<?php } 
					}
				?>
			</tbody>
		</table>
		<div style="height:100px;"></div>
	</div>
</div>