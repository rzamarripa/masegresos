<?php
$this->breadcrumbs=array(
	'Detalle Contrarecibos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar DetalleContrarecibo','url'=>array('index')),
	array('label'=>'Crear DetalleContrarecibo','url'=>array('create')),
	array('label'=>'Ver DetalleContrarecibo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar DetalleContrarecibo','url'=>array('admin')),
);
?>

<h1>Actualizar DetalleContrarecibo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>