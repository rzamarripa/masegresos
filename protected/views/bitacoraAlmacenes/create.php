<?php
$this->breadcrumbs=array(
		'Bitacora Almacenes'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar BitacoraAlmacenes','url'=>array('index')),
	array('label'=>'Administrar BitacoraAlmacenes','url'=>array('admin')),
);
?>

<h1>Crear BitacoraAlmacenes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>