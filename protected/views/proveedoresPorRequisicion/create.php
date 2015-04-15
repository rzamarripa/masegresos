<?php
$this->breadcrumbs=array(
		'Proveedores Por Requisicions'=>array('index'),
		'Crear',
	);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorRequisicion','url'=>array('index')),
	array('label'=>'Administrar ProveedoresPorRequisicion','url'=>array('admin')),
);
?>

<h1>Crear ProveedoresPorRequisicion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>