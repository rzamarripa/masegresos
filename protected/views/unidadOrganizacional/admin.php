<?php
    $this->pageCaption='Unidad Organizacional';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Unidad Organizacional'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar UOs','url'=>array('index')),
	    array('label'=>'Crear UO','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('unidad-organizacional-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'unidad-organizacional-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id',
                'value'=>'$data->id',
                'htmlOptions'=>array('class'=>'span2'),
        ),
		'nombre',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
