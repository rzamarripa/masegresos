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
					  <h3 style="text-align:center;">REQUISICIÓN</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>	
</div>
<div class="row">
	<div class="span12">
		<table class="table table-condensed table-bordered">			
			<tbody>
				<tr>
					<td ><strong>Unidad Organizacional</strong></td>
					<td class="span2"><strong>Requisición</strong></td>
					<td class="span2"><?php echo $model->numeroRequisicion; ?></td>
				</tr>
				<tr>
					<td><?php echo $model->unidadOrganizacional->nombre; ?></td>
					<td><strong>Fecha</strong></td>
					<td><?php echo date("d-m-Y", strtotime($model->fecha_f)); ?></td>
				</tr>
				<tr>
					
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">	
	<div class="span12">		
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<th>No.</th>
					<th>Cantidad</th>
					<th>Artículo</th>
					<th>Unidad</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleRequisicion as $detalle){ $c++;?>
				<tr>
					<td><?php echo $c;?></td>	
					<td><?php echo $detalle->cantidad;?></td>	
					<td><?php echo $detalle->articulo->nombre;?></td>
					<td><?php echo $detalle->articulo->unidad;?></td>
					<td><?php echo $detalle->observaciones;?></td>				
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<table class="table table-bordered table-condensed">
			<tr>
				<td class="span2"><strong>Comentario</strong></td>
				<td><?php echo $model->comentarios; ?></td>
			</tr>
		</table>
	</div>
</div>

