<?php
    $this->pageCaption='Inventario';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="";

    $this->breadcrumbs=array(
	    'Inventario'=>array('index')
    );

    $this->menu=array(
	    array('label'=>'Listar Inventario','url'=>array('index')),
	    array('label'=>'Crear Inventario','url'=>array('create')),
	    array('label'=>'Actualizar Inventario','url'=>array('update','id'=>$model->id)),
	    array('label'=>'Eliminar Inventario','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Estás seguro que quieres eliminar este elemento?')),
	    array('label'=>'Administrar Inventario','url'=>array('admin')),
    );
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
        array(	'name'=>'codigoInventario',
			        'value'=>$model->codigoInventario,),
		array(	'name'=>'unidadOrganizacional_aid',
			        'value'=>$model->unidadOrganizacional->nombre,),
		'numeroDocumento',
		'salidaResguardo',
	),
)); ?>