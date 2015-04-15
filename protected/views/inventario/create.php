<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Crear';
	
	$this->breadcrumbs=array(
			'Inventarios'=>array('index'),
			'Crear',
		);
	
	$this->menu=array(
		array('label'=>'Volver','url'=>array('index')),
		array('label'=>'Listar Inventario','url'=>array('index')),
		array('label'=>'Baja de Inventario','url'=>array('bajaInventario')),
		array('label'=>'Reubicación de espacio','url'=>array('reubicacion')),
		array('label'=>'Buscar Inventario','url'=>array('detalleInventario/admin')),
	);
	
	echo $this->renderPartial('_form', array('model'=>$model, 
															'modelDetalle' => $modelDetalle, 
															'configuraciones' => $configuraciones, 
															'uos'=>$uos,
															'funciones'=>$funciones,
															'fondos'=>$fondos,
															'articulos' => $articulos,
															'marcas' => $marcas,
															'proveedores' => $proveedores,)); ?>
