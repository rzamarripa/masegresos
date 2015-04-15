<?php
    $this->pageCaption='Requisiciones';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Seguimiento';
    
        $this->breadcrumbs=array(
	        'Requisiciones'=>array('index'),
            'Seguimiento'
        );
    
	$usuarioActual = Usuario::model()->obtenerUsuarioActual();
	if($usuarioActual->tipoUsuario->nombre == 'Director' || $usuarioActual->tipoUsuario->nombre == 'Asistente1' || $usuarioActual->tipoUsuario->nombre == 'Asistente2')
	{
		$this->menu=array(
		    array('label'=>'Volver','url'=>array('index')),			    
    );
	}
	

    $c=0;

?>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Unidad Org:</strong></td>
					<td class="span5"><?php echo $model->unidadOrganizacional->codigo . " - " . $model->unidadOrganizacional->nombre; ?></td>
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
<?php $cotizaciones = Cotizacion::model()->findAll("requisicion_did = " . $model->id); 
		if(isset($cotizaciones) && count($cotizaciones)>0){ ?>
			<h2>Cotización</h2>
			<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td>No.</td>
					<td>Número</td>
					<td>Proveedor</td>
					<td>Unidad Organizacional</td>
					<td>Fecha de Creación</td>
					<td>Estatus</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($cotizaciones as $cotizacion){ $c= 1; ?>
				<tr>
					<td><?php echo $c; ?></td>	
					<td><?php echo $cotizacion->numeroCotizacion;?></td>	
					<td><?php echo $cotizacion->proveedor->nombre;?></td>	
					<td><?php echo $cotizacion->requisicion->unidadOrganizacional->nombre;?></td>	
					<td><?php echo date("d-m-Y", strtotime($cotizacion->fechaCreacion_f));?></td>
					<td><?php echo $cotizacion->estatus->cotizacion;?></td>				
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
			<h2>Orden de Compra</h2>
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