<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Buscar';
	
	$this->breadcrumbs=array(
		'Detalle Inventarios'=>array('index'),
		'Administrar',
	);
	
	$this->menu=array(
    array('label'=>'Volver','url'=>array('inventario/index')),
    array('label'=>'Listar Inventario','url'=>array('inventario/index')),
    array('label'=>'Crear Inventario','url'=>array('inventario/create')),
    array('label'=>'Baja de Inventario','url'=>array('inventario/bajaInventario')),
	);
	
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'detalle-inventario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'serie',
		'tipoCaptura',
		array('name'=>'articulo_aid',
		        'value'=>'$data->articulo->nombre',
			    'filter'=>CHtml::listData(Articulo::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),),
		array('name'=>'unidadOrganizacional_did',
		       'value'=>'$data->unidadOrganizacional->nombre',
			    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),),
		array('name'=>'funcion_aid',
		       'value'=>'$data->funcion->nombre',
			    'filter'=>CHtml::listData(Funcion::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),),
		array('name'=>'marca_aid',
		        'value'=>'$data->marca->nombre',
			    'filter'=>CHtml::listData(Marca::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),),
		'modelo',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}{update}',
            'buttons'=>array(
                'update'=>array(
                    'label'=>'Editar',
                ),
                'view'=>array(
                    'label'=>'Ver',
                ),
            ),
		    ),
	),
)); ?>
