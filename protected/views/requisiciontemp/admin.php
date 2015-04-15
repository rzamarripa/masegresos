<?php
$this->pageCaption='Adminsitrar ';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='requisiciontemp';
$this->breadcrumbs=array(
	'Requisiciontemp'=>array('index'),
	'Adminsitrar',
);

$this->menu=array(
	array('label'=>'Volver','url'=>array('index')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'requisiciontemp-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'numero',
		array('name'=>'usuario_did',
			        'value'=>'$data->usuario->usuario',
				    'filter'=>CHtml::listData(Usuario::model()->findAll("tipoUsuario_did != 9 && estatus_did = 1 && tipoUsuario_did != 1"), 'id', 'usuario'),),
		array('name'=>'estatus_did',
			        'value'=>'$data->estatus->nombre',
				    'filter'=>CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'unidadOrganizacional_did',
			        'value'=>'$data->unidadOrganizacional->nombre',
				    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
