<?php
	$r = 0;
	$requisiciones = Requisicion::model()->findAll("proyecto_aid = " . $_GET["id"]);
?>
<table class="table table-striped table-bordered table-condensed">
	<thead class="thead">
		<tr>
			<td class="span1">No.</td>
			<td class="span2">Fecha</td>
			<td class="span2">No. Req.</td>
			<td class="span2">Estatus</td>
			<td class="span2">Acción</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($requisiciones as $requisicion){ $r++; ?>
		<tr>
			<td><?php echo $r;?></td>	
			<td><?php echo $requisicion->fecha_f;?></td>	
			<td><?php echo CHtml::link($requisicion->numeroRequisicion,array('requisicion/view','id'=>$requisicion->id, 'p' => $requisicion->proyecto_aid)); ?></td>
			<td><?php echo $requisicion->estatus->requisicion;?></td>	
			<td>
			    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'requisicion'.$requisicion->id)); 	?>

				<div class="modal-header">
				    <a class="close" data-dismiss="modal">&times;</a>
				    <h4 class="lead">Enviar requisición de <strong><?php echo $requisicion->unidadOrganizacional->nombre; ?></strong>?</h4>
				</div>
			 
				<div class="modal-body" style="height:300px;">
					<p class="text-center"><strong>Seleccione a los proveedores</strong></p>
					<?php
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					    'id'=>'horizontalForm',
					    'type'=>'horizontal',
					)); 
					echo $form->hiddenField($requisicion,'id',array('value'=>$requisicion->id)); 
					foreach($proveedores as $proveedor)
					 	$proveedoresListos[]= trim($proveedor->id) . '-' . trim($proveedor->nombre);			
					for($i=0; $i<=2; $i++){ ?>
						<div class="control-group">
							<?php echo CHtml::label('Proveedor #'.$i,'Proveedores[proveedor'.$requisicion->id . $i.']',array('class'=>'control-label')); ?>
							<div class="controls">
								<div class="input-prepend"><?php
									$this->widget('bootstrap.widgets.TbTypeahead', array(
									    'name'=>'Proveedores[proveedor'.$requisicion->id . $i.']',
									    'options'=>array(
									        'source'=>$proveedoresListos,
									        'items'=>4,
									    ),
									)); ?>
								</div>
							</div>
						</div>
					<?php } $proveedoresListos = null;?>
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
			  if($requisicion->estatus_did == 1){
			 ?>
			    <p class="text-center">
					<?php $this->widget('bootstrap.widgets.TbButton', array(
					    'label'=>'Cotizar',
					    'type'=>'info',
					    'icon'=>'file white',
					    'size'=>'mini',
					    'htmlOptions'=>array(
					        'data-toggle'=>'modal',
					        'data-target'=>'#requisicion' . $requisicion->id,
					    ),
					)); 
			} else if($requisicion->estatus_did == 2){ ?>
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
			<?php
			} else if($requisicion->estatus_did == 3){ 
					$proveedoresPorRequisicionCotizada = ProveedoresPorRequisicion::model()->count('requisicion_aid = ' . $requisicion->id);
			?>
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
								if($cotizacionesRealizadas >= 1 && $cotizacionesRealizadas != $proveedoresPorRequisicionCotizada)
									echo CHtml::link('<span class="label label-success">Cotizadas ' .  $cotizacionesRealizadas . '</span>',array('cotizacion/cotporreq','id'=>$requisicion->id));
								else if($cotizacionesRealizadas == $proveedoresPorRequisicionCotizada)
									echo CHtml::link('<span class="label label-success">Todos cotizaron (' .  $cotizacionesRealizadas . ')</span>',array('cotizacion/cotporreq','id'=>$requisicion->id, 'p' => $requisicion->proyecto_aid));
								else
									 echo '<span class="label label-success">No han cotizado ' .  $cotizacionesRealizadas . '</span>';
							?>
						</p>
					</div>
				</div>
			<?php
			} 
			?>
				</p>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>