<?php
    $this->pageCaption='Detalle de Cotización xxxx';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='';
    
    $this->breadcrumbs=array(
    'Proveedor'=>array('proveedor/dashboard'));
    
    $c = 0;
?>
<div class="alert alert-info text-center">
  <h3>Detalle de la cotización</h3>
</div>
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead class="thead">
		<tr>
			<td class='span1'>No.</td>
			<td class='span3'>Cantidad Cotizada</td>
			<td class='span2'>Unidad</td>
			<td>Artículo</td>
			<td>Observaciones</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($detalleCotizacion as $detalle){ $c++;?>
		<tr>
			<td><?php echo $c;?></td>	
			<td><?php echo $detalle->cantidad;?></td>
			<td><?php echo $detalle->unidad->nombre;?></td>	
			<td><?php echo $detalle->articulo->nombre;?></td>
			<td><?php echo $detalle->observaciones;?></td>				
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>'Editar',
	'type'=>'info',
	'icon'=>'file white',
    'url'=>array('proveedor/CotizacionNueva','cotizacionId'=>$detalleCotizacion[0]->cotizacion_did),
)); ?>