<?php

$this->pageCaption=$model->nombre;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Actualizar';

$this->breadcrumbs=array(
	'Proyectos'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Volver','url'=>array('admin')),
	array('label'=>'Crear Proyecto','url'=>array('create')),
);

echo $this->renderPartial('_form',array('model'=>$model)); ?>