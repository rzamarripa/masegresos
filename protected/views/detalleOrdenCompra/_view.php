	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->cantidad); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->articulo->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->precioUnitario); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->importe); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->ordenCompra->nombre); ?>
		</td>
	</tr>