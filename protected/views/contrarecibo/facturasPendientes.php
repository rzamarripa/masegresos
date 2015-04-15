<?php 
	$this->pageCaption='Facturas Pendientes';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Por Proveedor';
		
	$this->breadcrumbs=array(
		'Contrarecibos'=>array('index'),
		'Facturas Pendientes'
	); 

	$this->menu=array(
		array('label'=>'Volver','url'=>array('index')),		
	);
	$c=0;
?>

<div class="row">
	<div class="span12">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'contrarecibo-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>true,		
		)); ?>
		<select id="prov" style="width:400px;" name="proveedor">
			<?php 
				foreach($proveedores as $proveedor){
				 echo '<option value="' . $proveedor["id"] . '">' . $proveedor["proveedor"] . '</option>';
				}
			?>        
		</select>
		<?php echo CHtml::ajaxSubmitButton(
		   					'Ver Facturas Pendientes',
								array('contrarecibo/mostrarfacturaspendientes'),
								array('update'=>'#facturasPendientes'),
								array('id'=>'botonFacturasPendientes', 'class'=>'btn btn-info'));
								?>		
		<?php $this->endWidget(); ?>
	</div>
</div>
<div id="facturasPendientes"></div>	
	