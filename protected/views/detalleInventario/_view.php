	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->tipoCaptura); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->articulo->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->marca->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->modelo); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->serie); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->costoAdquisicion); ?>
		</td>
		<?php /*
		<td>
			<?php echo CHtml::encode($data->espacio->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->observaciones); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->cantidad); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->cantidadPorLote); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->lote); ?>
		</td>
		*/ ?>
	</tr>