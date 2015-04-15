<?php 
	$this->pageCaption='Contrarecibos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
	
	$this->breadcrumbs=array(
	 'Contrarecibos'=>array('index'),
	  'Listar'
	);
	
	$this->menu=array(
	 array('label'=>'Crear Contrarecibos','url'=>array('create')),    
	 array('label'=>'Administrar Contrarecibos','url'=>array('admin')),	                
	);
	?>
	
	<?php $this->widget('bootstrap.widgets.TbListView',array(
	 'dataProvider'=>$dataProvider,
	 'headersview' =>'_headersview',
	 'footersview' => '_footersview',
	 'itemView'=>'_view',
	)); ?>