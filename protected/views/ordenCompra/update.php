<?php
$this->breadcrumbs=array(
	'Orden de Compra'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Ordenes de Compra','url'=>array('index')),
	array('label'=>'Crear Orden de Compra','url'=>array('create')),
	array('label'=>'Ver Orden de Compra','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Ordenes de Compra','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>