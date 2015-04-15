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

<table class="table table-striped table-bordered">
	<caption><h4>Listado de todas las facturas pendientes</h4></caption>
	<thead class="thead">
		<tr>
			<td>No.</td>
			<td>Proveedor</td>
			<td>Orden Compra</td>
			<td>Fecha</td>
			<td>Subtotal</td>
			<td>Iva</td>
			<td>Importe</td>
			<td>No. Factura</td>
			<td>F. Factura</td>
			<td></td>
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
							<td><?php echo date("d-m-Y", strtotime($factura["fechaFactura"]));?></td>
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
<?php } else {
		echo "<h4>No hay pasivo</h4>";
	} ?>