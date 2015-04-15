<?php
$this->pageCaption='Ver Paqueterequisicionesdetalle #'.$model->id;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Paqueterequisicionesdetalle'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Paqueterequisicionesdetalle','url'=>array('index')),
	array('label'=>'Crear Paqueterequisicionesdetalle','url'=>array('create')),
	array('label'=>'Actualizar Paqueterequisicionesdetalle','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar Paqueterequisicionesdetalle','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar Paqueterequisicionesdetalle','url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array(	'name'=>'paqueteRequisicion_did',
			        'value'=>$model->paqueteRequisicion->nombre,),
		array(	'name'=>'requisicion_did',
			        'value'=>$model->requisicion->nombre,),
		array(	'name'=>'usuario_did',
			        'value'=>$model->usuario->nombre,),
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
	),
)); ?>
