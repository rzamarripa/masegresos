<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
	
	$this->breadcrumbs=array(
		'Inventarios',
	);
	
	$this->menu=array(
		array('label'=>'Crear DetalleInventario','url'=>array('create')),
		array('label'=>'Administrar DetalleInventario','url'=>array('admin')),
	);
	
	$this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'headersview' =>'_headersview',
		'footersview' => '_footersview',
		'itemView'=>'_view',
	)); ?>
