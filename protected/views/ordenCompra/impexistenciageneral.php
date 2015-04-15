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
					  <h3 style="text-align:center;">PENDIENTES DE SURTIR</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>	
</div>
<br/>
<br/>
<br/>
<div class="row">
	<div class="span12">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>CODIGO</th>
					<th>NOMBRE</th>
					<th>CANTIDAD</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($existencias as $existencia){ 
				?>
				<tr>						
					<td><?php echo $existencia["codigo"];?></td>
					<td><?php echo $existencia["nombre"];?></td>
					<td><?php echo $existencia["cantidad"];?></td>
				</tr>
				<?php } ?>		
			</tbody>
		</table>
	</div>	
</div>