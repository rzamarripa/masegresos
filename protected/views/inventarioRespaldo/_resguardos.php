<?php $c=0; ?>

<?php echo CHtml::link('Imprimir',array('inventario/impresguardo','uo'=>$uo),array("class"=>"btn btn-info", 'target'=>'_blank')); ?>
<br />
<br />
<table class="table table-bordered table-condensed">
	<thead class="thead">
		<tr>
			<td style="text-align:center"><strong>No.</strong></td>
			<td style="text-align:center"><strong>Inventario</strong></td>
			<td style="text-align:center"><strong>Lote</strong></td>
			<td style="text-align:center"><strong>Cantidad</strong></td>
			<td style="text-align:center"><strong>Descripción</strong></td>
			<td style="text-align:center"><strong>Serie</strong></td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($inventarios as $inventario){ $c++;?>
	<tr>
	<td style="text-align:center"><?php echo $c;?></td>	
		<td style="text-align:center"><?php echo $inventario->id;?></td>
		<td style="text-align:center"><?php echo $inventario->lote?></td>
		<td style="text-align:center"><?php if($inventario->esLote == 0)
					{
						echo $inventario->cantidad;				
					}
					else
					{
						echo $inventario->cantidadPorLote;
					}
		?></td>
		<td style="text-align:center"><?php echo $inventario->articulo->nombre?></td>
		<td style="text-align:center"><?php echo $inventario->serie;?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>

