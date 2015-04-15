<?php
$this->breadcrumbs=array(
		'Motivo Bajas'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar MotivoBaja','url'=>array('index')),
	array('label'=>'Administrar MotivoBaja','url'=>array('admin')),
);
?>

<h1>Crear MotivoBaja</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>