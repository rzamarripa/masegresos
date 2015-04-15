	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->requisicionTemp->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->cantidad); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->articulo); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidad->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->usuario->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaCreacion_f); ?>
		</td>
	</tr>