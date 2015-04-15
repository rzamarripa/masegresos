<?php
	$segArreglo = Array();

	$proveedoresPorRequisicion = ProveedoresPorRequisicion::model()->findAll("requisicion_aid = " . $seguimiento->requisicion_aid);

	$segArreglo[]=array("doc"=>"Requisición",
											"mov"=>"Realizada",
											"usuario"=>$seguimiento->usuarioCreacion,
											"fecha"=>$seguimiento->fechaCreacion_f,
											"lado"=>"",
											"estatus" => 1);
	$segArreglo[]=array("doc"=>"Requisición",
											"mov"=>"Enviado a Cotizar",
											"usuario"=>$seguimiento->usuarioEnvio,
											"fecha"=>$seguimiento->fechaEnvio_f,
											"lado"=>"timeline-inverted",
											"estatus" => 2);
	$segArreglo[]=array("doc"=>"Cotización",
											"mov"=>"Cotizada",
											"usuario"=>$seguimiento->usuarioCotizacion,
											"fecha"=>$seguimiento->fechaCotizacion_f,
											"lado"=>"",
											"estatus" => 3 . $seguimiento->estatus_did);
	$segArreglo[]=array("doc"=>"Orden de Compra",
											"mov"=>"Realizada",
											"usuario"=>$seguimiento->usuarioOrdenCompra,
											"fecha"=>$seguimiento->fechaOrdenCompra_f,
											"lado"=>"timeline-inverted",
											"estatus" => 4);
	$segArreglo[]=array("doc"=>"Orden de Compra",
											"mov"=>"Entrada a Almacén",
											"usuario"=>$seguimiento->usuarioEntradaAlmacen,
											"fecha"=>$seguimiento->fechaEntradaAlmacen_f,
											"lado"=>"",
											"estatus" => 5);
	$segArreglo[]=array("doc"=>"Orden de Compra",
											"mov"=>"Salida de Almacén",
											"usuario"=>$seguimiento->usuarioSalidaAlmacen,
											"fecha"=>$seguimiento->fechaSalidaAlmacen_f,
											"lado"=>"timeline-inverted",
											"estatus" => 6);
?>
<div class="row">
	<div class="span12">
		<h1 class="text-center">Seguimiento Requisición: <?php echo $seguimiento->numeroRequisicion; ?></h1>
		<ul class="timeline">
			<?php
				foreach($segArreglo as $seg){
					if(empty($seg["fecha"])){
						if($seg["estatus"]==33){
						?>
			<li class="<?php echo $seg["lado"]; ?>">
		    <div class="timeline-badge primary"><a><i class="glyphicons glyphicons-pencil glyphicons-white" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
		    <div class="timeline-panel">
		      <div class="timeline-heading">
						<h3 class="text-center text-success"><?php echo $seg["doc"]; ?></h3>

		      </div>
		      <div class="timeline-body">
		        <p><strong>Movimiento:</strong> <?php echo $seg["mov"]; ?></p>
		        	<table class="table table-striped table-bordered table-condensed" style="font-size: 8pt;">
		        		<thead class="thead">
		        			<tr>
		        				<th>Provedor</th>
		        				<th>Estatus</th>
		        				<th>Fecha</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php foreach($proveedoresPorRequisicion as $provporreq){
			        			if($provporreq->estatus_did == 3){
		        			?>
		        			<tr>
		        				<td><?php echo $provporreq->proveedor->nombre;?></td>
		        				<td>Cotizada</td>
		        				<td><?php echo date("Y-m-d H:i:s", strtotime($provporreq->fechaCotizacion_ft));?></td>
		        			</tr>
		        			<?php } }?>
		        		</tbody>
		        	</table>
		      </div>
		      <div class="timeline-footer">
		          <span class="pull-right"><strong>Usuario:</strong> El proveedor</span>
		      </div>
		    </div>
		  </li>
		  <li class="clearfix" style="float: none;"></li>
			<?php	}else{
							break;
						}
					}else{
			?>
			<li class="<?php echo $seg["lado"]; ?>">
		    <div class="timeline-badge primary"><a><i class="glyphicons glyphicons-pencil glyphicons-white" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
		    <div class="timeline-panel">
		      <div class="timeline-heading">
						<h3 class="text-center text-success"><?php echo $seg["doc"]; ?></h3>
		      </div>
		      <hr>
		      <div class="timeline-body">
		        <p><strong>Movimiento:</strong> <?php echo $seg["mov"]; ?></p>
		        <p><strong>Fecha:</strong> <?php echo date("d-m-Y h:i:s", strtotime($seg["fecha"])); ?></p>
		        <?php if($seg["estatus"] == 2){ ?>
		        	<table class="table table-striped table-bordered table-condensed" style="font-size: 8pt;">
		        		<thead class="thead">
		        			<tr>
		        				<th>Provedor</th>
		        				<th>Estatus</th>
		        				<th>Fecha</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php foreach($proveedoresPorRequisicion as $provporreq){ ?>
		        			<tr>
		        				<td><?php echo $provporreq->proveedor->nombre;?></td>
		        				<td>Enviada</td>
		        				<td><?php echo date("Y-m-d H:i:s", strtotime($provporreq->fechaEnvio_ft));?></td>
		        			</tr>
		        			<?php } ?>
		        		</tbody>
		        	</table>
		        <?php }else if($seg["estatus"] >= 34){ ?>
							<table class="table table-striped table-bordered table-condensed" style="font-size: 8pt;">
		        		<thead class="thead">
		        			<tr>
		        				<th>Provedor</th>
		        				<th>Estatus</th>
		        				<th>Fecha</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php foreach($proveedoresPorRequisicion as $provporreq){
			        			if($provporreq->estatus_did == 3){
		        			?>
		        			<tr>
		        				<td><?php echo $provporreq->proveedor->nombre;?></td>
		        				<td>Cotizada</td>
		        				<td><?php echo date("Y-m-d H:i:s", strtotime($provporreq->fechaCotizacion_ft));?></td>
		        			</tr>
		        			<?php } }?>
		        		</tbody>
		        	</table>
						<?php } ?>
		      </div>

		      <div class="timeline-footer">
		          <span class="pull-right"><strong>Usuario:</strong> <?php echo $seg["usuario"]; ?></span>
		      </div>
		    </div>
		  </li>
		  <li class="clearfix" style="float: none;"></li>
			<?php	}
					}
			?>
		</ul>
	</div>
</div>
