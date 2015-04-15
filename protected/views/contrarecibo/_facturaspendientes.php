<?php 
	$contrarecibos = Contrarecibo::model()->findAll("proveedor_did = ". $_POST["proveedor"]);
	foreach($contrarecibos as $contrarecibo){
		$detalles = DetalleContrarecibo::model()->findAll("estatus_did = 1 && contrarecibo_did = :c", array(":c" => $contrarecibo->id));
		if(count($detalles)>0){
			$c = 1;
			foreach($detalles as $detalle)
				$facturaspendientes[] = [$detalle["contrarecibo_did"],$detalle["numeroFactura"],$detalle["fechaFactura_f"],$detalle["totalFactura"]]; 
		}
	}

	$totalFacturasPendientes = 0;

?> 
<div class="row">
	<div class="span12">
		<?php 
			$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'imprimir-form',
				'type'=>'horizontal',
				'enableAjaxValidation'=>true,		
			)); 
			$data=serialize($facturaspendientes); 
 			$facpendientes=htmlentities($data);
			?>
			<input type="hidden" name="facturaspendientes" value="hola" />
			<?php
			$this->widget('bootstrap.widgets.TbButton', array(
				'url'=>array('imprimirfacturaspendientes','id'=>$proveedorId),
				'label'=>'Imprimir',
				'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				'size'=>'',
				'htmlOptions'=>array(
					'target'=>'_blank',
				), // null, 'large', 'small' or 'mini'
			)); 

			$this->endWidget(); ?>
		<table class="table table-bordered table-condesed">
			<thead class="thead">
				<th  style="text-align:center";>No.</th>
				<th  style="text-align:center";>Contrarecibo</th>
				<th  style="text-align:center";>Factura</th>
				<th  style="text-align:center";>Fecha</th>
				<th  style="text-align:center";>Importe</th>				
			</thead>
			<tbody>
			<?php foreach($facturaspendientes as $facturaPendiente){ $c++; $totalFacturasPendientes += $facturaPendiente[3]; ?>
				<tr>	
					<td style="text-align:center;"><?php echo $c; ?></td>
					<td style="text-align:center;"><?php echo $facturaPendiente[0]; ?></td>
					<td style="text-align:center;"><?php echo $facturaPendiente[1]; ?></td>
					<td style="text-align:center;"><?php echo $facturaPendiente[2]; ?></td>
					<td style="text-align:right;"><?php echo "$" . number_format($facturaPendiente[3],2); ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="4"></td>
				<td style="text-align:right"><?php echo "$" . number_format($totalFacturasPendientes,2); ?></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
