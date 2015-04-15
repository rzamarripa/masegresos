<?php
	$this->pageCaption='Artículos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Actualizar';
	
    $this->breadcrumbs=array(
	    'Artículos'=>array('index'),
	    'Actualizar',
    );

    $this->menu=array(
	    array('label'=>'Listar Artículos','url'=>array('index')),
	    array('label'=>'Crear Artículo','url'=>array('create')),
	    array('label'=>'Ver Artículo','url'=>array('view','id'=>$model->id)),
	    array('label'=>'Administrar Artículos','url'=>array('admin')),
    );

    echo $this->renderPartial('_form',array('model'=>$model)); 
?>