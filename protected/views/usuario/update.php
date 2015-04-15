<?php
	$this->pageCaption='Usuarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Actualizar';
    
    $this->breadcrumbs=array(
	    'Usuarios'=>array('index'),
	    'Actualizar'
    );

    $this->menu=array(
	    array('label'=>'Listar Usuarios','url'=>array('index')),
	    array('label'=>'Crear Usuario','url'=>array('create')),
	    array('label'=>'Ver Usuario','url'=>array('view','id'=>$model->id)),
	    array('label'=>'Administrar Usuarios','url'=>array('admin')),
    );
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>