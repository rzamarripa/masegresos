<?php
    $this->pageCaption='Actividades';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Actividades'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Actividades','url'=>array('index')),
	    array('label'=>'Crear Actividad','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('actividad-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'actividad-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'mensaje',
		'usuario',
		'fechaCreacion_f',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
