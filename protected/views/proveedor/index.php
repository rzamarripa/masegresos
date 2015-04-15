<?php
    $this->pageCaption='Proveedores';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Listar";
    
    $this->breadcrumbs=array(
	    'Proveedores'=>array('index'),
        'Listar'
    );

    $this->menu=array(
	    array('label'=>'Crear Proveedor','url'=>array('create')),
	    array('label'=>'Administrar Proveedores','url'=>array('admin')),
    );

     $this->widget('bootstrap.widgets.TbListView',array(
	    'dataProvider'=>$dataProvider,
	    'headersview' =>'_headersview',
	    'footersview' => '_footersview',
	    'itemView'=>'_view',
    )); ?>
