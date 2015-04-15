<?php
$this->breadcrumbs=array(
	'Proveedores Por Requisicions',
);

$this->menu=array(
	array('label'=>'Crear ProveedoresPorRequisicion','url'=>array('create')),
	array('label'=>'Administrar ProveedoresPorRequisicion','url'=>array('admin')),
);
?>

<h1>Proveedores Por Requisicions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
