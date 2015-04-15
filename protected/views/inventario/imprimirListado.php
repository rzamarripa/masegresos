<?php
date_default_timezone_set("America/Mazatlan");
$this->pageCaption='Inventario';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='reporte';
$uos = UnidadOrganizacional::model()->findAll();
$nombreUo = array();
foreach($uos as $uo)
	array_push($nombreUo,$uo->id . "-" . $uo->nombre);
?>
<div class="row" style="text-align:center; padding-top:20px;">
	<div class="span12">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'inventario-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>true,
		));
		
		$this->widget('bootstrap.widgets.TbTypeahead', array(
		    'name'=>'inventario',
		    'options'=>array(
		        'source'=>$nombreUo,
		        'items'=>4,
		        'matcher'=>"js:function(item) {
		            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
		        }",
		    ),
		    'htmlOptions'=>array(			    	
		    	'style'=>'	width: 600px;
		    					onkeydown="return checkEnter(event);
		    					text-align:center;			    					
								padding-left: 20px;
								padding-right: 20px;
								height: 20px;
								font-size: 14pt;
								font-family: Arial, Helvetica, sans-serif;',
		    	'placeholder' => 'Unidad Organizacional',
		    	'autocomplete' => 'off',
		    	'required' => 'required',
		    ),
		));
		
		echo CHtml::ajaxSubmitButton(
		   'Buscar',
   			array('inventario/updateinventario'),
   			array('update'=>'#inventarios'),
   			array('id'=>'botonBuscar', 'class'=>'btn btn-primary'));
	
		?>
		
	</div>
	<input type="hidden" id="tipoReporte" name="tipoReporte" value="1" />
			<?php $this->endWidget(); ?>
</div>
<div class="row">
	<div id="inventarios" class="span12"></div>
</div>
