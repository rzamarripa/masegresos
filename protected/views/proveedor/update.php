<?php
    $this->pageCaption='Proveedores';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Actualizar";

    $this->breadcrumbs=array(
	    'Proveedores'=>array('index'),
	    'Actualizar',
    );

    $this->menu=array(
	    array('label'=>'Listar Proveedor','url'=>array('index')),
	    array('label'=>'Crear Proveedor','url'=>array('create')),
	    array('label'=>'Ver Proveedor','url'=>array('view','id'=>$model->id)),
	    array('label'=>'Administrar Proveedor','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>