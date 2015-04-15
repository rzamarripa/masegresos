<?php
$this->breadcrumbs=array(
		'Detalle Contrarecibos'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar DetalleContrarecibo','url'=>array('index')),
	array('label'=>'Administrar DetalleContrarecibo','url'=>array('admin')),
);
?>

<h1>Crear DetalleContrarecibo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>