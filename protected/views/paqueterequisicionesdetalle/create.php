<?php
$this->pageCaption='Crear Paqueterequisicionesdetalle';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Crear nuevo paqueterequisicionesdetalle';
$this->breadcrumbs=array(
	'Paqueterequisicionesdetalle'=>array('index'),
	'Crear',
);
$this->menu=array(
	array('label'=>'Listar Paqueterequisicionesdetalle','url'=>array('index')),
	array('label'=>'Administrar Paqueterequisicionesdetalle','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>