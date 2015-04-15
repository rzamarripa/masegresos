<?php
$this->breadcrumbs=array(
		'Detalle Requisicions'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar DetalleRequisicion','url'=>array('index')),
	array('label'=>'Administrar DetalleRequisicion','url'=>array('admin')),
);
?>

<h1>Crear DetalleRequisicion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>