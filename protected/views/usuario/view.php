<?php
    $this->pageCaption='Usuarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Ver';

    $this->breadcrumbs=array(
	    'Usuarios'=>array('index'),
        'Ver'
    );

    $this->menu=array(
	    array('label'=>'Listar Usuarios','url'=>array('index')),
	    array('label'=>'Crear Usuario','url'=>array('create')),
	    array('label'=>'Actualizar Usuario','url'=>array('update','id'=>$model->id)),
	    array('label'=>'Eliminar Usuario','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	    array('label'=>'Administrar Usuarios','url'=>array('admin')),
    );

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'usuario',
		array(	'name'=>'tipoUsuario_did',
			        'value'=>$model->tipoUsuario->nombre,),
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
	),
)); ?>

<style type="text/css">
    #yw0 th{
        width:150px;
    }
</style>
