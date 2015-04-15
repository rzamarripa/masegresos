<?php
    $this->pageCaption='Inventarios';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Administrar";

    $this->breadcrumbs=array(
	    'Inventarios'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Inventario','url'=>array('index')),
	    array('label'=>'Crear Inventario','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('inventario-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'inventario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'codigoInventario',
		array('name'=>'unidadOrganizacional_aid',
		        'value'=>'$data->unidadOrganizacional->nombre',
			    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),),
		'numeroDocumento',
		'salidaResguardo',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
