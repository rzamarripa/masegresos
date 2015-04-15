<?php
	$this->pageCaption='Requisición';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='de ' . $model->unidadOrganizacional->nombre;
	
	$this->breadcrumbs=array(
		'Requisiciones'=>array('index'),
		'Actualizar',
	);
	
	$this->menu=array(
		array('label'=>'Listar Requisiciones','url'=>array('index')),
		array('label'=>'Crear Requisición','url'=>array('create')),
		array('label'=>'Ver Requisición','url'=>array('view','id'=>$model->id)),
		array('label'=>'Administrar Requisiciones','url'=>array('admin')),
	);

	echo $this->renderPartial('_form',array('model'=>$model, 'unidades' => $unidades, 'detalle' => $detalle)); 
?>