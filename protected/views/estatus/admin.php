<?php
    $this->pageCaption='Estatus';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Estatus'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Estatus','url'=>array('index')),
	    array('label'=>'Crear Estatus','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('estatus-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'estatus-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'requisicion',
		'cotizacion',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
