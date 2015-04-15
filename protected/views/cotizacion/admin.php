<?php
	$this->pageCaption='Cotizaciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';
		
	$this->breadcrumbs=array(
		'Cotizaciones'=>array('index'),
		'Administrar',
	);
	
	$this->menu=array(
        array('label'=>'Volver','url'=>array('site/index')),
		array('label'=>'Listar Cotizaciones','url'=>array('index')),
	);
	
	Yii::app()->clientScript->registerScript('search', "
	    $('.search-button').click(function(){
		    $('.search-form').toggle();
		    return false;
	    });
	    $('.search-form form').submit(function(){
		    $.fn.yiiGridView.update('cotizacion-grid', {
			    data: $(this).serialize()
		    });
		    return false;
	    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cotizacion-grid',
	'dataProvider'=>$model->searchAdmin(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'numeroCotizacion',
                'value'=>'$data->numeroCotizacion',
                'htmlOptions'=>array('class'=>'span1'),
        ),
        array('name'=>'fecha_f',
                'value'=>'$data->fecha_f',
                'htmlOptions'=>array('class'=>'span2'),
        ),
		array('name'=>'requisicion_did',
		        'value'=>'$data->requisicion->numeroRequisicion',
			    'filter'=>CHtml::listData(Requisicion::model()->findAll('estatus_did = 3'), 'id', 'numeroRequisicion'),
                 'htmlOptions'=>array('class'=>'span2'),
        ),
		array('name'=>'proveedor_aid',
		        'value'=>'$data->proveedor->nombre',
			    'filter'=>CHtml::listData(Proveedor::model()->findAll(), 'id', 'nombre'),
                'htmlOptions'=>array('class'=>'span5')),			
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->cotizacion',
			    'filter'=>CHtml::listData(Estatus::model()->findAll('cotizacion is not null'), 'id', 'cotizacion'),
                'htmlOptions'=>array('class'=>'span2'),
        ),
        array('name'=>'total',
                'value'=>'$data->total',
                'htmlOptions'=>array('class'=>'span1'),
        ),
        array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'Ver',
                ),
            ),
		),
	),
)); ?>
