<?php $c=0;
	$ordenCompra = OrdenCompra::model()->find("requisicion_did = " . $model->id);
	if($model->enpaquete == 1){
		$detallePaquete = PaqueteRequisicionesDetalle::model()->find("requisicion_did = " . $model->id);
	}	
?>
<div class="row">
	<div class="span12 text-center">
		<?php if($model->enpaquete == 1){ ?>
			<h2><?php echo $model->numeroRequisicion . " - " . $detallePaquete->estatus->paquetereqdetalle; ?></h2>
		<?php }else{ ?>
			<h2><?php echo $model->numeroRequisicion . " - No está en paquete"; ?></h2>
		<?php } ?>
		
	</div>
</div>
<div class="row">
	<div class="span12 text-right"><?php
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
					        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					        'buttons'=>array(
					            array('label'=>'Acciones Req.','items'=>array(
					            	array('label'=>'Cotizar', 'icon'=>'file', 'url'=>array('formcotproves','id'=>$model->id)),
					            	array('label'=>'Imprimir', 'icon'=>'print', 'url'=>array('imprimir','id'=>$model->id),'linkOptions'=>array('target'=>'_blank')),
					            	array('label'=>'Actualizar', 'icon'=>'pencil', 'url'=>array('update','id'=>$model->id)),
					            	'---',
					                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$model->id)),
					                '--',
					                array('label'=>'Eliminar', 'icon'=>'trash', 'url'=>array('cambiarestatus','id'=>$model->id, 'estatus'=>6)),

					            )),
					        ),
					        'htmlOptions'=>array("class"=>"text-left"),
					    ));?>
	</div>
</div>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Unidad Org:</strong></td>
					<td class="span5"><?php echo $model->unidadOrganizacional->nombre; ?></td>
				</tr>
				<tr>
					<td class="span2"><strong>Estatus:</strong></td>
					<td class="span5"><?php
							if($model->estatus_did == 4)
								echo $model->estatus->requisicion . " - " . $ordenCompra->estatusAlmacen->ordenCompraAlmacen;
							else
								echo $model->estatus->requisicion;
							?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="span5">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Requisición</strong></td>
					<td class="span2"><?php echo $model->numeroRequisicion; ?></td>
				</tr>
				<tr>
					<td><strong>Fecha</strong></td>
					<td><?php echo date("d-m-Y", strtotime($model->fecha_f)); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php if(count($detalleRequisicion)>0){ ?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td>No.</td>
					<td>Cantidad</td>
					<td>Artículo</td>
					<td>Observaciones</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleRequisicion as $detalle){ $c++;?>
				<tr>
					<td><?php echo $c;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->articulo->nombre;?></td>
					<td><?php echo $detalle->observaciones;?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<table class="table table-bordered table-condensed">
			<tr>
				<td class="span2"><strong>Comentario</strong></td>
				<td><?php echo $model->comentarios; ?></td>
			</tr>
		</table>
	</div>
</div>
<?php }else{ echo "Esta requisición no tiene detalle"; }?>
<hr>
<?php  $cotizaciones = Cotizacion::model()->findAll("requisicion_did = " . $model->id);
		if(isset($cotizaciones) && count($cotizaciones)>0){ ?>
			<h2>Cotización</h2>
			<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td>No.</td>
					<td>Número</td>
					<td>Proveedor</td>
					<td>Creación</td>
					<td>Envío</td>
					<td>Cotización</td>
					<td>Estatus</td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizaciones as $cotizacion){ $c= 1;
					$provCotizacion = ProveedoresPorRequisicion::model()->find("requisicion_aid = :r && proveedor_aid = :p",array(":r"=>$model->id, ":p"=>$cotizacion->proveedor_aid));
				?>
				<tr>
					<td><?php echo $c; ?></td>
					<td><?php echo $cotizacion->numeroCotizacion;?></td>
					<td><?php echo $cotizacion->proveedor->nombre;?></td>
					<td><?php echo date("d-m-Y", strtotime($cotizacion->fechaCreacion_f));?></td>
					<td><?php echo ($provCotizacion->fechaEnvio_ft != "0000-00-00 00:00:00") ?
																							date("d-m-Y H:i:s", strtotime($provCotizacion->fechaEnvio_ft)) : "No hay fecha";?></td>
					<td><?php echo ($provCotizacion->fechaCotizacion_ft != "0000-00-00 00:00:00") ?
																							date("d-m-Y H:i:s", strtotime($provCotizacion->fechaCotizacion_ft)) : "No hay fecha";?></td>
					<td><?php echo $cotizacion->estatus->cotizacion;?></td>
					<td><?php
							$cotizacionesRealizadas = ProveedoresPorRequisicion::model()->count('requisicion_aid = :r && estatus_did = 3',
								array(':r'=> $model->id));
							//echo $cotizacionesRealizadas . " - " . $requisicion->id . " - " . $requisicion->numeroRequisicion;
							if($cotizacionesRealizadas >= 1)
								echo CHtml::link("Ver las cotizaciones",array('cotizacion/cotporreq','id'=>$model->id));
							else
								 echo '<span class="label label-success">Cotizadas ' .  $cotizacionesRealizadas . '</span>';
						?></td>
					<td><?php
						if($cotizacion->estatus_did != 6){
							$this->widget('bootstrap.widgets.TbButtonGroup', array(
						        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
						        'size'=>'mini',
						        'buttons'=>array(
						            array('label'=>'Acciones','items'=>array(

						            	array('label'=>'Imprimir', 'icon'=>'print', 'url'=>array('cotizacion/imprimir','id'=>$cotizacion->id),'linkOptions'=>array('target'=>'_blank')),
						            	'---',
						            	array('label'=>'Cancelar', 'icon'=>'file', 'url'=>array('cotizacion/cancelarcotizacion','id'=>$cotizacion->id)),

						            )),
						        ),
						        'htmlOptions'=>array("class"=>"text-left"),
						    ));
						}else{
							$this->widget('bootstrap.widgets.TbButton', array(
							    'label'=>'Imprimir',
							    'type'=>'info',
							    'icon'=>'print white',
							    'size'=>'mini',
							    'url'=>array("cotizacion/imprimir", 'id'=>$cotizacion->id),
							    'htmlOptions'=>array("target"=>"_blank")
							));
						}
						?>
					</td>
				</tr>
				<?php $c++; } ?>
			</tbody>
		</table>
