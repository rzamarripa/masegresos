<?php
	echo CHtml::link('Imprimir',array('inventario/implistadoinv','uo'=>$uo, 'tipoReporte'=>$tipoReporte),array("class"=>"btn btn-info", 'target'=>'_blank'));
	$funcionId=-1;
?>
<br />
<br />
<table class="table table-bordered table-condensed display">
	<thead class="thead">
		<tr>
			<td style="text-align:center"><strong>Detalle Inv.</strong></td>
			<td style="text-align:center"><strong>Artículo</strong></td>
			<td style="text-align:center"><strong>Serie</strong></td>
			<td style="text-align:center"><strong>Modelo</strong></td>
			<td style="text-align:center"><strong>Lote</strong></td>
			<td style="text-align:center"><strong>Cant. Exist.</strong></td>
			<td style="text-align:center"><strong>Fec. Adq.</strong></td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($detalleInventario as $detalle){
		if($funcionId <> $detalle->funcion_aid){?>
			<tr>
				<td style="text-align:center"><?php echo $detalle->funcion_aid; ?></td>
				<td colspan="6"><?php echo $detalle->funcion->nombre; ?></td>
			</tr>
		<?php $funcionId = $detalle->funcion_aid; } ?>
	<tr>
		<td style="text-align:center"><?php echo $detalle->id; ?></td>
		<td style="text-align:center"><?php echo $detalle->articulo->nombre; ?></td>
		<td style="text-align:center"><?php echo $detalle->serie; ?></td>
		<td style="text-align:center"><?php echo $detalle->modelo; ?></td>
		<td style="text-align:center"><?php echo ($detalle->lote==1)?"Si":"No";?></td>
		<?php if($detalle->tipoCaptura == 'Lote'){ ?>
			<td style="text-align:center"><?php echo $detalle->cantidadPorLoteAct; ?></td>
		<?php } else { ?>
			<td style="text-align:center"><?php echo '1'; ?></td>
		<?php } ?>
		<td style="text-align:center"><?php echo date("d-m-Y", strtotime($detalle->inventario->fechaAdquisicion_f)); ?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function() {
    $('.display').DataTable();
} );
</script>