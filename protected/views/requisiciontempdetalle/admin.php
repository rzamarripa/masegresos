<?php
$this->pageCaption='Adminsitrar ';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='requisiciontempdetalle';
$this->breadcrumbs=array(
	'Requisiciontempdetalle'=>array('index'),
	'Adminsitrar',
);

$this->menu=array(
	array('label'=>'Listar Requisiciontempdetalle','url'=>array('index')),
	array('label'=>'Crear Requisiciontempdetalle','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'requisiciontempdetalle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'requisicionTemp_did',
			        'value'=>'$data->requisicionTemp->nombre',
				    'filter'=>CHtml::listData(RequisicionTemp::model()->findAll(), 'id', 'nombre'),),
		'cantidad',
		'articulo',
		array('name'=>'unidad_did',
			        'value'=>'$data->unidad->nombre',
				    'filter'=>CHtml::listData(Unidad::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'usuario_did',
			        'value'=>'$data->usuario->nombre',
				    'filter'=>CHtml::listData(Usuario::model()->findAll(), 'id', 'nombre'),),
		/*
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
