<?php

$this->pageCaption='Proveedor';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Crear";
    
$this->breadcrumbs=array(
		'Proveedores'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar Proveedor','url'=>array('index')),
	array('label'=>'Administrar Proveedor','url'=>array('admin')),
);

echo $this->renderPartial('_form', array('model'=>$model)); ?>