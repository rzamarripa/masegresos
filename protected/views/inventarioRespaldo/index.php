<?php
    $this->pageCaption='Inventario';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription="Listar";

$this->breadcrumbs=array(
	'Inventarios',
);

$this->menu=array(
	array('label'=>'Crear Inventario','url'=>array('create')),
	array('label'=>'Administrar Inventario','url'=>array('admin')),
);
?>
<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'headersview' =>'_headersview',
	'footersview' => '_footersview',
	'itemView'=>'_view',
)); ?>
