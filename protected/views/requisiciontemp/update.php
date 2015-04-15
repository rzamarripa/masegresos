<?php
$this->pageCaption='Actualizar Requisiciontemp '.$model->id;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Requisiciontemp'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Requisiciontemp','url'=>array('index')),
	array('label'=>'Crear Requisiciontemp','url'=>array('create')),
	array('label'=>'Ver Requisiciontemp','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Requisiciontemp','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>