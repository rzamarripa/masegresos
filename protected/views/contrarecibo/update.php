<?php
	$this->pageCaption='Contrarecibos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Actualizar';
	
	$this->breadcrumbs=array(
			'Contrarecibos'=>array('index'),
			'Actualizar',
		);

$this->menu=array(
	array('label'=>'Volver','url'=>array('index')),
	array('label'=>'Crear Contrarecibo','url'=>array('create')),
);

echo $this->renderPartial('_form',array('model'=>$model, 'proveedores' => $proveedores, 'detalle' => $detalle)); ?>