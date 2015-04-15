<?php
$this->breadcrumbs=array(
	'Motivo Bajas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar MotivoBaja','url'=>array('index')),
	array('label'=>'Crear MotivoBaja','url'=>array('create')),
	array('label'=>'Actualizar MotivoBaja','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar MotivoBaja','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar MotivoBaja','url'=>array('admin')),
);
?>

<h1>Ver MotivoBaja #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'nombre',
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
	),
)); ?>
