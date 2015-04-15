<?php
    $this->pageCaption='Tipos de Usuarios';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Ver';

    $this->breadcrumbs=array(
	    'Tipos Usuarios'=>array('index'),
	    'Ver'
    );

    $this->menu=array(
	    array('label'=>'Listar Tipos de Usuarios','url'=>array('index')),
	    array('label'=>'Crear Tipo de Usuario','url'=>array('create')),
	    array('label'=>'Actualizar Tipo de Usuario','url'=>array('update','id'=>$model->id)),
	    array('label'=>'Eliminar Tipo de Usuario','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	    array('label'=>'Administrar Tipos de Usuarios','url'=>array('admin')),
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