<?php
$this->pageCaption='Actualizar Paqueterequisiciones '.$model->id;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Paqueterequisiciones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Paqueterequisiciones','url'=>array('index')),
	array('label'=>'Crear Paqueterequisiciones','url'=>array('create')),
	array('label'=>'Ver Paqueterequisiciones','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Paqueterequisiciones','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>