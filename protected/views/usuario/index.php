<?php
    $this->pageCaption='Usuarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
	
    $this->breadcrumbs=array(
	    'Usuarios'=>array('index'),
        'Listar'
    );

    $this->menu=array(
	    array('label'=>'Crear Usuario','url'=>array('create')),
	    array('label'=>'Administrar Usuarios','url'=>array('admin')),
    );
    
    $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
