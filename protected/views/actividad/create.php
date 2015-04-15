<?php
$this->breadcrumbs=array(
		'Actividads'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar Actividad','url'=>array('index')),
	array('label'=>'Administrar Actividad','url'=>array('admin')),
);
?>

<h1>Crear Actividad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>