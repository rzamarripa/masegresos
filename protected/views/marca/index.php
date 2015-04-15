<?php
$this->breadcrumbs=array(
	'Marcas',
);

$this->menu=array(
	array('label'=>'Crear Marca','url'=>array('create')),
	array('label'=>'Administrar Marca','url'=>array('admin')),
);
?>

<h1>Marcas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
