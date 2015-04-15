<?php
    $this->breadcrumbs=array(
	    'Detalle Orden Compras'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar DetalleOrdenCompra','url'=>array('index')),
	    array('label'=>'Crear DetalleOrdenCompra','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('detalle-orden-compra-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'detalle-orden-compra-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cantidad',
		array('name'=>'articulo_aid',
		        'value'=>'$data->articulo->nombre',
			    'filter'=>CHtml::listData(Articulo::model()->findAll(), 'id', 'nombre'),),
		'precioUnitario',
		'importe',
		array('name'=>'ordenCompra_did',
		        'value'=>'$data->ordenCompra->nombre',
			    'filter'=>CHtml::listData(OrdenCompra::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
