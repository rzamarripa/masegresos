<?php
$this->breadcrumbs=array(
	'Bitacora Almacenes',
);

$this->menu=array(
	array('label'=>'Crear BitacoraAlmacenes','url'=>array('create')),
	array('label'=>'Administrar BitacoraAlmacenes','url'=>array('admin')),
);
?>

<h1>Bitacora Almacenes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
