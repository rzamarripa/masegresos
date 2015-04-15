<?php
$this->breadcrumbs=array(
	'Actividads',
);

$this->menu=array(
	array('label'=>'Crear Actividad','url'=>array('create')),
	array('label'=>'Administrar Actividad','url'=>array('admin')),
);
?>

<h1>Actividads</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
