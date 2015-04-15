<?php
    $this->pageCaption='Proveedores';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription="Administrar";

    $this->breadcrumbs=array(
	    'Proveedores'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Proveedores','url'=>array('index')),
	    array('label'=>'Crear Proveedor','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('proveedor-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");

	$this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'proveedor-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				array(
					'class'=>'CLinkColumn',
					'label'=>'Sel',
					'urlExpression'=>'"mostrardocumentos/".$data->id',
					'header'=>'',
		      'htmlOptions'=>array('class'=>'span1')
				),
		    array(
		        'name'=>'codigo',
		        'value'=>'$data->codigo',
		        'htmlOptions'=>array('class'=>'span2')
		    ),
				'nombre',
				array('name'=>'estatus_did',
				      'value'=>'$data->estatus->nombre',
					    'filter'=>CHtml::listData(Estatus::model()->findAll('nombre IS NOT NULL'), 'id', 'nombre'),
		          'htmlOptions'=>array('class'=>'span2')
		    ),
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
				),
			),
		)); ?>
