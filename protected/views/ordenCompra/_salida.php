<?php $c=0; 

echo CHtml::link('Imprimir',array('ordenCompra/impsalida','uo'=>$uo,'fi'=>$fi,'ff'=>$ff),array("class"=>"btn btn-info", 'target'=>'_blank')); ?>
<br />
<br />
<table class="table table-bordered table-condensed">
	<thead class="thead">
		<tr>
			<td style="text-align:center"><strong>Número</strong></td>
			<td style="text-align:center"><strong>Código</strong></td>
			<td style="text-align:center"><strong>Nombre</strong></td>
			<td style="text-align:center"><strong>Cantidad</strong></td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($salidas as $salida){ $c++;?>
	<tr>
		<td style="text-align:center"><?php echo $c;?></td>	
		<td style="text-align:center"><?php echo $salida["codigo"];?></td>
		<td style="text-align:center"><?php echo $salida["nombre"];?></td>
		<td style="text-align:center"><?php echo $salida["cantidad"];?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>