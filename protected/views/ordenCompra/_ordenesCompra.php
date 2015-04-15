
<?php //echo "<pre>"; print_r($ordenesCompra); echo "</pre>"; exit; ?>
<?php if(!empty($ordenesCompra)){
	echo CHtml::link('Imprimir',array('ordenCompra/impordenes',"provId"=>$provId,"uoId"=>$uoId,"fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin),array("class"=>"btn btn-info", 'target'=>'_blank'));
				?>

<table class="table table-striped table-bordered">
	<caption><h4>Ordenes de Compra</h4></caption>
	<thead class="thead">
		<tr>
			<td>Orden Compra</td>
			<td>Fecha</td>
			<td>Proveedor</td>
			<td>Unidad Organizacional</td>
			<td>Subtotal</td>
			<td>IVA</td>
			<td>Total</td>
			<td>Ver</td>
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
			<td style="text-align:center;"><div class="button-column"><a class="view" href="<?php echo yii::app()->baseUrl . $ordenCompra["id"]; ?>" target="_blank"><i class="icon-eye-open"></i></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php }else{
	echo "No se encontrarón registros";
} ?>