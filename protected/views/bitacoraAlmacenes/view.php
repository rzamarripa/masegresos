<?php

	$this->pageCaption='Bitácora Almacén';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Ver';
	
	$this->breadcrumbs=array(
		'Bitácora Almacén'=>array('index'),
		$model->id,
	);
	
	$this->menu=array(
		array('label'=>'Volver','url'=>array('bitacoraalmacenes/admin')),
	);
	
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array('name'=>'usuario_did',
			   'value'=>$model->usuario->usuario,),
		array('name'=>'ordenCompra_did',
			   'value'=>$model->ordenCompra->numeroOrdenCompra,),
		'nombreRecibioAlmacen',
		'nombreRecibioUO',
	),
)); ?>
