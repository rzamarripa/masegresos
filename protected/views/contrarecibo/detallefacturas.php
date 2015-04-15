<?php if(count($facturas)>0){ ?>
<table class="table table-striped table-bordered">
	<caption><h4>Listado de facturas</h4></caption>
	<thead class="thead">
		<tr>
			<td>Orden Compra</td>
			<td>Fecha</td>
			<td>Subtotal</td>
			<td>Iva</td>
			<td>Importe</td>
			<td>No. Factura</td>
			<td>F. Factura</td>
			<td>Total Fac.</td>
			<td>Estatus</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($facturas as $factura){ ?>
		<tr>
			<td style="text-align:center;"><?php echo $factura["numeroOrdenCompra"];?></td>
			<td style="text-align:center;"><?php echo $factura["fechaOrdenCompra"];?></td>
			<td style="text-align:right;"><?php echo "$" . number_format($factura["subtotal"],2);?></td>
			<td style="text-align:right;"><?php echo "$" . number_format($factura["iva"],2);?></td>
			<td style="text-align:right;"><?php echo "$" . number_format($factura["total"],2);?></td>
			<td style="text-align:center;"><?php echo $factura["numeroFactura"];?></td>
			<td style="text-align:center;"><?php echo $factura["fechaFactura"];?></td>
			<td style="text-align:right;"><?php echo "$" . number_format($factura["totalFactura"],2);?></td>
			<td style="text-align:center;"><span class="label label-<?php echo ($factura["estatus"] == "Pendiente") ? "warning" : "success" ?>"><?php echo $factura["estatus"];?></span></td>
			<td><p class="text-center">
       		<?php
			 		if($factura["estatus"] == 'Pendiente' ){
				 		$this->widget('bootstrap.widgets.TbButton', array(
					    'label'=>'Pagar',
					    'type'=>'danger',
					    'icon'=>'file white',
					    'size'=>'',
					    'url'=>array("contrarecibo/formcheque", 'id'=>$factura["id"], 'de'=>'prov'),
						));

						$this->widget('bootstrap.widgets.TbButton', array(
					    'label'=>'Cancelar',
					    'type'=>'warning',
					    'icon'=>'file white',
					    'size'=>'',
					    'url'=>array("contrarecibo/cancelarfactura", 'id'=>$factura["id"], 'de'=>'prov'),
						));
			 		}else{
				 		$this->widget('bootstrap.widgets.TbButton', array(
					    'label'=>'Pendiente',
					    'type'=>'info',
					    'icon'=>'file white',
					    'size'=>'',
					    'url'=>array("detallecontrarecibo/cambiarestatus", 'id'=>$factura["id"], 'de'=>'prov', 'estatus'=>1),
						));
			 		}					
				?></p>
       </td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } else { ?>
	<span class="label label-success">No se encontraron facturas</span>
<?php } ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'url'=>array('imprimirdetallefacturas','id'=>$factura["proveedor"]),
	'label'=>'Imprimir',
	'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	'size'=>'',
	'htmlOptions'=>array(
		'target'=>'_blank',
	), // null, 'large', 'small' or 'mini'
						)); ?>