	<tr>
		<td>
			<?php 	echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->numeroRequisicion); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->fecha_f); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidadOrganizacional->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->comentarios); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->director); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->titular); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->recibio); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->entrego); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->estatus->nombre); ?>
		</td>
	</tr>