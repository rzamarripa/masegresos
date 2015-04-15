<?php echo CHtml::link('Imprimir',array('inventario/implistadoinv','uo'=>$uo),array("class"=>"btn btn-info", 'target'=>'_blank')); ?>
<br />
<br />
<table class="table table-bordered table-condensed">

	<thead class="thead">
		<tr>
			<td style="text-align:center"><strong>Codigo</strong></td>
			<td style="text-align:center"><strong>Fec. Adq.</strong></td>
			<td style="text-align:center"><strong>Lote</strong></td>
			<td style="text-align:center"><strong>Cant. Exis.</strong></td>
			<td style="text-align:center"><strong>Articulo</strong></td>
			<td style="text-align:center"><strong>Serie</strong></td>
			<td style="text-align:center"><strong>Modelo</strong></td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($inventarios as $inventario){ ?>
	<tr>		
		<td style="text-align:center"><?php echo $inventario->id;?></td>
		<td style="text-align:center"><?php echo $inventario->fechaAdquisicion_f?></td>
		<td style="text-align:center"><?php echo $inventario->lote?></td>
		<td style="text-align:center"><?php echo $inventario->cantidadPorLote?></td>
		<td style="text-align:center"><?php echo $inventario->articulo->nombre?></td>
		<td style="text-align:center"><?php echo $inventario->serie;?></td>
		<td style="text-align:center"><?php echo $inventario->modelo;?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>