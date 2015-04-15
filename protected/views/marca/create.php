<?php
$this->breadcrumbs=array(
		'Marcas'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar Marca','url'=>array('index')),
	array('label'=>'Administrar Marca','url'=>array('admin')),
);
?>

<h1>Crear Marca</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>