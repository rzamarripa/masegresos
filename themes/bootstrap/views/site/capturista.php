<?php 
	$this->breadcrumbs=array(
		'Capturista',
	);

	$requisicionPendiente = Requisicion::model()->count('estatus_did = 1 && proyecto_aid = 1');
	$requisicionEnviada = Requisicion::model()->count('estatus_did = 2 && proyecto_aid = 1');
	
	$requisicion = '
		<div class="alert">
			<h4>Requisición</h4>
		</div>
		<ul>
			<li class="plan-feature">' . $requisicionPendiente .' Pendientes</li>
			<li class="plan-feature">' . $requisicionEnviada . ' Enviadas</li>
		</ul>
	';
    
    $cotizacionesPendientes = Requisicion::model()->count('estatus_did = 2');
    $cotizacionesAceptadas = Cotizacion::model()->count('estatus_did = 4');
    
	$cotizacion = '
		<div class="alert alert-success">
			<h4>Cotización</h4>
		</div>
		<ul>
			<li class="plan-feature">' . $cotizacionesPendientes . ' Pendientes</li>
			<li class="plan-feature">' . $cotizacionesAceptadas . ' Aceptadas</li>
		</ul>
	';
    
    $articulosTotales = Articulo::model()->count();
    $articulosUsados = Yii::app()->db->createCommand('SELECT COUNT(DISTINCT articulo_aid) usados
                                                    FROM DetalleRequisicion;')->queryRow();
    
    $articulos = '
       <div class="alert alert-error">
			<h4>Artículos</h4>
		</div>
		<ul>
			<li class="plan-feature">' . $articulosTotales . ' Totales</li>
			<li class="plan-feature">' . $articulosUsados['usados'] . ' Usados</li>
		</ul>
    ';
    
    $proveedoresTotales = Proveedor::model()->count();
    $proveedoresUsados = Yii::app()->db->createCommand('SELECT COUNT(DISTINCT proveedor_aid) usados
                                                    FROM ProveedoresPorRequisicion;')->queryRow();
    
    $proveedores = '
       <div class="alert alert-info">
			<h4>Proveedores</h4>
		</div>
		<ul>
			<li class="plan-feature">' . $proveedoresTotales .' Totales</li>
			<li class="plan-feature">' . $proveedoresUsados['usados'] . ' Usados</li>
		</ul>
    ';
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">			
        	<div class="span3 plan">				
				<?php echo CHtml::link($requisicion,array('requisicion/index')); ?>
			</div>
            <div class="span3 plan">
				<?php echo CHtml::link($cotizacion,array('cotizacion/index')); ?>
			</div>
             <div class="span3 plan">
				<?php echo CHtml::link($articulos,array('articulo/index')); ?>
			</div>
	        <div class="span3 plan">
				<?php echo CHtml::link($proveedores,array('proveedor/index')); ?>
			</div>
        </div>
    </div>
</div>