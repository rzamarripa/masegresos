<?php
$this->breadcrumbs=array(
	'Detalle Contrarecibos',
);

$this->menu=array(
	array('label'=>'Crear DetalleContrarecibo','url'=>array('create')),
	array('label'=>'Administrar DetalleContrarecibo','url'=>array('admin')),
);
?>

<h1>Detalle Contrarecibos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
