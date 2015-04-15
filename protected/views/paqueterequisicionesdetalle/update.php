<?php
$this->pageCaption='Actualizar Paqueterequisicionesdetalle '.$model->id;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Paqueterequisicionesdetalle'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Paqueterequisicionesdetalle','url'=>array('index')),
	array('label'=>'Crear Paqueterequisicionesdetalle','url'=>array('create')),
	array('label'=>'Ver Paqueterequisicionesdetalle','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Paqueterequisicionesdetalle','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>