<?php
    $this->pageCaption='Unidades';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Listar';

    $this->breadcrumbs=array(
	    'Unidades'=>array('index'),
        'Listar'
    );

    $this->menu=array(
	    array('label'=>'Crear Unidad','url'=>array('create')),
	    array('label'=>'Administrar Unidades','url'=>array('admin')),
    );
    ?>

    <?php $this->widget('bootstrap.widgets.TbListView',array(
	    'dataProvider'=>$dataProvider,
	    'headersview' =>'_headersview',
	    'footersview' => '_footersview',
	    'itemView'=>'_view',
    )); ?>
