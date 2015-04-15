<?php
$this->breadcrumbs=array(
	'Detalle Orden Compras'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar DetalleOrdenCompra','url'=>array('index')),
	array('label'=>'Crear DetalleOrdenCompra','url'=>array('create')),
	array('label'=>'Actualizar DetalleOrdenCompra','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar DetalleOrdenCompra','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar DetalleOrdenCompra','url'=>array('admin')),
);
?>

<h1>Ver DetalleOrdenCompra #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'cantidad',
		array(	'name'=>'articulo_aid',
			        'value'=>$model->articulo->nombre,),
		'precioUnitario',
		'importe',
		array(	'name'=>'ordenCompra_did',
			        'value'=>$model->ordenCompra->nombre,),
	),
)); ?>
