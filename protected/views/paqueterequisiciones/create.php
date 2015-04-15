<?php
$this->pageCaption='Paquete de Requisiciones';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Crear';
$this->breadcrumbs=array(
	'Paquete Requisiciones'=>array('index'),
	'Crear',
);
$this->menu=array(
	array('label'=>'Volver','url'=>array('index')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>