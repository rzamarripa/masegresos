<?php
	$this->breadcrumbs=array(
		'Staff',
	);

	$requisicionPendiente = Requisicion::model()->count('estatus_did = 1');
	$requisicionEnviada = Requisicion::model()->count('estatus_did = 2');
	
	$requisicion = '
		<div class="alert">
			<h3>Requisición</h3>
		</div>
		<ul>
			<li class="plan-feature">' . $requisicionPendiente .' Pendientes</li>
			<li class="plan-feature">' . $requisicionEnviada . ' Enviadas</li>
		</ul>
	';
	
    $requisicionesPendientes = Requisicion::model()->count('estatus_did = 2');
    $cotizacionesAceptadas = Cotizacion::model()->count('estatus_did = 4');
    
	$cotizacion = '
		<div class="alert alert-success">
			<h3>Cotización</h3>
		</div>
		<ul>
			<li class="plan-feature">' . $requisicionesPendientes . ' Pendientes</li>
			<li class="plan-feature">' . $cotizacionesAceptadas . ' Aceptadas</li>
		</ul>
	';
	
    $ordenesPendientesSum = Yii::app()->db->createCommand('SELECT format(SUM(total),2) as total FROM OrdenCompra WHERE estatus_did = 1 || estatus_did = 3;')->queryRow();

    $ordenesPagadasSum = Yii::app()->db->createCommand('SELECT format(SUM(total),2) as total FROM OrdenCompra WHERE estatus_did = 2;')->queryRow();
  
    
	$orden = '
		<div class="alert alert-info">
			<h3 class="text-center">Órdenes</h3>
		</div>
		<ul>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($ordenesPendientesSum["total"]) . ' Pendientes</li>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($ordenesPagadasSum["total"]) . ' Pagadas</li>
		</ul>
	';
	
	$contrareciboPendientesSum = Yii::app()->db->createCommand('SELECT format(SUM(totalFactura),2) as total FROM DetalleContrarecibo WHERE estatus_did = 1;')->queryRow();
    $contrareciboPagadasSum = Yii::app()->db->createCommand('SELECT format(SUM(totalFactura),2) as total FROM DetalleContrarecibo WHERE estatus_did = 2;')->queryRow();
    
	$contrarecibo = '
		<div class="alert alert-error">
			<h3>Contrarecibo</h3>
		</div>
		<ul>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($contrareciboPendientesSum["total"]) . ' Pendientes</li>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($contrareciboPagadasSum["total"]) . ' Pagadas</li>
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
				<?php echo CHtml::link($orden,array('ordenCompra/index')); ?>
			</div>
			<div class="span3 plan">
				<?php echo CHtml::link($contrarecibo,array('contrarecibo/index')); ?>
			</div>
		</div>
	</div>
</div>