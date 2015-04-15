<?php
	$this->pageCaption='Info. Requisición';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Ver';
	$c=0;
	$this->breadcrumbs=array(
			'Requisición'=>array('index'),
			'Ver proveedores pendientes',
		);
	$this->menu=array(
		array('label'=>'Volver','url'=>array('index')),
	);
?>
<div class="row">
	<div class="span4">
		<blockquote>
		  <p>Requisición: <?php echo $proveedores[0]->requisicion->numeroRequisicion; ?></p>
		  <small><cite title="Source Title"><?php echo $proveedores[0]->requisicion->unidadOrganizacional->nombre; ?></cite></small>
		</blockquote>
		<p>
		  <i class="icon-calendar"></i> <?php echo $proveedores[0]->requisicion->fecha_f; ?> <br>
		  <i class="icon-flag"></i> <?php echo $proveedores[0]->requisicion->estatus->requisicion; ?> <br>
		</p>
	</div>
	<div class="span8">
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th class="span1 "><p class="text-center">No.</p></th>
					<th class="span2"><p class="text-center">Proveedor</p></th>			
					<th class="span2"><p class="text-center">Dirección</p></th>			
					<th class="span2"><p class="text-center">Correo</p></th>			
					<th class="span2"><p class="text-center">RFC</p></th>			
				</tr>
			</thead>
			<tbody>
				<?php foreach($proveedores as $proveedor){ $c++; ?>
				<tr>
					<td style='text-align:center;'><?php echo $c;?></td>						
               <td style='text-align:center;'><?php echo $proveedor->proveedor->nombre;?></td>							
               <td style='text-align:center;'><?php echo $proveedor->proveedor->direccion;?></td>							
               <td style='text-align:center;'><?php echo $proveedor->proveedor->correo;?></td>							
               <td style='text-align:center;'><?php echo $proveedor->proveedor->rfc;?></td>							
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<div style="height:100px;"></div>
	</div>
</div>