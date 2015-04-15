<?php
$this->breadcrumbs=array(
	'Motivo Bajas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar MotivoBaja','url'=>array('index')),
	array('label'=>'Crear MotivoBaja','url'=>array('create')),
	array('label'=>'Ver MotivoBaja','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar MotivoBaja','url'=>array('admin')),
);
?>

<h1>Actualizar MotivoBaja <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>