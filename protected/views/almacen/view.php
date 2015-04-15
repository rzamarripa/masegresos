<?php
$this->breadcrumbs=array(
	'Almacens'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Almacen','url'=>array('index')),
	array('label'=>'Crear Almacen','url'=>array('create')),
	array('label'=>'Actualizar Almacen','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar Almacen','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar Almacen','url'=>array('admin')),
);
?>

<h1>Ver Almacen #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'nombre',
		'direccion',
		'descripcion',
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
	),
)); ?>
