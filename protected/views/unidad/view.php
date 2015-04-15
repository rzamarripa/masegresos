<?php
$this->pageCaption='Unidades';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Ver';

$this->breadcrumbs=array(
	'Unidades'=>array('index'),
	'Ver'
);

$this->menu=array(
	array('label'=>'Listar Unidades','url'=>array('index')),
	array('label'=>'Crear Unidad','url'=>array('create')),
	array('label'=>'Actualizar Unidad','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar Unidad','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar Unidades','url'=>array('admin')),
);
?>

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

<style type="text/css">
    #yw0 th{
        width:150px;
    }
</style>