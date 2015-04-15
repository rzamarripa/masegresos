<?php 
	$this->pageCaption='Contrarecibos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Crear';
	
	$this->breadcrumbs=array(
			'Contrarecibos'=>array('index'),
			'Crear',
		);
	if(isset($_GET["p"]))
		$this->menu=array(
			array('label'=>'Volver','url'=>array('proyecto/view','id'=>$_GET["p"])),
		);
	else
		$this->menu=array(
            array('label'=>'Volver','url'=>array('site/index')),
			array('label'=>'Listar Contrarecibos','url'=>array('index'))
		);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'proveedores' => $proveedores)); ?>