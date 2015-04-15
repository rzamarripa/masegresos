<?php
	$this->breadcrumbs=array(
		'Asistente',
	);

	$requisicionPendiente = Requisicion::model()->count('estatus_did = 1');
	$requisicionEnviada = Requisicion::model()->count('estatus_did = 2');
	
	$requisicion = '
		<div class="alert alert-success">
			<h2>Requisición</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $requisicionPendiente .' Pendientes</li>
			<li class="plan-feature">' . $requisicionEnviada . ' Enviadas</li>
		</ul>
	';

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
	
	$cotizacionPendiente = Cotizacion::model()->count('estatus_did = 1');
	$cotizacionEnviada = Cotizacion::model()->count('estatus_did = 3');
	
	$cotizacion = '
		<div class="alert alert-info">
			<h2>Cotización</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $cotizacionPendiente .' Pendientes</li>
			<li class="plan-feature">' . $cotizacionEnviada . ' Enviadas</li>
		</ul>
	';
    
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">			
        	<div class="span4 plan">				
				<?php echo CHtml::link($requisicion,array('requisicion/index')); ?>
			</div>
      		<div class="span4 plan">				
				<?php echo CHtml::link($cotizacion,array('cotizacion/index')); ?>
			</div>
			<div class="span4 plan">				
				<?php echo CHtml::link($ordenCompra,array('ordenCompra/admin')); ?>
			</div>
		</div>
	</div>
</div>