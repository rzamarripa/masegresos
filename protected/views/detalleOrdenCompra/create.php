<?php
$this->breadcrumbs=array(
		'Detalle Orden Compras'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar DetalleOrdenCompra','url'=>array('index')),
	array('label'=>'Administrar DetalleOrdenCompra','url'=>array('admin')),
);
?>

<h1>Crear DetalleOrdenCompra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>