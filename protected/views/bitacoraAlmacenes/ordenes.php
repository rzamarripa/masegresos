<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'orden-compra-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'numeroOrdenCompra',
		'fecha_f',
		array('name'=>'proveedor_aid',
		        'value'=>'$data->proveedor->nombre',
			    'filter'=>CHtml::listData(Proveedor::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'unidadOrganizacional_aid',
		        'value'=>'$data->unidadOrganizacional->nombre',
			    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'requisicion_did',
		        'value'=>'$data->requisicion->nombre',
			    'filter'=>CHtml::listData(Requisicion::model()->findAll(), 'id', 'nombre'),),
		/*
		'subtotal',
		'iva',
		'total',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre'),),
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
