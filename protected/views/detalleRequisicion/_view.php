	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->cantidad); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidad->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->articulo->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->observaciones); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->requisicion->numeroRequisicion); ?>
		</td>
	</tr>