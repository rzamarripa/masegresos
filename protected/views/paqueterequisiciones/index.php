<?php
$this->pageCaption='Paquete de Requisiciones';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Listar';
$this->breadcrumbs=array(
	'Paquete de Requisiciones',
);

$this->menu=array(
	array('label'=>'Crear Paquete de Requisiciones','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
