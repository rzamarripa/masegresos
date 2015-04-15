<div class="row">
	<div class="span12">
		<table style="text-align:center;">
			<tr>
				<td class="span3" style="text-align:right;">
					<img src="<?php echo Yii::app()->baseUrl;?>/images/uaslogo.jpg" alt="logoUas" width="150" height="150">
				</td>
				<td class="span8">
					<h3>UNIVERSIDAD AUTÓNOMA DE SINALOA</h3>
					<p class="lead muted">DIRECCIÓN DE CONTROL DE BIENES E INVENTARIOS</p>
					<address class="muted">
					  GRAL. ÁNGEL FLORES PONIENTE. SIN NÚMERO<br>
					  COL. CENTRO C.P. 80000<br>
					  TELS. 759-77-74<br>
					  CULIACÁN ROSALES, SINALOA<br/><br/><br/>
					  <h3 style="text-align:center;">PAQUETE DE REQUISICIONES</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>
</div>
<h2><?php echo "Nombre: " . $model->nombre; ?></h2>
<?php
		$usuarioActual = Usuario::model()->obtenerUsuarioActual();
		if($usuarioActual->tipoUsuario->nombre == "Almacen"){
				if($model->estatus_did == 2){
?>
	<div class="pull-right">
		<?php echo CHtml::link('Devolver',array('paqueterequisiciones/cambiarestatus','id'=>$model->id, 'estatus'=>3),array("class"=>"btn btn-info")); ?>
	</div>
<?php 	}
			} ?>
<br/>
<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<th style="text-align:center">No.</th>
			<th>Número Req.</th>
			<th>Unidad Organizacional</th>
			<th>Proveedor</th>
			<th>Número OC</th>
			<th>Fecha OC</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($detallePaquete as $detalle){ $c++; $ordenCompra = OrdenCompra::model()->find("requisicion_did = " . $detalle->requisicion->id); ?>
		<tr>
			<td style="text-align:center"><?php echo $c; ?></td>
			<td><?php echo $detalle->requisicion->numeroRequisicion;?></td>
			<td><?php echo $detalle->requisicion->unidadOrganizacional->nombre;?></td>
			<td><?php echo $ordenCompra->proveedor->nombre;?></td>
			<td><?php echo $ordenCompra->numeroOrdenCompra;?></td>
			<td><?php echo date("Y-m-d H:i:s", strtotime($ordenCompra->fechaCreacion_f)); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>