<?php
$this->pageCaption='Crear Requisición Temp';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Requisiciones Temp'=>array('index'),
	'Crear',
);
$this->menu=array(
	array('label'=>'Volver','url'=>array('index')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>