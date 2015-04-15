<table class="table table-bordered table-striped">
	<thead class="thead">
		<tr>
			<td>
				<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></b>
			</td>
			<td >
				<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?></b>
			</td>			
			<td >
				<b><?php echo CHtml::encode($data->getAttributeLabel('unidadOrganizacional_did')); ?></b>
			</td>
			<td >
				<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_did')); ?></b>
			</td>	
			<td >
				<b><?php echo CHtml::encode($data->getAttributeLabel('fechaCreacion_f')); ?></b>
			</td>
			<td >
				<b><?php echo CHtml::encode($data->getAttributeLabel('estatus_did')); ?></b>
			</td>
			<td >
				<b>Acciones</b>
			</td>
		</tr>
	</thead>