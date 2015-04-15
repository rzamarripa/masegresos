<?php

$this->pageCaption='Unidad Organizacional';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Crear';

$this->breadcrumbs=array(
		'Unidad Organizacional'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar UOs','url'=>array('index')),
	array('label'=>'Administrar UOs','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>