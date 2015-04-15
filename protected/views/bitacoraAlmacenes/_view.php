	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->usuario->usuario); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->ordenCompra->numeroOrdenCompra); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->recibioUO); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->nombreRecibioUO); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaCreacion_f); ?>
		</td>
	</tr>