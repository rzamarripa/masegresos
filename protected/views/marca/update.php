<?php
$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Marca','url'=>array('index')),
	array('label'=>'Crear Marca','url'=>array('create')),
	array('label'=>'Ver Marca','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Marca','url'=>array('admin')),
);
?>

<h1>Actualizar Marca <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>