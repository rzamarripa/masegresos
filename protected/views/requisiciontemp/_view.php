<tr>
	<td>
		<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	</td>
	<td>
		<?php echo CHtml::link(CHtml::encode($data->numero), array('view', 'id'=>$data->id)); ?>
	</td>	
	<td>
		<?php echo CHtml::encode($data->unidadOrganizacional->nombre); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->usuario->usuario); ?>
	</td>	
	<td>
		<?php echo CHtml::encode($data->fechaCreacion_f); ?>
	</td>
	<td>
		<?php echo CHtml::encode($data->estatus->requisicion); ?>
	</td>
	<td>
		<?php echo CHtml::link(CHtml::encode("Agregar Artículos"), array('requisiciontempdetalle/create', 'id'=>$data->id),array("class"=>"btn btn-primary btn-mini")); ?>
		<?php 
			if($data->estatus_did == 1)
				echo CHtml::link(CHtml::encode("Realizado"), array('requisiciontemp/cambiarestatus', 'id'=>$data->id, 'estatus'=>2),array("class"=>"btn btn-success btn-mini"));
			else
				echo CHtml::link(CHtml::encode("Pendiente"), array('requisiciontemp/cambiarestatus', 'id'=>$data->id, 'estatus'=>1),array("class"=>"btn btn-warning btn-mini")); ?>
	</td>
</tr>