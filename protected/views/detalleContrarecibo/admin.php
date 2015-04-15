<?php
    $this->breadcrumbs=array(
	    'Detalle Contrarecibos'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar DetalleContrarecibo','url'=>array('index')),
	    array('label'=>'Crear DetalleContrarecibo','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('detalle-contrarecibo-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'detalle-contrarecibo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idContrarecibo',
		'idOrdenCompra',
		'numeroOrdenCompra',
		'fechaOrdenCompra_f',
		'subtotal',
		/*
		'iva',
		'total',
		'numeroFactura',
		'fechaFactura_f',
		'fechaCreacion_f',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
