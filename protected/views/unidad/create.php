<?php
$this->pageCaption='Unidades';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='';

$this->breadcrumbs=array(
		'Unidades'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar Unidades','url'=>array('index')),
	array('label'=>'Administrar Unidades','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>