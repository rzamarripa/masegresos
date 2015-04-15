<?php
$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Marca','url'=>array('index')),
	array('label'=>'Crear Marca','url'=>array('create')),
	array('label'=>'Actualizar Marca','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar Marca','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar Marca','url'=>array('admin')),
);
?>

<h1>Ver Marca #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'marca',
		'nombre',
	),
)); ?>
