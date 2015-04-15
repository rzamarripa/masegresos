<?php
	$this->breadcrumbs=array(
		'Asistente',
	);

	$ordenCompraPendiente = OrdenCompra::model()->count('estatus_did = 1');
	$ordenCompraAgendada = OrdenCompra::model()->count('estatus_did = 3');
	
	$ordenCompra = '
		<div class="alert alert-warning">
			<h2>Orden Compra</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $ordenCompraPendiente .' Pendientes</li>
			<li class="plan-feature">' . $ordenCompraAgendada . ' Enviadas</li>
		</ul>
	';
	
	$cotizacionEnviada = Requisicion::model()->count('estatus_did = 3');
	
	$cotizacion = '
		<div class="alert alert-info">
			<h2>Cotización</h2>
		</div>
		<ul>
			<li class="plan-feature">0 Pendientes</li>
			<li class="plan-feature">' . $cotizacionEnviada . ' Enviadas</li>
		</ul>
	';
    
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">			
        	<div class="span6 plan">				
				<?php echo CHtml::link($cotizacion,array('requisicion/requisicionesenviadas')); ?>
			</div>
			<div class="span6 plan">				
				<?php echo CHtml::link($ordenCompra,array('ordenCompra/admin')); ?>
			</div>
		</div>
	</div>
</div>