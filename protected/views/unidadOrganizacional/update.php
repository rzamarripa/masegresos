<?php
    $this->pageCaption='Unidad Organizacional';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription='Actualizar';

    $this->breadcrumbs=array(
	    'Unidad Organizacional'=>array('index'),
	    'Actualizar',
    );

    $this->menu=array(
	    array('label'=>'Listar UOs','url'=>array('index')),
	    array('label'=>'Crear UO','url'=>array('create')),
	    array('label'=>'Ver UO','url'=>array('view','id'=>$model->id)),
	    array('label'=>'Administrar UOs','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>