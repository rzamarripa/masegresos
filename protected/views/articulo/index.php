<?php
	$this->pageCaption='Artículos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';

	$this->breadcrumbs=array(
		'Artículos'=>array('index'),
        'Listar'
	);
	
	$this->menu=array(
		array('label'=>'Crear Artículo','url'=>array('create')),
		array('label'=>'Administrar Artículos','url'=>array('admin')),
	);
	$this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'headersview' =>'_headersview',
		'footersview' => '_footersview',
		'itemView'=>'_view',
	)); 
?>
