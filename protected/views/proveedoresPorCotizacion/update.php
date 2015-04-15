<?php
$this->breadcrumbs=array(
	'Proveedores Por Cotizacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorCotizacion','url'=>array('index')),
	array('label'=>'Crear ProveedoresPorCotizacion','url'=>array('create')),
	array('label'=>'Ver ProveedoresPorCotizacion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar ProveedoresPorCotizacion','url'=>array('admin')),
);
?>

<h1>Actualizar ProveedoresPorCotizacion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>