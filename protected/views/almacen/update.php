<?php
$this->breadcrumbs=array(
	'Almacens'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Almacen','url'=>array('index')),
	array('label'=>'Crear Almacen','url'=>array('create')),
	array('label'=>'Ver Almacen','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Almacen','url'=>array('admin')),
);
?>

<h1>Actualizar Almacen <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>