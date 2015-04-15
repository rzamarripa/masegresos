<?php
$this->pageCaption='Unidades';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='';

$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Unidades','url'=>array('index')),
	array('label'=>'Crear Unidad','url'=>array('create')),
	array('label'=>'Ver Unidad','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Unidades','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>