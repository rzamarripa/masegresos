<?php

	
	$this->pageCaption='Bitácora de Almacén';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='';
	
	
	$this->breadcrumbs=array(
		'Bitacora Almacenes'=>array('almacenista'),
		'Administrar',
	);
	
	$this->menu=array(
		array('label'=>'Volver','url'=>array('site/index')),
	);
?>
	
<?php $this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'bitacora-almacenes-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'id',
			array('name'=>'usuario_did',
			        'value'=>'$data->usuario->usuario',
				    'filter'=>CHtml::listData(Usuario::model()->findAll("tipoUsuario_did = 7"), 'id', 'usuario'),),
			array('name'=>'ordenCompra_did',
			        'value'=>'$data->ordenCompra->numeroOrdenCompra',
				    'filter'=>CHtml::listData(OrdenCompra::model()->findAll(), 'id', 'numeroOrdenCompra'),),
			'nombreRecibioUO',
			'fechaCreacion_f',
			array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'Ver',
                ),
            ),
		),
		),
	)); 
?>
