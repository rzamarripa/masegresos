<?php
$this->breadcrumbs=array(
	'Archivos Proyectos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ArchivosProyecto','url'=>array('index')),
	array('label'=>'Crear ArchivosProyecto','url'=>array('create')),
	array('label'=>'Actualizar ArchivosProyecto','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar ArchivosProyecto','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar ArchivosProyecto','url'=>array('admin')),
);
?>

<h1>Ver ArchivosProyecto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array(	'name'=>'proyecto_aid',
			        'value'=>$model->proyecto->nombre,),
		'nombre',
		'ruta',
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
	),
)); ?>
