<?php
    $this->pageCaption='Unidad Organizacional';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Listar';

    $this->breadcrumbs=array(
	    'Unidad Organizacional'=>array('index'),
        'Listar'
    );

    $this->menu=array(
	    array('label'=>'Crear UO','url'=>array('create')),
	    array('label'=>'Administrar UOs','url'=>array('admin')),
    );
    ?>

    <?php $this->widget('bootstrap.widgets.TbListView',array(
	    'dataProvider'=>$dataProvider,
	    'headersview' =>'_headersview',
	    'footersview' => '_footersview',
	    'itemView'=>'_view',
    )); ?>
