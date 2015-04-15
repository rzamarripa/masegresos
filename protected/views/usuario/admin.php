<?php
    $this->pageCaption='Usuarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Usuarios'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
	    array('label'=>'Listar Usuarios','url'=>array('index')),
	    array('label'=>'Crear Usuario','url'=>array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('usuario-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'usuario',
		array('name'=>'tipoUsuario_did',
		        'value'=>'$data->tipoUsuario->nombre',
			    'filter'=>CHtml::listData(TipoUsuario::model()->findAll(), 'id', 'nombre'),),
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll('nombre is not null'), 'id', 'nombre'),),
		'fechaCreacion_f',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
