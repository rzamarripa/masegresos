<?php
    $this->pageCaption='�rdenes de Compra';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Crear';

    $this->breadcrumbs=array(
		    '�rdenes de Compra'=>array('index'),
		    'Crear',
	    );

    $this->menu=array(
	    array('label'=>'Listar �rdenes de Compra','url'=>array('index')),
	    array('label'=>'Administrar �rdenes de Compra','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>