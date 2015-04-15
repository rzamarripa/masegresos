<?php
$this->breadcrumbs=array(
	'Detalle Orden Compras'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar DetalleOrdenCompra','url'=>array('index')),
	array('label'=>'Crear DetalleOrdenCompra','url'=>array('create')),
	array('label'=>'Ver DetalleOrdenCompra','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar DetalleOrdenCompra','url'=>array('admin')),
);
?>

<h1>Actualizar DetalleOrdenCompra <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>