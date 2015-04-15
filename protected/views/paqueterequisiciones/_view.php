	<tr>
		<td style="text-align:center">
			<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->nombre); ?>
		</td>
		<td>
			<?php echo CHtml::encode(date("d-m-Y H:i:s", strtotime($data->fechaCreacion_f))); ?>
		</td>
		<td>
			<?php echo CHtml::encode($data->usuario->usuario); ?>
		</td>
		<td>
			<?php if($data->enviadoa == 0)
							echo "Almacén";
						else
							echo "Pagos";
			?>
		</td>
		<td>
			<?php	if($data->estatus_did == 1){
					//Pendiente
					echo '<span class="label label-important">' . CHtml::encode($data->estatus->paquete) . '</span>';
				}else if($data->estatus_did == 2){
					//Enviado
					echo '<span class="label label-info">' . CHtml::encode($data->estatus->paquete) . '</span>';
				}else if($data->estatus_did == 3){
					//Devuelto
					echo '<span class="label label-warning">' . CHtml::encode($data->estatus->paquete) . '</span>';
				}else if($data->estatus_did == 4){
					//Cerrado
					echo '<span class="label label-success">' . CHtml::encode($data->estatus->paquete) . '</span>';
				}
		  ?>

		</td>
		<td style="text-align:center">
			<?php
				if($data->estatus_did == 1){
					$this->widget('bootstrap.widgets.TbButtonGroup', array(
		        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		        'buttons'=>array(
		            array('items'=>array(
		                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$data->id)),
		                array('label'=>'Agregar más Req.', 'icon'=>'pencil', 'url'=>array('agregarrequisiciones','id'=>$data->id)),
		                '---',
		                array('label'=>'Enviar', 'icon'=>'plane', 'url'=>array('cambiarestatus','id'=>$data->id, 'estatus'=>2)),
		                '---',
		                array('label'=>'Eliminar', 'icon'=>'trash', 'url'=>array('delete','id'=>$data->id), 'linkOptions'=>array('confirm' => 'Está seguro de Eliminar el paquete?')),
		            )),
		        ),
		        'htmlOptions'=>array("style"=>"text-align:left")
					));
				}else if($data->estatus_did == 2){
					$this->widget('bootstrap.widgets.TbButtonGroup', array(
		        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		        'buttons'=>array(
		            array('items'=>array(
		                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$data->id)),
		            )),
		        ),
		        'htmlOptions'=>array("style"=>"text-align:left")
					));
				}else if($data->estatus_did == 3){
					$this->widget('bootstrap.widgets.TbButtonGroup', array(
		        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		        'buttons'=>array(
		            array('items'=>array(
		                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$data->id)),
		                '---',
		                array('label'=>'Cerrar (Archivado)', 'icon'=>'plane', 'url'=>array('cambiarestatus','id'=>$data->id, 'estatus'=>4)),
		            )),
		        ),
		        'htmlOptions'=>array("style"=>"text-align:left")
					));
				}else if($data->estatus_did == 4){
					$this->widget('bootstrap.widgets.TbButtonGroup', array(
		        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		        'buttons'=>array(
		            array('items'=>array(
		                array('label'=>'Más detalles', 'icon'=>'list-alt', 'url'=>array('view','id'=>$data->id)),
		            )),
		        ),
		        'htmlOptions'=>array("style"=>"text-align:left")
					));
				}
		     ?>
		</td>
	</tr>