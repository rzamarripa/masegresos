<?php
$this->breadcrumbs=array(
	'Proveedores Por Cotizacions',
);

$this->menu=array(
	array('label'=>'Crear ProveedoresPorCotizacion','url'=>array('create')),
	array('label'=>'Administrar ProveedoresPorCotizacion','url'=>array('admin')),
);
?>

<h1>Proveedores Por Cotizacions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
