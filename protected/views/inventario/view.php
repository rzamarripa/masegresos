<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Detalle';


	$this->breadcrumbs=array(
		'Inventarios'=>array('index'),
		$model->id,
	);

	$this->menu=array(
		array('label'=>'Listar Inventario','url'=>array('index')),
		array('label'=>'Crear Inventario','url'=>array('create')),
	);
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'baseScriptUrl'=>false,
		'cssFile'=>false,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-condensed'),
		'attributes'=>array(
			'id',
			array(	'name'=>'unidadOrganizacional_aid',
				        'value'=>$model->unidadOrganizacional->nombre,),
			array(	'name'=>'origen_did',
				        'value'=>$model->origen->nombre,),
			array(	'name'=>'tipoDocumento_did',
				        'value'=>$model->tipoDocumento->nombre,),
			'numeroDocumento',
			'salidaResguardo',
			array(	'name'=>'proveedor_aid',
				        'value'=>$model->proveedor->nombre,),
			'ejercicio',
			array(	'name'=>'fondo_aid',
				        'value'=>$model->fondo->nombre,),
			'autorizo',
			'estatus',
			array(	'name'=>'usuarioAlta_did',
				        'value'=>$model->usuarioAlta->usuario,),
		),
	)); 

	$detalleInventario = DetalleInventario::model()->findAll("inventario_did = " . $_GET["id"]);
	$c=0;
?>
<hr>
<table class="table table-striped table-condensed table-bordered">
	<thead class="thead">
		<tr>
			<td>No.</td>
			<td>Tipo</td>
			<td>Cantidad</td>
			<td>Artículo</td>
			<td>Espacio</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($detalleInventario as $detalle){ $c++;?>
		<tr>
			<td><?php echo $c; ?></td>	
			<td><?php echo $detalle->tipoCaptura; ?></td>	
			<td><?php echo (isset($detalle->lote) && !empty($detalle->lote) && $detalle->lote = 1) ? $detalle->cantidadPorLote : $detalle->cantidad;?></td>	
			<td><?php echo $detalle->articulo->nombre;?></td>	
			<td><?php echo $detalle->funcion->nombre;?></td>			
		</tr>
		<?php } ?>
	</tbody>
</table>