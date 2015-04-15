<?php $uo = UnidadOrganizacional::model()->findByPK($uo); ?>
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
					  <h3 style="text-align:center;">EXISTENCIAS POR UNIDAD ORGANIZACIONAL</h3>
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
			<tr>
				<td colspan="3"  style="padding:1px;">UNIDAD ORGANIZACIONAL</td>
				<td><?php echo $uo->codigo . " - " . $uo->nombre; ?></td>
			</tr>
		</table>
	</div>
</div>	

<div class="row">
	<div class="span12">
		<table class="table table-bordered table-condesed">
			<thead class="thead">
				<tr>
					<th style="padding:1px;">CODIGO</th>
					<th style="padding:1px;">NOMBRE</th>
					<th style="padding:1px;">CANTIDAD</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($existencias as $existencia){ 
				?>
				<tr>						
					<td style="padding:1px;"><?php echo $existencia["codigo"];?></td>
					<td style="padding:1px;"><?php echo $existencia["nombre"];?></td>
					<td style="padding:1px;"><?php echo $existencia["cantidad"];?></td>
				</tr>
				<?php } ?>		
			</tbody>
		</table>
	</div>
</div>
