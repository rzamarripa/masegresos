<?php
$this->breadcrumbs=array(
		'Proveedores Por Cotizacions'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorCotizacion','url'=>array('index')),
	array('label'=>'Administrar ProveedoresPorCotizacion','url'=>array('admin')),
);
?>

<h1>Crear ProveedoresPorCotizacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>