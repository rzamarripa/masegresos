<?php	
	$this->pageCaption='Pasivo';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='General';
	
	$this->breadcrumbs=array(
			'Contrarecibos'=>array('index'),
			'Pasivo general',
		);
		
	$this->menu=array(
		array('label'=>'Volver','url'=>array('contrarecibo/index')),
		array('label'=>'Imprimir','url'=>array('imprimirpasivogeneral'), 'linkOptions' => array('target'=>'_blank')),
	);
	$sumaIVA = 0;
	$sumaSubtotal = 0;
	$sumaTotal = 0;
	$c = 0;
	if(count($facturas)>0){
		$tmpProveedor = $facturas[0]["proveedor"];
?>		
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
					  CULIACÁN ROSALES, SINALOA<br/><br/>
					  <h3 style="text-align:center;">PASIVO GENERAL</h3>
					</address>
				</td>
			</tr>
		</table>
	</div>	
</div>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered">
			<thead class="thead">
				<tr>
					<th>No.</th>
					<th>Proveedor</th>
					<th>Orden Compra</th>
					<th>Fecha</th>
					<th>Subtotal</th>
					<th>Iva</th>
					<th>Importe</th>
					<th>No. Factura</th>
					<th>F. Factura</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
				<?php 			
					foreach($facturas as $factura){
							if($factura["proveedor"] == $tmpProveedor){ $c++; ?>
								<tr>
									<td><?php echo $c;?></td>
									<td><?php echo $factura["proveedor"];?></td>
									<td><?php echo $factura["numeroOrdenCompra"];?></td>
									<td><?php echo date("d-m-Y", strtotime($factura["fechaOrdenCompra"]));?></td>
									<td style="text-align:right;"><?php echo '$' . number_format($factura["subtotal"],2);?></td>
									<td style="text-align:right;"><?php echo '$' . number_format($factura["iva"],2);?></td>
									<td style="text-align:right;"><?php echo '$' . number_format($factura["total"],2);?></td>
									<td style="text-align:center;"><?php echo $factura["numeroFactura"];?></td>
									<td><?php echo date("d-m-Y", strtotime($factura["fechaFactura"]));?></td>
									<td>Pendiente</td>
								</tr>
								<?php 
									$tmpProveedor = $factura["proveedor"]; 
									$sumaIVA += $factura["iva"];
									$sumaSubtotal += $factura["subtotal"];
									$sumaTotal += $factura["total"];
							} else { 
									$c++;
									?>
								<tr class="success">
									<td colspan="4"><strong><?php echo "Total " . $tmpProveedor;?></strong></td>			
									<td style="text-align:right;"><strong><?php echo '$' . number_format($sumaSubtotal,2);?></strong></td>
									<td style="text-align:right;"><strong><?php echo '$' . number_format($sumaIVA,2);?></strong></td>
									<td style="text-align:right;"><strong><?php echo '$' . number_format($sumaTotal,2);?></strong></td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td><?php echo $c;?></td>
									<td><?php echo $factura["proveedor"];?></td>
									<td><?php echo $factura["numeroOrdenCompra"];?></td>
									<td><?php echo $factura["fechaOrdenCompra"];?></td>
									<td style="text-align:right;"><?php echo '$' . number_format($factura["subtotal"],2);?></td>
									<td style="text-align:right;"><?php echo '$' . number_format($factura["iva"],2);?></td>
									<td style="text-align:right;"><?php echo '$' . number_format($factura["total"],2);?></td>
									<td style="text-align:center;"><?php echo $factura["numeroFactura"];?></td>
									<td><?php echo $factura["fechaFactura"];?></td>
									<td><p class="text-center">
						       		<?php					
											 	$this->widget('bootstrap.widgets.TbButton', array(
											    'label'=>'Pagar',
											    'type'=>'info',
											    'icon'=>'file white',
											    'size'=>'',
											    'url'=>array("contrarecibo/formcheque", 'id'=>$factura["id"], 'de'=>'general'),
												));
											
										?></p>
									</td>
								</tr>
								<?php 
									$tmpProveedor = $factura["proveedor"];
									$sumaIVA = 0;
									$sumaSubtotal = 0;
									$sumaTotal = 0; 
									$sumaIVA += $factura["iva"];
									$sumaSubtotal += $factura["subtotal"];
									$sumaTotal += $factura["total"];
							} 
						} ?>
				<tr class="success">
					<td colspan="4"><strong><?php echo "Total " . $tmpProveedor;?></strong></td>			
					<td style="text-align:right;"><strong><?php echo '$' . number_format($sumaSubtotal,2);?></strong></td>
					<td style="text-align:right;"><strong><?php echo '$' . number_format($sumaIVA,2);?></strong></td>
					<td style="text-align:right;"><strong><?php echo '$' . number_format($sumaTotal,2);?></strong></td>
					<td colspan="3"></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php } else {
		echo "<h4>No hay pasivo</h4>";
	} ?>