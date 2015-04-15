<?php
$this->breadcrumbs=array(
	'Archivos Proyectos',
);

$this->menu=array(
	array('label'=>'Crear ArchivosProyecto','url'=>array('create')),
	array('label'=>'Administrar ArchivosProyecto','url'=>array('admin')),
);
?>

<h1>Archivos Proyectos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
