<?php
    $this->pageCaption='Cotización';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Ver";

    if(isset($_GET['origen'])=='proveedor'){
			  
		}else{
	    $this->breadcrumbs=array(
		    'Cotizaciones'=>array('index'),
	        'Ver'
	    );
    }
       
    $usuarioActual = Usuario::model()->obtenerUsuarioActual();
	if($usuarioActual->tipoUsuario->nombre == 'Asistente1' || $usuarioActual->tipoUsuario->nombre == 'Asistente2')
	{
		$this->menu=array(
	    	array('label'=>'Volver','url'=>array('cotizacion/cotporreq','id'=>$model->requisicion_did)),
	    	array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')), 
	    );
	} else if ($usuarioActual->tipoUsuario->nombre == 'Proveedor'){
		$this->menu=array(
	    	array('label'=>'Volver','url'=>array('proveedor/dashboard','proveedorId'=>$model->proveedor_aid)),		    
	    	array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')), 
	    	array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)), 
	    );
	} else if ($usuarioActual->tipoUsuario->nombre == 'Administrador'){
		$this->menu=array(
	    	array('label'=>'Volver','url'=>array('proyecto/view','id'=>$_GET["p"])),		    
	    );
	} else if ($usuarioActual->tipoUsuario->nombre == 'OrdenCompra'){
		$this->menu=array(
	    	array('label'=>'Volver','url'=>array('proveedor/dashboard','proveedorId'=>$model->proveedor_aid)),		    
	    	array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')), 	    	
	    );
	}
	
    $c=0;
    $p=0;
?>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span2"><strong>Proveedor</strong></td>
					<td class="span5"><?php echo $model->proveedor->nombre; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php echo $model->proveedor->direccion; ?></td>
				</tr>
				<tr>
					<td><strong>Unidad Organizacional</strong></td>
					<td><?php echo $model->requisicion->unidadOrganizacional->nombre; ?></td>
				</tr>				
			</tbody>
		</table>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span1"><strong>No.</strong></td>
					<td class="span1"><?php echo $model->numeroCotizacion; ?></td>
					<td class="span1"><strong>Entrega</strong></td>
					<td class="span1"><?php echo $model->fechaEntrega_f; ?></td>
				</tr>
				<tr>
					<td colspan="2"><strong>Fecha creación</strong></td>
					<td colspan="2"><?php echo $model->fecha_f; ?></td>
				</tr>				
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span11">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>					
					<td class="span2"><p class="text-center ">Cantidad</p></td>
					<td>Artículo</td>
					<td>Unidad</td>
					<td class="span2"><p class="text-center ">Precio Unitario</p></td>
					<td class="span2"><p class="text-center ">Importe</p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleCotizacion as $detalle){ $c++;?>
				<tr>					
					<td><p class="text-center"><?php echo $detalle->cantidad;?></p></td>
					<td><?php echo $detalle->articulo->nombre;?></td>
					<td><?php echo $detalle->articulo->unidad;?></td>
					<td style="text-align:right"><?php echo number_format($detalle->precioUnitario,2);?></td>
					<td style="text-align:right"><?php echo number_format($detalle->importe,2);?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span7"><strong>Cantidad con letra</strong><br><?php $this->widget('ext.numaletras.numerosALetras', array('valor'=>$model->total)); ?></td>
				</tr>
			</tbody>
		</table>
		<div class="text-center">
			<u><strong><?php echo $model->requisicion->director; ?></strong></u>
			<p class="small">DIRECTOR DE CONTROL DE BIENES E INVENTARIOS</p>
		</div>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td class="span1"><strong>Subtotal</strong></td>
					<td style="text-align:right" class="span2"><?php echo number_format($model->subtotal,2); ?></td>
				</tr>
				<tr>
					<td class="span1"><strong>IVA</strong></td>
					<td style="text-align:right" class="span2"><?php echo number_format($model->iva,2); ?></td>
				</tr>
				<tr>
					<td class="span1"><strong>Total</strong></td>
					<td style="text-align:right" class="span2"><?php echo number_format($model->total,2); ?></td>	
				</tr>
			</tbody>
		</table>
	</div>
</div>