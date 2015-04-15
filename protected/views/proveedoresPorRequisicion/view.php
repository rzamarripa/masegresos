<?php
$this->breadcrumbs=array(
	'Proveedores Por Requisicions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorRequisicion','url'=>array('index')),
	array('label'=>'Crear ProveedoresPorRequisicion','url'=>array('create')),
	array('label'=>'Actualizar ProveedoresPorRequisicion','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar ProveedoresPorRequisicion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar ProveedoresPorRequisicion','url'=>array('admin')),
);
?>

<h1>Ver ProveedoresPorRequisicion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		array(	'name'=>'requisicion_aid',
			        'value'=>$model->requisicion->nombre,),
		array(	'name'=>'proveedor_aid',
			        'value'=>$model->proveedor->nombre,),
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
	),
)); ?>
