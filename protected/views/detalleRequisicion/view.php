<?php
    $this->pageCaption='Detalle de Requisiciones';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription=$model->nombre;
    
    $this->breadcrumbs=array(
	    'Detalle Requisiciones'=>array('index'),
	    $model->id,
    );

    $this->menu=array(
	    array('label'=>'Listar Detalles','url'=>array('index')),
	    array('label'=>'Crear DetalleRequisicion','url'=>array('create')),
	    array('label'=>'Actualizar DetalleRequisicion','url'=>array('update','id'=>$model->id)),
	    array('label'=>'Eliminar DetalleRequisicion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	    array('label'=>'Administrar DetalleRequisicion','url'=>array('admin')),
    );
    
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'cantidad',
		array(	'name'=>'unidad_did',
			        'value'=>$model->unidad->nombre,),
		array(	'name'=>'articulo_aid',
			        'value'=>$model->articulo->nombre,),
		'observaciones',
		array(	'name'=>'requisicion_did',
			        'value'=>$model->requisicion->numeroRequisicion,),
	),
)); ?>
