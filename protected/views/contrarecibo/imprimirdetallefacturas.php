<?php if(count($facturas)>0){ ?>
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
					  TELS. 713-90-11 Y 712-52-21<br>
					  CULIACÁN ROSALES, SINALOA<br/><br/><br/>
					  <h3 style="text-align:center;">PASIVO POR PROVEEDOR</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>	
</div>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered">
			<caption style="text-align:left;"><h3><?php echo $facturas[0]["proveedorNombre"];?><small> - Estado de cuenta</small></h3></caption>
			<thead class="thead">
				<tr>
					<th class="span2">Orden Compra</th>
					<th class="span2">Fecha</th>
					<th class="span2">Subtotal</th>
					<th class="span2">Iva</th>
					<th class="span2">Importe</th>
					<th class="span2">No. Factura</th>
					<th class="span2">F. Factura</th>
					<th class="span2">Total Fac.</th>
					<th class="span2">Estatus</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($facturas as $factura){ ?>
				<tr>
					<td style="text-align:center;"><?php echo $factura["numeroOrdenCompra"];?></td>
					<td style="text-align:center;"><?php echo date('d-m-Y',strtotime($factura["fechaOrdenCompra"]));?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($factura["subtotal"],2);?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($factura["iva"],2);?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($factura["total"],2);?></td>
					<td style="text-align:center;"><?php echo $factura["numeroFactura"];?></td>
					<td style="text-align:center;"><?php echo $factura["fechaFactura"];?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($factura["totalFactura"],2);?></td>
					<td style="text-align:center;"><?php echo $factura["estatus"];?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php } else { ?>
			<span class="label label-success">No se encontraron facturas</span>
		<?php } ?>
	</div>
</div>