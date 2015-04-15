<?php
    $this->pageCaption='Inventarios';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="";

$this->breadcrumbs=array(
	'Inventario'=>array('index')
);

$this->menu=array(
	array('label'=>'Listar Inventario','url'=>array('index')),
	array('label'=>'Crear Inventario','url'=>array('create')),
	array('label'=>'Ver Inventario','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Inventario','url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>