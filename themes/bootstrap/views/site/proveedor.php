<?php
	$this->breadcrumbs=array(
		'Proveedor',
	);
	$proveedorActual = Proveedor::model()->obtenerProveedorActual();
	echo "<h3>Bienvenido " . $proveedorActual->nombre . "</h3><br/><br/>";



	$ordenesPendientes = OrdenCompra::model()->count('estatus_did = 1 && proveedor_aid = '.$proveedorId);
	$ordenesPagadas = OrdenCompra::model()->count('estatus_did = 3 && proveedor_aid = '.$proveedorId);
    $ordenesRecibidas= OrdenCompra::model()->count('estatus_did = 2 && proveedor_aid = '.$proveedorId);
    $ordenesCanceladas= OrdenCompra::model()->count('estatus_did = 4 && proveedor_aid = '.$proveedorId);
    
	$ordenes = '
		<div class="alert">
			<h2>Órdenes</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $ordenesPendientes .' Pendientes</li>
			<li class="plan-feature">' . $ordenesRecibidas . ' Recibidas</li>
			<li class="plan-feature">' . $ordenesPagadas . ' Pagadas</li>
			<li class="plan-feature">' . $ordenesCanceladas . ' Canceladas</li>
            
		</ul>
	';
	
    $requisicionesPendientes = ProveedoresPorRequisicion::model()->count('estatus_did = 2 && proveedor_aid = '.$proveedorId);
    $cotizacionesCotizadas = Cotizacion::model()->count('estatus_did = 3 && proveedor_aid = '.$proveedorId);
    $cotizacionesAceptadas = Cotizacion::model()->count('estatus_did = 4 && proveedor_aid = '.$proveedorId);
    
	$cotizacion = '
		<div class="alert alert-success">
			<h2>Cotizaciones</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $requisicionesPendientes . ' Pendientes</li>
			<li class="plan-feature">' . $cotizacionesCotizadas . ' Cotizadas</li>
            <li class="plan-feature">' . $cotizacionesAceptadas . ' Aceptadas</li>
            <li class="plan-feature"></li>
		</ul>
	';
?>
<?php /*
<div class="row">
	<div class="alert alert-info">
		<p class="text-success"><strong>Aviso Importante!</strong></p>
		<i class="icon-arrow-right"></i> Ahora podrás <strong>administrar</strong> tus <strong>archivos</strong> desde tu materia.
		<br/>
		<i class="icon-arrow-right"></i> También podrás <strong>imprimir</strong> tu planeación cuando esté liberada, revisada o en la plataforma.
	</div>
</div> */ ?>
<div class="row">
	<div class="span6">
		<div class="row-fluid pricing-table pricing-two-column">			
        	<div class="span12 plan">	
                <?php echo CHtml::link($cotizacion,array('proveedor/dashboard','proveedorId'=>$proveedorId)); ?>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="row-fluid pricing-table pricing-two-column">			
        	<div class="span12 plan">	
                <?php echo CHtml::link($ordenes,array('ordenCompra/dashboard','proveedorId'=>$proveedorId)); ?>
			</div>
		</div>
	</div>
</div>