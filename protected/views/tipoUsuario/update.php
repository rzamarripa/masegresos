<?php
    $this->pageCaption='Tipos de Usuarios';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription='Actualizar';

    $this->breadcrumbs=array(
	    'Tipos de Usuarios'=>array('index'),
	    'Actualizar'
    );

    $this->menu=array(
	    array('label'=>'Listar Tipos de Usuarios','url'=>array('index')),
	    array('label'=>'Crear Tipo de Usuario','url'=>array('create')),
	    array('label'=>'Ver Tipo de Usuario','url'=>array('view','id'=>$model->id)),
	    array('label'=>'Administrar Tipos de Usuarios','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>