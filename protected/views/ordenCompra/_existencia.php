<div class="row">
	<div class="span12">
		<?php 
		$c=0;
		if(!empty($uo)){
			echo CHtml::link('Imprimir',array('ordenCompra/impexistencia','uo'=>$uo,'fi'=>$fi,'ff'=>$ff),array("class"=>"btn btn-info", 'target'=>'_blank'));
		}else{
			echo CHtml::link('Imprimir General',array('ordenCompra/impexistenciageneral','fi'=>$fi,'ff'=>$ff),array("class"=>"btn btn-info", 'target'=>'_blank'));
		}?>
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
			<?php foreach($existencias as $existencia){ $c++;?>
			<tr>
				<td style="text-align:center"><?php echo $c;?></td>	
				<td style="text-align:center"><?php echo $existencia["codigo"];?></td>
				<td style="text-align:center"><?php echo $existencia["nombre"];?></td>
				<td style="text-align:center"><?php echo $existencia["cantidad"];?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>