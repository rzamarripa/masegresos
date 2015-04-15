	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->cotizacion->id); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->proveedor->nombre); ?>
		</td>
	</tr>