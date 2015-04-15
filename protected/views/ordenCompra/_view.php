<tr>
	<td>
		<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->numeroOrdenCompra); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->fecha_f); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->proveedor->nombre); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->unidadOrganizacional->nombre); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->requisicion->numeroRequisicion); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->subtotal); ?>
	</td>
</tr>