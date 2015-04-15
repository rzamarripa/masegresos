<div class="row">
	<div class="span3 text-center">
		<img src="<?php echo Yii::app()->baseUrl;?>/images/uaslogo.jpg" alt="logoUas" width="150" height="200">
	</div>
	<div class="span6 text-center">
		<h3>UNIVERSIDAD AUTÓNOMA DE SINALOA</h3>
		<p class="lead muted">DIRECCIÓN DE CONTROL DE BIENES E INVENTARIOS<br />Salida artículos por Unidad Organizacional</p>		
	</div>
	
</div>
<br>
<div class="container">
	<div class="row">
		<div class="span12">
			<table class="table table-bordered table-condensed">
				<tr>
					<td colspan="3"  style="padding:1px;">UNIDAD ORGANIZACIONAL</td>
					<td colspan="6"  style="padding:1px;"><?php echo $uo . '-' .$nomuo?></td>
				</tr>
			</table>
		</div>
	</div>	
</div>

<div class="container">
	<div class="row">
		<div class="span12">
			<table class="table table-bordered table-condesed">
				<thead class="thead">
					<th style="padding:1px;">CODIGO</th>
					<th style="padding:1px;">NOMBRE</th>
					<th style="padding:1px;">CANTIDAD</th>
				</thead>
				<tbody>
					<?php 
						foreach($salidas as $salida){ 
					?>
					<tr>						
						<td style="padding:1px;"><?php echo $salida["codigo"];?></td>
						<td style="padding:1px;"><?php echo $salida["nombre"];?></td>
						<td style="padding:1px;"><?php echo $salida["cantidad"];?></td>
					</tr>
					<?php } ?>		
				</tbody>
			</table>
		</div>
	</div>
</div>
 </tbody>
			</table>
		</div>
	</div>
</div>


