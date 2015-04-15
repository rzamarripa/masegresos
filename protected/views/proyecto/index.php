<?php
$this->breadcrumbs=array(
	'Proyectos',
);

$this->menu=array(
	array('label'=>'Crear Proyecto','url'=>array('create')),
	array('label'=>'Administrar Proyecto','url'=>array('admin')),
);
?>
<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
