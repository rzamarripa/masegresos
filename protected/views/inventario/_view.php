	<tr>
		<td style='text-align:center;'>
			<?php echo CHtml::link(CHtml::encode($data->salidaResguardo), array('impresguardo', 'salidaRes'=>$data->salidaResguardo),array('target'=>'_blank')); ?>
		</td>
        <td style='text-align:center;'>
			<?php echo CHtml::encode($data->numeroDocumento); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->origen->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->tipoDocumento->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidadOrganizacional->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->proveedor->nombre); ?>
		</td>
	</tr>