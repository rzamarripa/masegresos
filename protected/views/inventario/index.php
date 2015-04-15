<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
	
	$this->breadcrumbs=array(
		'Inventarios',
		'Listar'
	);
	
	$this->menu=array(
		array('label'=>'Volver','url'=>array('site/index')),
		array('label'=>'Crear Inventario','url'=>array('create')),
		array('label'=>'Baja de Inventario','url'=>array('bajaInventario')),
		array('label'=>'Reubicación de espacio','url'=>array('reubicacion')),
		array('label'=>'Buscar Inventario','url'=>array('detalleInventario/admin')),
	);
	
	$this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'headersview' =>'_headersview',
		'footersview' => '_footersview',
		'itemView'=>'_view',
	)); 
?>
