<?php
$this->pageCaption='Paqueterequisicionesdetalle';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Listar paqueterequisicionesdetalle';
$this->breadcrumbs=array(
	'Paqueterequisicionesdetalle',
);

$this->menu=array(
	array('label'=>'Crear Paqueterequisicionesdetalle','url'=>array('create')),
	array('label'=>'Administrar Paqueterequisicionesdetalle','url'=>array('admin')),
);
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
