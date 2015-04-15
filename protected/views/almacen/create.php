<?php
$this->breadcrumbs=array(
		'Almacens'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar Almacen','url'=>array('index')),
	array('label'=>'Administrar Almacen','url'=>array('admin')),
);
?>

<h1>Crear Almacen</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>