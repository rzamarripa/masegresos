<?php
	$this->pageCaption='Crear';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Proyecto';
    
	$this->breadcrumbs=array(
		'Proyectos'=>array('index'),
		'Crear',
	);

	$this->menu=array(
		array('label'=>'Listar Proyecto','url'=>array('index')),
		array('label'=>'Administrar Proyecto','url'=>array('admin')),
	);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>