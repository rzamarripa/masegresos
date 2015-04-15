<?php
$this->pageCaption='Proyectos';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Filtrar';

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>"Volver",'url'=>array('site/index')),
	array('label'=>'Crear Proyecto','url'=>array('create')),
);

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'proyecto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'nombre',
			'type'=>'raw',
			'value'=>'CHtml::link($data->nombre,array("view","id"=>$data->id))'
		), 
		array('name'=>'unidadOrganizacional_aid',
		        'value'=>'$data->unidadOrganizacional->nombre',
			    'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(), 'id', 'nombre'),
		),
		'investigador',
		'fechaInicio_f',
		'fechaFin_f',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll("nombre is not null"), 'id', 'nombre'),),
		array
		(
		    'class'=>'TbButtonColumn',
		    'template'=>'{view} {update}',
		),
	),
)); 
?>