<?php
$this->breadcrumbs=array(
	'Proveedores Por Cotizacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorCotizacion','url'=>array('index')),
	array('label'=>'Crear ProveedoresPorCotizacion','url'=>array('create')),
	array('label'=>'Actualizar ProveedoresPorCotizacion','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar ProveedoresPorCotizacion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar ProveedoresPorCotizacion','url'=>array('admin')),
);
?>

<h1>Ver ProveedoresPorCotizacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array(	'name'=>'cotizacion_aid',
			        'value'=>$model->cotizacion->nombre,),
		array(	'name'=>'proveedor_aid',
			        'value'=>$model->proveedor->nombre,),
	),
)); ?>
