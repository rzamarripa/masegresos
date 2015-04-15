<?php
$this->pageCaption='Agregar Artículos';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Al detalle';
$this->breadcrumbs=array(
	'Requisición Temp'=>array('index'),
	'Crear',
);
$this->menu=array(
	array('label'=>'Volver','url'=>array('requisiciontemp/index')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>