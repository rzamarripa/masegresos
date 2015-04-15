<?php 
	$this->pageCaption='Escriba #';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='de Cheque';
		
	$this->breadcrumbs=array(
		'Contrarecibos'=>array('index'),
		'Listar'
	); 
   
   if($_GET["de"] == "prov") {
	   $this->menu=array(
			array('label'=>'Volver','url'=>array('verfacturasproveedor')),		
		);
   } else {
	   $this->menu=array(
			array('label'=>'Volver','url'=>array('verpasivogeneral')),		
		);
   }
	
	
?>

<div class="row">
	<div class="span12">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'cheque-form',
			'type'=>'horizontal',			
		)); ?> 
		<?php echo CHtml::Label("No. de Cheque",'noCheque'); ?>
		<?php echo CHtml::textField('noCheque', '', array('id'=>'noCheque', 'width'=>100, 'maxlength'=>100)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'info',
			'label'=>'Pagar',
		)); ?>
		<?php $this->endWidget(); ?>
	</div>
</div>