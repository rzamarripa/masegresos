

<?php 

$this->pageCaption='Órdenes de compra';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='';

$this->menu=array(
		array('label'=>'Volver','url'=>array('site/index')),
	);


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'orden-compra-grid',
	'dataProvider'=>$model->searchalmacenista((isset($_GET["alm"]))? $_GET["alm"] : ""),
	'filter'=>$model,
	'columns'=>array(
		'numeroOrdenCompra',
		array('name'=>'cotizacion_did',
		        'value'=>'$data->cotizacion->fechaEntrega_f',),	
		array('name'=>'proveedor_aid',
		        'value'=>'$data->proveedor->nombre',
			    'filter'=>CHtml::listData(Proveedor::model()->findAll(array('order'=>'nombre ASC')), 'id', 'nombre'),),
		array('name'=>'unidadOrganizacional_aid',
		        'value'=>'$data->unidadOrganizacional->nombre',
			    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),),
		array('name'=>'requisicion_did',
		        'value'=>'$data->requisicion->numeroRequisicion',
			    'filter'=>CHtml::listData(Requisicion::model()->findAll(array('order'=>'numeroRequisicion asc','condition'=>'estatus_did = 4')), 'id', 'numeroRequisicion'),),
		array('name'=>'estatusAlmacen_did',
		        'value'=>'$data->estatusAlmacen->ordenCompraAlmacen',
			    'filter'=>CHtml::listData(Estatus::model()->findAll("ordenCompraAlmacen is not null"), 'id', 'ordenCompraAlmacen'),),
	    array(
	         //call the function 'renderButtons' from the current controller
	        'value'=>array($this,'renderButtons'),
	    ),
	    array(
	         //call the function 'renderButtons' from the current controller
	        'value'=>array($this,'comentarioAlmacenista'),
	    ),
	),
)); ?>
