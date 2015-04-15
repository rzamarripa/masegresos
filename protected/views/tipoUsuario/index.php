<?php
    $this->pageCaption='Tipos de Usuarios';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Listar';

    $this->breadcrumbs=array(
	    'Tipos de Usuarios'=>array('index'),
        'Listar'
    );

    $this->menu=array(
	    array('label'=>'Crear Tipo de Usuario','url'=>array('create')),
	    array('label'=>'Administrar Tipos de Usuarios','url'=>array('admin')),
    );
    ?>

    <?php $this->widget('bootstrap.widgets.TbListView',array(
	    'dataProvider'=>$dataProvider,
	    'headersview' =>'_headersview',
	    'footersview' => '_footersview',
	    'itemView'=>'_view',
    )); ?>
