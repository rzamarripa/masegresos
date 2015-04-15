<?php
    $this->pageCaption='Unidades';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Unidades'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Unidades','url'=>array('index')),
	    array('label'=>'Crear Unidad','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('unidad-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'unidad-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id',
                'value'=>'$data->id',
                'htmlOptions'=>array('class'=>'span2')
        ),
		'nombre',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll('nombre IS NOT NULL'), 'id', 'nombre'),
                'htmlOptions'=>array('class'=>'span2'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
