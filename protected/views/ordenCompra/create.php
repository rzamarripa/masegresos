<?php
    $this->pageCaption='Órdenes de Compra';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Crear';

    $this->breadcrumbs=array(
		    'Órdenes de Compra'=>array('index'),
		    'Crear',
	    );

    $this->menu=array(
	    array('label'=>'Listar Órdenes de Compra','url'=>array('index')),
	    array('label'=>'Administrar Órdenes de Compra','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>