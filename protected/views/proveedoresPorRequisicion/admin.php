<?php
    $this->breadcrumbs=array(
	    'Proveedores Por Requisicions'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar ProveedoresPorRequisicion','url'=>array('index')),
	    array('label'=>'Crear ProveedoresPorRequisicion','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('proveedores-por-requisicion-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'proveedores-por-requisicion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'requisicion_aid',
		        'value'=>'$data->requisicion->nombre',
			    'filter'=>CHtml::listData(Requisicion::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'proveedor_aid',
		        'value'=>'$data->proveedor->nombre',
			    'filter'=>CHtml::listData(Proveedor::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
