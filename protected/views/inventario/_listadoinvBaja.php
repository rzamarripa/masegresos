<?php echo CHtml::link('Imprimir',array('inventario/implistadoinv','uo'=>$uo, 'tipoReporte'=>$tipoReporte),array("class"=>"btn btn-info", 'target'=>'_blank')); ?>
<br />
<br />
<table class="table table-bordered table-condensed">

	<thead class="thead">
		<tr>
			<td style="text-align:center"><strong>Salida Resguardo</strong></td>
			<td style="text-align:center"><strong>Autorizo</strong></td>
			<td style="text-align:center"><strong>Fecha de Baja</strong></td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($inventarios as $inventario){ ?>
	<tr>		
		<td style="text-align:center"><?php echo $inventario->id;?></td>
		<td style="text-align:center"><?php echo $inventario->autorizo->nombre;?></td>
		<td style="text-align:center"><?php echo $inventario->fechaBaja_f;?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>

