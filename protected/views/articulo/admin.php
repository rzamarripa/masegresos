<?php
	$this->pageCaption='Artículos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Artículos'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Articulos','url'=>array('index')),
	    array('label'=>'Crear Articulo','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('articulo-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
    
    $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'articulo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'codigo',
            'value'=>'$data->codigo',
            'htmlOptions'=>array('class'=>'span2')
        ),
		'nombre',
		array(
            'name'=>'unidad',
            'value'=>'$data->unidad',
            'htmlOptions'=>array('class'=>'span2')
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
