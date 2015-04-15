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
					  <h3 style="text-align:center;">Ordenes de Compra</h3>
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
					<td>Órden Compra</td>
					<td>Fecha</td>
					<td>Proveedor</td>
					<td>Unidad Organizacional</td>
					<td>Subtotal</td>
					<td>IVA</td>
					<td>Total</td>
				</tr>
			</thead>
				<tbody>
				<?php foreach($ordenesCompra as $ordenCompra){ 
				$proveedor = proveedor::model()->find("id =" . $ordenCompra["proveedor_aid"]);
				$uo = unidadorganizacional::model()->find("id =" . $ordenCompra["unidadOrganizacional_aid"]);?>
				<tr>
					<td style="text-align:center;"><?php echo $ordenCompra["numeroOrdenCompra"];?></td>
					<td style="text-align:center;"><?php echo $ordenCompra["fecha_f"];?></td>
					<td style="text-align:center;"><?php echo $proveedor->nombre;?></td>
					<td style="text-align:center;"><?php echo $uo->nombre;?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($ordenCompra["subtotal"],2);?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($ordenCompra["iva"],2);?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($ordenCompra["total"],2);?></td>
				</tr>
						<?php } ?>		
			</tbody>
		</table>
	</div>	
</div>