<?php
    $this->pageCaption='Inventario';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Actualizar';

    $this->breadcrumbs=array(
	    'Inventarios'=>array('index'),
	    'Actualizar',
    );

    $this->menu=array(
	    array('label'=>'Listar Inventario','url'=>array('index')),
	    array('label'=>'Crear Inventario','url'=>array('create')),
	    array('label'=>'Ver Inventario','url'=>array('view','id'=>$model->id)),
	    array('label'=>'Administrar Inventario','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model,'modelDetalle'=>$modelDetalle)); ?>