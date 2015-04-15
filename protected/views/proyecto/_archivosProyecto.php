<?php
	$archivos = ArchivosProyecto::model()->findAll("proyecto_aid = " . $_GET["id"]);
	$arch = 0;
?>
<table class="table table-striped table-bordered table-condensed">
	<thead class="thead">
		<tr>
			<td class="span1">No.</td>
			<td>Nombre</td>
			<td class="span2">Estatus</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($archivos as $archivo){ $arch++; ?>
		<tr>
			<td><?php echo $arch;?></td>
			<td><?php echo $archivo->nombre;?></td>
			<td><?php echo $archivo->estatus->archivo;?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>