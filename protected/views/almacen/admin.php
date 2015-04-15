<?php
    $this->pageCaption='Almacenes';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Almacenes'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Almacenes','url'=>array('index')),
	    array('label'=>'Crear Almacen','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('almacen-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'almacen-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'direccion',
		'descripcion',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
