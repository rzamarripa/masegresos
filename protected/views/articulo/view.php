<?php
	$this->pageCaption='Artículos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Ver';
	
    $this->breadcrumbs=array(
	    'Articulos'=>array('index'),
	    'Ver'
    );

    $this->menu=array(
	    array('label'=>'Listar Artículos','url'=>array('index')),
	    array('label'=>'Crear Artículo','url'=>array('create')),
	    array('label'=>'Actualizar Artículo','url'=>array('update','id'=>$model->id)),	
	    array('label'=>'Administrar Artículos','url'=>array('admin')),
    );

	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'codigo',
		'nombre',
        'unidad'
	),
)); 
?>

<style type="text/css">
    #yw0 th{
        width:150px;
    }
</style>