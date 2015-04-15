<?php
$this->breadcrumbs=array(
	'Almacens',
);

$this->menu=array(
	array('label'=>'Crear Almacen','url'=>array('create')),
	array('label'=>'Administrar Almacen','url'=>array('admin')),
);
?>

<h1>Almacens</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
