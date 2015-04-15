<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/docs.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/select2.css" />

<?php $funcionId=-1; ?>
<div class="row">
	<div class="span3 text-center">
		<img src="<?php echo Yii::app()->baseUrl;?>/images/uaslogo.jpg" alt="logoUas" width="150" height="200">
	</div>
	<div class="span6 text-center">
		<h3>UNIVERSIDAD AUTÓNOMA DE SINALOA</h3>
		<p class="lead muted">DIRECCIÓN DE CONTROL DE BIENES E INVENTARIOS<br />FECHA:<?php echo date("y-m-d");  ?></p>		
	</div>
	<div class="span2"></div>
</div>
<div class="row">
	<div class="span12 text-center">
		UNIDAD ORGANIZACIONAL: <?php echo $unidadOrg->id." ".$unidadOrg->nombre;?>
	</div>
</div>

<div class="container">
	<div class="row">		
		<table class="table table-bordered table-condensed">
			<thead class="thead">
				<tr>
					<td style="text-align:center"><strong>Codigo</strong></td>
					<td style="text-align:center"><strong>Fec. Adq.</strong></td>
					<td style="text-align:center"><strong>Lote</strong></td>
					<td style="text-align:center"><strong>Cant. Exis.</strong></td>
					<td style="text-align:center"><strong>Articulo</strong></td>
					<td style="text-align:center"><strong>Serie</strong></td>
					<td style="text-align:center"><strong>Modelo</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($inventarios as $inventario){ 
					if($funcionId <> $inventario->	funcion_aid){?>
						<tr>
							<td style="text-align:center"><?php echo $inventario->funcion_aid;?></td>
							<td colspan="6"><?php echo $inventario->funcion->nombre;?></td>
						</tr>
					<?php $funcionId = $inventario->funcion_aid; } ?>
					

				<tr>		
					<td style="text-align:center"><?php echo $inventario->id;?></td>
					<td style="text-align:center"><?php echo $inventario->fechaAdquisicion_f?></td>
					<td style="text-align:center"><?php echo $inventario->lote?></td>
					<td style="text-align:center"><?php echo $inventario->cantidadPorLote?></td>
					<td style="text-align:left"><?php echo $inventario->articulo->nombre?></td>
					<td style="text-align:center"><?php echo $inventario->serie;?></td>
					<td style="text-align:center"><?php echo $inventario->modelo;?></td>
				</tr>
				<?php } ?>
				</tbody>
		</table>
	</div>	
</div>
