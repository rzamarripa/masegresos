<?php
$this->breadcrumbs=array(
	'Actividads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Actividad','url'=>array('index')),
	array('label'=>'Crear Actividad','url'=>array('create')),
	array('label'=>'Ver Actividad','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Actividad','url'=>array('admin')),
);
?>

<h1>Actualizar Actividad <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>