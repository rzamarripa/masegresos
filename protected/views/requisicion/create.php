<?php
	if(isset($_GET["p"]) && !empty($_GET["p"]))
		$proyecto = Proyecto::model()->find("id = " . $_GET["p"]);
		
	$titulo = (isset($_GET["p"])) ? $proyecto->nombre : 'Requisición';
	$investigador = (isset($_GET["p"])) ? $proyecto->investigador : 'nueva';
	$this->pageCaption = $titulo;
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription = $investigador == 'nueva' ? 'Crear' : ' de ' . $investigador;
 	
	$this->breadcrumbs=array(
		'Requisiciones'=>array('index'),
		'Crear',
	);
	if(isset($_GET["p"]))
	{
		$this->menu=array(
			array('label'=>'Volver','url'=>array('proyecto/view','id'=>$_GET["p"])),
		);
	}
	else
	{
		$this->menu=array(
            array('label'=>'Volver','url'=>array('site/index')),
			array('label'=>'Listar Requisiciones','url'=>array('index')),
			array('label'=>'Administrar Requisiciones','url'=>array('admin')),
		);
	}
	
	
	if(isset($_GET["p"]))
		echo $this->renderPartial('_formProyecto', array('model'=>$model, 'proyecto' => $proyecto));
	else
		echo $this->renderPartial('_form', array('model'=>$model));
?>