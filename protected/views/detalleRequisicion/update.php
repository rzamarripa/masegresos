<?php
$this->breadcrumbs=array(
	'Detalle Requisicions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar DetalleRequisicion','url'=>array('index')),
	array('label'=>'Crear DetalleRequisicion','url'=>array('create')),
	array('label'=>'Ver DetalleRequisicion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar DetalleRequisicion','url'=>array('admin')),
);
?>

<h1>Actualizar DetalleRequisicion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>