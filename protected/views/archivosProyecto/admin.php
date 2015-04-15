<?php
$this->breadcrumbs=array(
	'Archivos Proyectos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar ArchivosProyecto','url'=>array('index')),
	array('label'=>'Crear ArchivosProyecto','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('archivos-proyecto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Archivos Proyectos</h1>

<p>
Opcionalmente puede usar operadores de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) al principio de cada criterio de búsqueda..
</p>

<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'archivos-proyecto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'proyecto_aid',
		        'value'=>'$data->proyecto->nombre',
			    'filter'=>CHtml::listData(Proyecto::model()->findAll(), 'id', 'nombre'),),
		'nombre',
		'ruta',
		'fechaCreacion_f',
		array('name'=>'estatus_did',
		        'value'=>'$data->estatus->nombre',
			    'filter'=>CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
