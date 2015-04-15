<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Filtrar';

	$this->breadcrumbs=array(
		'Inventarios'=>array('index'),
		'Administrar',
	);
	
	$this->menu=array(
		array('label'=>'Listar Inventario','url'=>array('index')),
		array('label'=>'Crear Inventario','url'=>array('create')),
        array('label'=>'Baja de Inventario','url'=>array('bajaInventario')),
        array('label'=>'Reubicación de espacio','url'=>array('reubicacion')),
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


	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'inventario-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			array(
                'name'=>'salidaResguardo'
                ,'value'=>'$data->salidaResguardo'
                ,'htmlOptions'=>array(
                    'style'=>'text-align:center; width:100px;'

                )
            ),
            array(
                'name'=>'numeroDocumento'
                ,'value'=>'$data->numeroDocumento'
                ,'htmlOptions'=>array(
                    'style'=>'text-align:center;  width:100px;'
                )
            ),
			array('name'=>'unidadOrganizacional_aid',
			        'value'=>'$data->unidadOrganizacional->nombre',
				    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),
                    'htmlOptions'=>array(
                        'style'=>'width:500px;'
                    )
            ),
			array('name'=>'tipoDocumento_did',
			        'value'=>'$data->tipoDocumento->nombre',
				    'filter'=>CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Documento'"), 'id', 'nombre'),),
			array('name'=>'origen_did',
			        'value'=>'$data->origen->nombre',
				    'filter'=>CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Origen'"), 'id', 'nombre'),),
         array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                //'update'=>array(
                //    'label'=>'Editar',
                //),
                'view'=>array(
                    'label'=>'Ver',
                ),
            ),
		    ),
		),
	)); ?>
