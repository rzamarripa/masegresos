	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->idContrarecibo); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->idOrdenCompra); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->numeroOrdenCompra); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaOrdenCompra_f); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->subtotal); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->iva); ?>
		</td>
		<?php /*
		<td>
			<?php echo CHtml::encode($data->total); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->numeroFactura); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaFactura_f); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaCreacion_f); ?>
		</td>
		*/ ?>
	</tr>