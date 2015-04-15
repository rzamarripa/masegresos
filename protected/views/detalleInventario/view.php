<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Ver';
	
$this->breadcrumbs=array(
	'Detalle Inventarios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Inventario','url'=>array('inventario/index')),
	array('label'=>'Actualizar Inventario','url'=>array('update','id'=>$model->id)),
	array('label'=>'Buscar Inventario','url'=>array('admin')),
);

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array('name'=>'articulo_aid',
				'value'=>$model->articulo->nombre,),
		array('name'=>'unidadOrganizacional_did',
			   'value'=>$model->unidadOrganizacional->nombre,),
		array('name'=>'funcion_aid',
			   'value'=>$model->funcion->nombre,),
		array('name'=>'marca_aid',
			   'value'=>$model->marca->nombre,),
		'modelo',
		'serie',
		'costoAdquisicion',
		'observaciones',
	),
)); ?>
