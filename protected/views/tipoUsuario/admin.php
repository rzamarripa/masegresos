<?php
    $this->pageCaption='Tipos de Usuarios';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Administrar";

    $this->breadcrumbs=array(
	    'Tipos de Usuarios'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Tipos de Usuarios','url'=>array('index')),
	    array('label'=>'Crear Tipos de Usuario','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('tipo-usuario-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tipo-usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id',
                'value'=>'$data->id',
                'htmlOptions'=>array('class'=>'span2')
                
        ),
		'nombre',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll('nombre IS NOT NULL'), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
