	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->numeroCotizacion); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fecha_f); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->director); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->subtotal); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->iva); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->total); ?>
		</td>
	</tr>