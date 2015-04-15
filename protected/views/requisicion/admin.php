<?php
	$this->pageCaption='Requisiciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Requisiciones'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
    array('label'=>'Volver','url'=>array('site/index')),
	    array('label'=>'Listar Requisiciones','url'=>array('index')),
	    array('label'=>'Crear Requisición','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('requisicion-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");

 $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'requisicion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
        'name'  => 'numeroRequisicion',
        'value' => 'CHtml::link($data->numeroRequisicion, Yii::app()->createUrl("requisicion/seguimiento",array("id"=>$data->numeroRequisicion)))',
        'type'  => 'raw',
    ),
		'fecha_f',
		array('name'=>'unidadOrganizacional_aid',
		        'value'=>'$data->unidadOrganizacional->nombre',
			    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),),
		'comentarios',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {view}',
            'buttons'=>array(
                'update'=>array(
                    'label'=>'Editar',
                ),
                'view'=>array(
                    'label'=>'Ver',
                ),
            ),
		),
	),
)); ?>
