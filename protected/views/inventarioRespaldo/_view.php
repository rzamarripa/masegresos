	<tr>
        <td>
            <?php echo CHtml::link(CHtml::encode($data->codigoInventario), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->unidadOrganizacional->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->numeroDocumento); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->salidaResguardo); ?>
		</td>
	</tr>