<?php	}else{ ?>
		<h2>No se ha cotizado</h2>
<?php	} ?>
<hr>
<?php $ordenCompra = OrdenCompra::model()->find("requisicion_did = " . $model->id);
	if(isset($ordenCompra) && !empty($ordenCompra)){ ?>
		<div class="row">
			<div class="span12">
				<h2>Orden de Compra</h2>
			</div>
		</div>
	<?php }
?>
<div class="row">
	<div class="span12 text-right">
		<?php
		if(isset($ordenCompra) && !empty($ordenCompra)){
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
	        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	        'buttons'=>array(
	            array('label'=>'Acciones OC','items'=>array(
	            	array('label'=>'Imprimir', 'icon'=>'print', 'url'=>array('ordencompra/imprimir','id'=>$ordenCompra->id),'linkOptions'=>array('target'=>'_blank')),
	                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('ordencompra/view','id'=>$ordenCompra->id)),
	                '--',
	                array('label'=>'Cancelar', 'icon'=>'trash', 'url'=>array('ordencompra/cancelar','id'=>$ordenCompra->id)),

	            )),
	        ),
	        'htmlOptions'=>array("class"=>"text-left"),
	    ));}?>
	</div>
</div>
<?php
		if(isset($ordenCompra) && !empty($ordenCompra)){ ?>

			<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td>No.</td>
					<td>Número</td>
					<td>Proveedor</td>
					<td>Unidad Organizacional</td>
					<td>Fecha de Creación</td>
					<td>Estatus</td>
					<td>Estatus Almacén</td>
					<td>Fecha de Recepción</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td><?php echo $ordenCompra->numeroOrdenCompra;?></td>
					<td><?php echo $ordenCompra->proveedor->nombre;?></td>
					<td><?php echo $ordenCompra->unidadOrganizacional->nombre;?></td>
					<td><?php echo date("d-m-Y", strtotime($ordenCompra->fecha_f));?></td>
					<td><?php echo $ordenCompra->estatus->ordenCompra;?></td>
					<td><?php echo $ordenCompra->estatusAlmacen->ordenCompraAlmacen;?></td>
					<td><?php echo date("d-m-Y", strtotime($ordenCompra->fechaRecepcion_f));?></td>
				</tr>
			</tbody>
		</table>
<?php	}else{ ?>
		<h2>No hay orden de compra</h2>
<?php	} ?>