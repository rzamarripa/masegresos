<?php
	$this->pageCaption='Mercancia';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='en Almacén';
	$c = 0;
?>
<table id="table" class="table table-striped table-bordered">
	<caption><h4>Órdenes de Compra Recibidas</h4></caption>
	<thead class="thead">
		<tr>
			<th>No.</th>
			<th>Requisición</th>
			<th>Cotización</th>
			<th>Orden Compra</th>
			<th>Proveedor</th>
			<th>Unidad Organizacional</th>
			<th>Fecha Recepción</th>
			<th>Tiempo en Almacén</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($ordenes as $orden){ $c++; ?>
		<tr>
			<td><?php echo $c;?></td>
			<td><?php echo CHtml::link($orden->requisicion->numeroRequisicion,array("requisicion/view",'id'=>$orden->requisicion_did));?></td>
			<td><?php echo CHtml::link($orden->cotizacion->numeroCotizacion,array("cotizacion/view",'id'=>$orden->cotizacion_did));?></td>
			<td><?php echo CHtml::link($orden->numeroOrdenCompra,array("ordenCompra/view",'id'=>$orden->id));?></td>
			<td><?php echo $orden->proveedor->nombre;?></td>
			<td><?php echo $orden->unidadOrganizacional->nombre;?></td>
			<td><?php echo $orden->fechaRecepcion_f;?></td>
			<td><?php
				$fechaRecepcion = new DateTime($orden->fechaRecepcion_f);
				$fechaActual = new DateTime(date("Y-m-d"));
				$diferencia = $fechaRecepcion->diff($fechaActual);
				echo $diferencia->days . " días"; ?></td>

		</tr>
		<?php } ?>
	</tbody>
</table>