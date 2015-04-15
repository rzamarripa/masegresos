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
					  <h3 style="text-align:center;">ORDEN DE COMPRA</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>
</div>
<br>
<div class="row">
	<div class="span12">
		<table style="font-size: 8pt;" class="table table-condensed table-bordered">
			<tr>
				<th style="text-align: center">Orden de Compra</th>
				<th style="text-align: center">Unidad Organizacional</th>
				<th style="text-align: center">Fecha Recibida</th>
			</tr>
			<tbody>
				<?php
					foreach($pendientes as $pendiente){
				?>
				<tr>
					<td style="padding:1px; text-align: center;"><?php echo $pendiente["numeroOrdenCompra"];?></td>
					<td style="padding:1px;"><?php echo $pendiente["nombre"];?></td>
					<td style="padding:1px; text-align: center;"><?php echo date("d-m-Y", strtotime($pendiente["fecha"])); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>