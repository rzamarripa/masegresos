<?php
	$this->pageCaption='Usuarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Crear';
	
	$this->breadcrumbs=array(
		'Usuarios'=>array('index'),
		'Crear',
	);

	$this->menu=array(
		array('label'=>'Listar Usuarios','url'=>array('index')),
		array('label'=>'Administrar Usuarios','url'=>array('admin')),
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>