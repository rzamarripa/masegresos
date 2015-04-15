<?php
$this->pageCaption='Requisiciones Temporales';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Listar';
$this->breadcrumbs=array(
	'Requisiciones Temp',
);

$this->menu=array(
	array('label'=>'Crear Requisición Temp','url'=>array('create')),
	array('label'=>'Administrar Requisición Temp','url'=>array('admin')),
);
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
