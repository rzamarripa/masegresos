	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->nombre), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->estado->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->estatus->nombre); ?>
		</td>
	</tr>