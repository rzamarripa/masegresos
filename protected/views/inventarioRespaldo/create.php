<?php
    $this->pageCaption='Inventario';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Crear';

    $this->breadcrumbs=array(
		'Inventarios'=>array('index')
	);
	/*
    $this->menu=array(
	    array('label'=>'Listar Inventario','url'=>array('index')),
	    array('label'=>'Administrar Inventario','url'=>array('admin')),
    );
	*/
    echo $this->renderPartial('_form', array('model'=>$model)); 
?>

