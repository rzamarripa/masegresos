	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fecha_f); ?>
		</td>	
		<td>
			<?php echo CHtml::encode($data->fechaCreacion_f); ?>
		</td>
	</tr>