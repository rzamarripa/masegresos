<?php
$this->breadcrumbs=array(
	'Bitacora Almacenes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar BitacoraAlmacenes','url'=>array('index')),
	array('label'=>'Crear BitacoraAlmacenes','url'=>array('create')),
	array('label'=>'Ver BitacoraAlmacenes','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar BitacoraAlmacenes','url'=>array('admin')),
);
?>

<h1>Actualizar BitacoraAlmacenes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>