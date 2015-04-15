<?php
$this->pageCaption='Actualizar Requisiciontempdetalle '.$model->id;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Requisiciontempdetalle'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Requisiciontempdetalle','url'=>array('index')),
	array('label'=>'Crear Requisiciontempdetalle','url'=>array('create')),
	array('label'=>'Ver Requisiciontempdetalle','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Requisiciontempdetalle','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>