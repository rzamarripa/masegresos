﻿<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/docs.css" />
<link rel="stylesheet" media="print" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/select2.css" />


<?php 
$contador = 0;
$banBase = 0;
foreach($inventarios as $inventario){ 
	$banBase = 1;
	if(($contador % 28) == 0){
?>
<div class="row">
	<div class="span3 text-center">
		<img src="<?php echo Yii::app()->baseUrl;?>/images/uaslogo.jpg" alt="logoUas" width="150" height="200">
	</div>
	<div class="span6 text-center">
		<h3>UNIVERSIDAD AUTÓNOMA DE SINALOA</h3>
		<p class="lead muted">DIRECCIÓN DE CONTROL DE BIENES E INVENTARIOS<br />RESGUARDO DE BIENES MUEBLES</p>		
	</div>
	<div class="span2">
		<table class="table table-bordered table-condensed">
			<thead class='thead'>
				<th style="text-align:center">RESGUARDO NO.</th>
			</thead>
			<tbody>
				<tr>
					<td style="text-align:center">123</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span12">
			<table class="table table-bordered table-condensed">
				<tr>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
					<td class='span1'></td>
				</tr>
				<tr>
					<td colspan="2"  style="padding:1px;">UNIDAD REGIONAL</td>
					<td colspan="1"  style="padding:1px;">?</td>
					<td colspan="3"  style="padding:1px;">UNIDAD ORGANIZACIONAL</td>
					<td colspan="6"  style="padding:1px;"><?php echo $unidadOrg->id." ".$unidadOrg->nombre;?></td>
				</tr>
				<tr>
					<td colspan="1" style="padding:1px;">FACTURA</td>
					<td colspan="5" style="padding:1px;">????</td>
					<td colspan="1" style="padding:1px;">FECHA ADQUISICION</td>
					<td colspan="5" style="padding:1px;">01/01/1900</td>
				</tr>
				<tr>
					<td colspan="2" style="padding:1px;">ORIGEN DEL BIEN</td>
					<td colspan="10" style="padding:1px;">????</td>
				</tr>
			</table>
			<table class="table table-bordered table-condesed">
				<thead class="thead">
					<th style="padding:1px;">INVENTARIO</th>
					<th style="padding:1px;">LOTE</th>
					<th style="padding:1px;">UNIDAD</th>
					<th style="padding:1px;">DESCRIPCION DEL BIEN INMUEBLE</th>
					<th style="padding:1px;">SERIE</th>
				</thead>
				<tbody>
				<?php }?>
					<tr>						
						<td style="padding:1px;"><?php echo $inventario->id;?></td>
						<td style="padding:1px;"><?php echo $inventario->lote;?></td>
						<td style="padding:1px;"><?php echo $inventario->cantidad;?></td>
						<td style="padding:1px;"><div style="height:18px;overflow:hidden;"><?php echo $inventario->articulo->nombre;?></div></td>
						<td style="padding:1px;"><?php echo $inventario->serie;?></td>
					</tr>
				<?php if(($contador % 28) == 27){
					$banBase = 0;
				 ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row" style="margin-top:5px;">
		<div class="span12">
			<div class="text-left">
				<p class="small"><strong>Al firmar el presente resguardo me obligo a:</strong><br />
				Cumplir con lo establecido en el reglamento de Responsabilidades de los Servicios Universitarios<br />
				y prestacion de Servicios del Gobierno del Estado de Sinaloa.</p>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:40px;">
		<div class="span12">
			<div class="span5">
				<div class="text-center">
					<u><?php echo "C. NORMA ALICIA AGUILAR NAVARRO"; ?></u>
					<p class="small"><strong>DIRECTOR DE CONTROL DE BIENES E INVENATARIOS</strong></p>
				</div>
			</div>
			<div class="span1">
				<div class="text-center">
					RESGUARDANTE:
				</div>
			</div>
			<div class="span5">
				<div class="text-center">
					<u><?php echo "ENCARGADO DE LA UO"; ?></u>
					<p class="small"><strong>TITULAR DE LA UO.</strong></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="span12">
			<div class="text-center">
				<?php echo "CAPTURISTA DE LA UO"; ?>
				<p class="small"><strong>CAPTURISTA.</strong></p>
			</div>
		</div>
	</div>
</div>
<?php
	}
	$contador++;
 }
 if($banBase == 1)
 {
 ?>
 </tbody>
			</table>
		</div>
	</div>
	<div class="row" style="margin-top:10px;">
		<div class="span12">
			<div class="text-left">
				<p class="small"><strong>Al firmar el presente resguardo me obligo a:</strong><br />
				Cumplir con lo establecido en el reglamento de Responsabilidades de los Servicios Universitarios<br />
				y prestacion de Servicios del Gobierno del Estado de Sinaloa.</p>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:40px;">
		<div class="span12">
			<div class="span5">
				<div class="text-center">
					<u><?php echo "C. NORMA ALICIA AGUILAR NAVARRO"; ?></u>
					<p class="small"><strong>DIRECTOR DE CONTROL DE BIENES E INVENATARIOS</strong></p>
				</div>
			</div>
			<div class="span1">
				<div class="text-center">
					RESGUARDANTE:
				</div>
			</div>
			<div class="span5">
				<div class="text-center">
					<u><?php echo "ENCARGADO DE LA UO"; ?></u>
					<p class="small"><strong>TITULAR DE LA UO.</strong></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="span12">
			<div class="text-center">
				<?php echo "CAPTURISTA DE LA UO"; ?>
				<p class="small"><strong>CAPTURISTA.</strong></p>
			</div>
		</div>
	</div>
</div>
<?php } ?>

