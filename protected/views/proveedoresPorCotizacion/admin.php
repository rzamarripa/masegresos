<?php
$this->breadcrumbs=array(
	'Proveedores Por Cotizacions'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorCotizacion','url'=>array('index')),
	array('label'=>'Crear ProveedoresPorCotizacion','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('proveedores-por-cotizacion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'proveedores-por-cotizacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'cotizacion_aid',
		        'value'=>'$data->cotizacion->nombre',
			    'filter'=>CHtml::listData(Cotizacion::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'proveedor_aid',
		        'value'=>'$data->proveedor->nombre',
			    'filter'=>CHtml::listData(Proveedor::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
