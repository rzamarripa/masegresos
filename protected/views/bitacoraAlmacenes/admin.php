<?php
$this->breadcrumbs=array(
	'Bitácora Almacenes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Volver','url'=>array('site/index')),
);


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bitacora-almacenes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'ordenCompra_did',
		        'value'=>'$data->ordenCompra->nombre',
			    'filter'=>CHtml::listData(OrdenCompra::model()->findAll(), 'id', 'numeroOrdenCompra'),),
		'recibioUO',
		'nombreRecibioUO',
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
)); ?>
