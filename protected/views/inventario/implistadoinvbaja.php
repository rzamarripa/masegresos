<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/docs.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/select2.css" />

<div class="row">
	<div class="span3 text-center">
		<img src="<?php echo Yii::app()->baseUrl;?>/images/uaslogo.jpg" alt="logoUas" width="150" height="200">
	</div>
	<div class="span6 text-center">
		<h3>UNIVERSIDAD AUTÓNOMA DE SINALOA</h3>
		<p class="lead muted">DIRECCIÓN DE CONTROL DE BIENES E INVENTARIOS<br />REGISTRO DE BAJAS DE INVENTARIO DE ACTIVO FIJO
		</p>		
	</div>
	<div class="span2">
		<table class="table table-bordered table-condensed">
			<thead class='thead'>
				<th style="text-align:center"># Resguardo</th>
			</thead>
			<tbody>
				<tr>
					<td style="text-align:center"><?php echo $resBaja?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span12 text-center">
		UNIDAD ORGANIZACIONAL: <?php echo $unidadOrg;?>
	</div>
</div>

<div class="container">
	<div class="row">		
		<table class="table table-bordered table-condensed">
			<thead class="thead">
				<tr>
					<td style="text-align:center"><strong>Inventario</strong></td>
					<td style="text-align:center"><strong>Fec. Adq.</strong></td>
					<td style="text-align:center"><strong>Articulo</strong></td>
					<td style="text-align:center"><strong>Espacio</strong></td>
					<td style="text-align:center"><strong>Serie</strong></td>
					<td style="text-align:center"><strong>Tipo Baja</strong></td>
					<td style="text-align:center"><strong>Fec. Baja</strong></td>
					<td style="text-align:center"><strong>Fondo</strong></td>
					<td style="text-align:center"><strong>Cant. Lote</strong></td>
					<td style="text-align:center"><strong>Costo Adq.</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($inventarios as $inventario){ ?>				

				<tr>		
					<td style="text-align:center"><?php echo $inventario['id'];?></td>
					<td style="text-align:center"><?php echo $inventario['fec_adq']?></td>
					<td style="text-align:center"><?php echo $inventario['articulo']?></td>
					<td style="text-align:center"><?php echo $inventario['funcion']?></td>
					<td style="text-align:center"><?php echo $inventario['serie']?></td>
					<td style="text-align:left"><?php echo $inventario['tipoBaja']?></td>
					<td style="text-align:center"><?php echo $inventario['fec_baja'];?></td>
					<td style="text-align:center"><?php echo $inventario['fondo'];?></td>
					<td style="text-align:center"><?php echo $inventario['cant_lote'];?></td>
					<td style="text-align:center"><?php echo $inventario['costo'];?></td>
				</tr>
				<?php } ?>
				<tr>
					<td style="text-align:right" colspan="8">Total:</td>
					<td style="text-align:center"><?php echo $totalCosto?></td>
				</tr>
				</tbody>
		</table>
	</div>	
</div>
