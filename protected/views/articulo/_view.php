	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->codigo), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidad); ?>
		</td>
	</tr> 