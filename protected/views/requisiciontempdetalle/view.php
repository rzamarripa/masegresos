<?php
$this->pageCaption='Ver Requisiciontempdetalle #'.$model->id;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Requisiciontempdetalle'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Requisiciontempdetalle','url'=>array('index')),
	array('label'=>'Crear Requisiciontempdetalle','url'=>array('create')),
	array('label'=>'Actualizar Requisiciontempdetalle','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar Requisiciontempdetalle','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar Requisiciontempdetalle','url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array(	'name'=>'requisicionTemp_did',
			        'value'=>$model->requisicionTemp->nombre,),
		'cantidad',
		'articulo',
		array(	'name'=>'unidad_did',
			        'value'=>$model->unidad->nombre,),
		array(	'name'=>'usuario_did',
			        'value'=>$model->usuario->nombre,),
	),
)); ?>
