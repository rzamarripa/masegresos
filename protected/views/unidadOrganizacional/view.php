<?php
$this->pageCaption='Unidad Organizacional';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Ver';

$this->breadcrumbs=array(
	'Unidad Organizacional'=>array('index'),
	'Ver'
);

$this->menu=array(
	array('label'=>'Listar UOs','url'=>array('index')),
	array('label'=>'Crear UO','url'=>array('create')),
	array('label'=>'Actualizar UO','url'=>array('update','id'=>$model->id)),
	array('label'=>'Eliminar UO','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	array('label'=>'Administrar UOs','url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'codigo',
		'nombre',
	),
)); ?>

<style type="text/css">
    #yw0 th{
        width:150px;
    }
</style>