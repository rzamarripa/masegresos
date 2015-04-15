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
				<?php foreach($ordenes as $orden){ $c++;
								if($orden->estatus_did == 2){										
								?>
				<tr>
					<td style='text-align:center;'><?php echo $c;?></td>	
					<td>
						    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'requisicion'.$orden->id)); 	?>
	
							<div class="modal-header">
							    <a class="close" data-dismiss="modal">&times;</a>
							    <h4 class="lead">Enviar requisición de <strong><?php echo $orden->unidadOrganizacional->nombre; ?></strong>?</h4>
							</div>
						 
							<div class="modal-body">
								<p class="text-center"><strong>Seleccione a los proveedores</strong></p>
								<?php
								$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
								    'id'=>'horizontalForm',
								    'type'=>'horizontal',
								)); 
								echo $form->hiddenField($orden,'id',array('value'=>$orden->id)); 
								$proveedoresListos = array();
								
								foreach($proveedores as $proveedor)
								{
								 	$proveedoresListos[]= trim($proveedor->id) . '-' . trim($proveedor->nombre);
								}
								
								for($i=0; $i<=2; $i++){ ?>
									<div class="control-group">
										<?php echo CHtml::label('Proveedor #'.$i,'Proveedores[proveedor'.$orden->id . $i.']',array('class'=>'control-label')); ?>
										<div class="controls">
											<div class="input-prepend"><?php
												$this->widget('bootstrap.widgets.TbTypeahead', array(
												    'name'=>'Proveedores[proveedor'.$orden->id . $i.']',
												    'options'=>array(
												        'source'=>$proveedoresListos,
												        'items'=>4,
												    ),
												)); ?>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						 
							<div class="modal-footer">
							    <?php $this->widget('bootstrap.widgets.TbButton', array(
							        'type'=>'info',
							        'label'=>'Aceptar',
							        'url'=>'#',
									'buttonType'=>'submit',
							    )); ?>
							    <?php $this->widget('bootstrap.widgets.TbButton', array(
							        'label'=>'Cerrar',
							        'url'=>'#',
							        'htmlOptions'=>array('data-dismiss'=>'modal'),
							    )); ?>
							</div>
						 <?php $this->endWidget(); 
						  $this->endWidget();	
						    
						    $this->widget('bootstrap.widgets.TbButtonGroup', array(
						        'type'=>'info', // '', 'primary', 'info', 'success', 'info', 'danger' or 'inverse'
						        'buttons'=>array(						        
						            array('items'=>array(
						                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$orden->id)),						                
						            )),
						        ),
						    )); ?>
					</td>
					<td style='text-align:center;'><?php echo CHtml::link($orden->numeroRequisicion,array('requisicion/view', 'id'=>$orden->id));?></td>
                    <td style='text-align:center;'><?php echo $orden->fecha_f;?></td>
					<td><?php echo $orden->unidadOrganizacional->nombre;?></td>
					<td>
						<div class="row-fluid">
							<div class="span6">
								<p class="text-center">
									<?php
										$proveedoresPorRequisicion = ProveedoresPorRequisicion::model()->count('estatus_did = 2 && requisicion_aid = ' . $orden->id);
									?>
									<span class="label label-info">Pendientes <?php echo $proveedoresPorRequisicion; ?></span>
								</p>
							</div>
							<div class="span6">
								<p class="text-center">
									<?php
										$cotizacionesRealizadas = ProveedoresPorRequisicion::model()->count('requisicion_aid = :r && estatus_did = 3', 
											array(':r'=> $orden->id));
										if($cotizacionesRealizadas >= 1 )
											echo CHtml::link('<span class="label label-success">Cotizadas ' .  $cotizacionesRealizadas . 
												'</span>',array('cotizacion/cotporreq','id'=>$orden->id));
										else
											 echo '<span class="label label-success">Cotizadas ' .  $cotizacionesRealizadas . '</span>'
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
							    'htmlOptions'=>array(
							        'data-toggle'=>'modal',
							        'data-target'=>'#requisicion' . $orden->id,
							    ),
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