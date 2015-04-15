<?php
    $this->breadcrumbs=array(
	    'Detalle Requisicions'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar DetalleRequisicion','url'=>array('index')),
	    array('label'=>'Crear DetalleRequisicion','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('detalle-requisicion-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'detalle-requisicion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cantidad',
		array('name'=>'unidad_did',
		        'value'=>'$data->unidad->nombre',
			    'filter'=>CHtml::listData(Unidad::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'articulo_aid',
		        'value'=>'$data->articulo->nombre',
			    'filter'=>CHtml::listData(Articulo::model()->findAll(), 'id', 'nombre'),),
		'observaciones',
		array('name'=>'requisicion_did',
		        'value'=>'$data->requisicion->nombre',
			    'filter'=>CHtml::listData(Requisicion::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
