<?php
$this->breadcrumbs=array(
		'Detalle Inventarios'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar DetalleInventario','url'=>array('index')),
	array('label'=>'Administrar DetalleInventario','url'=>array('admin')),
);
?>

<h1>Crear DetalleInventario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>