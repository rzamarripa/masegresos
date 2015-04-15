	<tr>
		<td>
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->investigador); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaInicio_f); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaFin_f); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidadOrganizacional->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fechaCreacion_f); ?>
		</td>
		<?php /*
		<td>
			<?php echo CHtml::encode($data->estatus->nombre); ?>
		</td>
		*/ ?>
	</tr>