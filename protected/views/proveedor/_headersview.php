<table class="table table-bordered table-striped">
	<thead class="thead">
		<tr>
			<td class='span1'>
			    <b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?></b>
		    </td>
		    <td class='span6'>
			    <b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?></b>
		    </td>
		    <td >
			    <b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?></b>
		    </td>
		    <td class='span1'>
			    <b><?php echo CHtml::encode($data->getAttributeLabel('estatus_did')); ?></b>
		    </td>
		    <td class='span2'>
			    <b><?php echo CHtml::encode($data->getAttributeLabel('rfc')); ?></b>
		    </td>
		</tr>
	</thead>