<?php
$this->breadcrumbs=array(
	'Archivos Proyectos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ArchivosProyecto','url'=>array('index')),
	array('label'=>'Crear ArchivosProyecto','url'=>array('create')),
	array('label'=>'Ver ArchivosProyecto','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar ArchivosProyecto','url'=>array('admin')),
);
?>

<h1>Actualizar ArchivosProyecto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>