<?php
$this->breadcrumbs=array(
	'Motivo Bajas',
);

$this->menu=array(
	array('label'=>'Crear MotivoBaja','url'=>array('create')),
	array('label'=>'Administrar MotivoBaja','url'=>array('admin')),
);
?>

<h1>Motivo Bajas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
