<?php
    $this->breadcrumbs=array(
		'Pasivos',
	);

    $ordenesPendientesSum = Yii::app()->db->createCommand('SELECT format(SUM(total),2) as total FROM OrdenCompra WHERE estatus_did = 1;')->queryRow();
    
	$orden = '
		<div class="alert alert-info">
			<h2>Órdenes</h2>
		</div>
		<ul>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($ordenesPendientesSum["total"]) . ' Pendientes</li>
			<li class="plan-feature">&nbsp;</li>
		</ul>
	';
    
    $contrarecibosPendientesSum = Yii::app()->db->createCommand('SELECT format(SUM(totalFactura),2) as total FROM DetalleContrarecibo WHERE estatus_did = 1;')->queryRow();
    $contrarecibosPagadasSum = Yii::app()->db->createCommand('SELECT format(SUM(totalFactura),2) as total FROM DetalleContrarecibo WHERE estatus_did = 2;')->queryRow();
    
	$contrarecibos = '
		<div class="alert alert-danger">
			<h2>Pasivos</h2>
		</div>
		<ul>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($contrarecibosPendientesSum["total"]) . ' Pendientes</li>
			<li class="plan-feature">' . Cotizacion::model()->formatCurrency($contrarecibosPagadasSum["total"]) . ' Pagadas</li>
		</ul>
	';
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">			
	        <div class="span6 plan">
				<?php echo CHtml::link($orden,array('ordenCompra/index')); ?>
			</div>
            <div class="span6 plan">
				<?php echo CHtml::link($contrarecibos,array('contrarecibo/index')); ?>
			</div>
		</div>
	</div>
</div>