<?php
$this->pageCaption='Adminsitrar ';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='paqueterequisicionesdetalle';
$this->breadcrumbs=array(
	'Paqueterequisicionesdetalle'=>array('index'),
	'Adminsitrar',
);

$this->menu=array(
	array('label'=>'Listar Paqueterequisicionesdetalle','url'=>array('index')),
	array('label'=>'Crear Paqueterequisicionesdetalle','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'paqueterequisicionesdetalle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'paqueteRequisicion_did',
			        'value'=>'$data->paqueteRequisicion->nombre',
				    'filter'=>CHtml::listData(PaqueteRequisicion::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'requisicion_did',
			        'value'=>'$data->requisicion->nombre',
				    'filter'=>CHtml::listData(Requisicion::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'usuario_did',
			        'value'=>'$data->usuario->nombre',
				    'filter'=>CHtml::listData(Usuario::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'estatus_did',
			        'value'=>'$data->estatus->nombre',
				    'filter'=>CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
