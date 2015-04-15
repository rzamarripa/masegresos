<?php
$this->pageCaption="Subir archivo";
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Detalle';

$this->breadcrumbs=array(
		'Archivos Proyectos',
		'Crear',
	);
if(isset($_GET["p"]))
	$this->menu=array(
		array('label'=>'Volver','url'=>array('proyecto/view','id'=>$_GET["p"])),
	);
else
	$this->menu=array(
		array('label'=>'Listar ArchivosProyecto','url'=>array('index')),
		array('label'=>'Administrar ArchivosProyecto','url'=>array('admin')),
	);

echo $this->renderPartial('_form', array('model'=>$model)); ?>