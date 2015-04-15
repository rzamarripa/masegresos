<?php
	$usuarioActual = Usuario::model()->obtenerUsuarioActual();
    $this->breadcrumbs=array(
		'Almacenista',
	);

  $ordenesPendientesSurtir = Yii::app()->db->createCommand('SELECT count(id) as cantidad FROM OrdenCompra WHERE estatusAlmacen_did = 1;')->queryRow();
    
	$orden = '
		<div class="alert alert-info">
			<h2>Órdenes</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $ordenesPendientesSurtir["cantidad"] . ' Pendientes</li>
			<li class="plan-feature">&nbsp;</li>
		</ul>
	';
    
    $bitacorasEntradaSum = Yii::app()->db->createCommand('SELECT count(id) as cantidad FROM BitacoraAlmacenes WHERE estatus_did = 1;')->queryRow();
    $bitacorasSalidaSum = Yii::app()->db->createCommand('SELECT count(id) as cantidad FROM BitacoraAlmacenes WHERE estatus_did = 2;')->queryRow();
    
	$bitacroas = '
		<div class="alert alert-success">
			<h2>Movimientos</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $bitacorasEntradaSum["cantidad"] . ' Entradas</li>
			<li class="plan-feature">' . $bitacorasSalidaSum["cantidad"] . ' Salidas</li>
		</ul>
	';
	
	$paquetesPendientes = Yii::app()->db->createCommand('SELECT count(id) as cantidad FROM paqueterequisiciones WHERE estatus_did = 2;')->queryRow();
	$paquetesRegresados = Yii::app()->db->createCommand('SELECT count(id) as cantidad FROM paqueterequisiciones WHERE estatus_did = 3;')->queryRow();
    
	$paquetes = '
		<div class="alert alert-warning">
			<h2>Paquetes</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $paquetesPendientes["cantidad"] . ' Pendientes</li>
			<li class="plan-feature">' . $paquetesRegresados["cantidad"] . ' Regresados</li>
		</ul>
	';
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">			
	        <div class="span4 plan">
				<?php echo CHtml::link($orden,array('ordenCompra/adminalmacen', 'alm' => $usuarioActual->almacen_aid)); ?>
			</div>
      <div class="span4 plan">
				<?php echo CHtml::link($bitacroas,array('bitacoraAlmacenes/admin')); ?>
			</div>
			<div class="span4 plan">
				<?php echo CHtml::link($paquetes,array('paqueterequisiciones/admin')); ?>
			</div>
		</div>
	</div>
</div>