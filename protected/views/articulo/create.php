<?php
	$this->pageCaption='Artículos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Crear';
	
	$this->breadcrumbs=array(
		'Artículos'=>array('index'),
		'Crear',
	);

	$this->menu=array(
		array('label'=>'Listar Artículos','url'=>array('index')),
		array('label'=>'Administrar Artículos','url'=>array('admin')),
	);

echo $this->renderPartial('_form', array('model'=>$model)); 
?>