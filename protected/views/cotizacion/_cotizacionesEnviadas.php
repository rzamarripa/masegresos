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
					<td class="span2"></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizaciones as $cotizacion){ $c++;
								if($cotizacion->estatus_did == 2){?>
				<tr>
					<td><?php echo $c;?></td>	
					<td>
					    <?php
							$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'cotizacion'.$cotizacion->id)); 	?>
		
							<div class="modal-header">
							    <a class="close" data-dismiss="modal">&times;</a>
							    <h4 class="lead">Enviar cotización de <?php echo $cotizacion->fecha_f; ?>?</h4>
							</div>
						 
							<div class="modal-body">
								<p class="text-center"><strong>Seleccione a los proveedores</strong></p>
								<?php
								$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
								    'id'=>'horizontalForm',
								    'type'=>'horizontal',
								)); 
								
								echo $form->hiddenField($cotizacion,'id',array('value'=>$cotizacion->id)); 
								$proveedoresListos = array();
								$proveedores = Proveedor::model()->findAll('estatus_did = 1');
								foreach($proveedores as $proveedor)
								{
								 	$proveedoresListos[]= $proveedor->id . '-' . $proveedor->nombre;
								}
									
								for($i=0; $i<=2; $i++){ ?>
									<div class="control-group">
										<?php echo CHtml::label('Proveedor #'.$i,'Proveedores[proveedor'.$i.']',array('class'=>'control-label')); ?>
										<div class="controls">
											<div class="input-prepend"><?php
												$this->widget('bootstrap.widgets.TbTypeahead', array(
												    'name'=>'Proveedores[proveedor'.$i.']',
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
					<td><?php echo CHtml::link($cotizacion->requisicion->numeroRequisicion, array('requisicion/view','id'=>$cotizacion->requisicion_did)); ?></td>
					<td>
						<?php $this->widget('bootstrap.widgets.TbButton', array(
						    'label'=>'Cotizar',
						    'type'=>'info',
						    'icon'=>'file white',
						    'url'=>array("proveedor/cotizacionNueva", 'idCotizacion'=>$cotizacion->id)
						    
						)); ?>
					</td>
				</tr>
				<?php }
				} ?>
			</tbody>
		</table>
		<div style="height:100px;"></div>
	</div>
</div>