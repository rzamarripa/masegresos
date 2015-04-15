<?php
$this->breadcrumbs=array(
	'Detalle Orden Compras',
);

$this->menu=array(
	array('label'=>'Crear DetalleOrdenCompra','url'=>array('create')),
	array('label'=>'Administrar DetalleOrdenCompra','url'=>array('admin')),
);
?>

<h1>Detalle Orden Compras</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
