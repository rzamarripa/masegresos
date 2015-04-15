<?php
$this->breadcrumbs=array(
	'Detalle Contrarecibos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar DetalleContrarecibo','url'=>array('index')),
	array('label'=>'Crear DetalleContrarecibo','url'=>array('create')),
	array('label'=>'Actualizar DetalleContrarecibo','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar DetalleContrarecibo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar DetalleContrarecibo','url'=>array('admin')),
);
?>

<h1>Ver DetalleContrarecibo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'idContrarecibo',
		'idOrdenCompra',
		'numeroOrdenCompra',
		'subtotal',
		'iva',
		'total',
		'numeroFactura',
	),
)); ?>
