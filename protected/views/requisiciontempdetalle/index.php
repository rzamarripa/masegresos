<?php
$this->pageCaption='Requisiciontempdetalle';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Listar requisiciontempdetalle';
$this->breadcrumbs=array(
	'Requisiciontempdetalle',
);

$this->menu=array(
	array('label'=>'Crear Requisiciontempdetalle','url'=>array('create')),
	array('label'=>'Administrar Requisiciontempdetalle','url'=>array('admin')),
);
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
