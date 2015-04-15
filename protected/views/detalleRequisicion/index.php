<?php
$this->breadcrumbs=array(
	'Detalle Requisicions',
);

$this->menu=array(
	array('label'=>'Crear DetalleRequisicion','url'=>array('create')),
	array('label'=>'Administrar DetalleRequisicion','url'=>array('admin')),
);
?>

<h1>Detalle Requisicions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
