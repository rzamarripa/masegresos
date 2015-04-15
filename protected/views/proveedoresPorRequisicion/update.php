<?php
$this->breadcrumbs=array(
	'Proveedores Por Requisicions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ProveedoresPorRequisicion','url'=>array('index')),
	array('label'=>'Crear ProveedoresPorRequisicion','url'=>array('create')),
	array('label'=>'Ver ProveedoresPorRequisicion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar ProveedoresPorRequisicion','url'=>array('admin')),
);
?>

<h1>Actualizar ProveedoresPorRequisicion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>