<?php
	$this->pageCaption='Inventario';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Actualizar';
	
	$this->breadcrumbs=array(
		'Detalle Inventarios'=>array('index'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);
	
	$this->menu=array(
		array('label'=>'Volver','url'=>array('admin')),
	);

	echo $this->renderPartial('_form',array(
			'model'=>$model,
			'articulos'=>$articulos,
			'marcas'=>$marcas,
			'uos'=>$uos,
			'funciones'=>$funciones,)); 
?>