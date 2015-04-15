<?php
    $this->pageCaption='Orden Compra';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='por filtro';
    
        $this->breadcrumbs=array(
	        'Orden Compra'=>array('index'),
            'Por proveedor y UO'
        );
?>

    <script>
        $(document).ready(function() { 
        		$("#prov").select2(); 
        		$("#uo").select2();       		
        	});
    </script>
    <div class="row">
    	<div class="span12">
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'contrarecibo-form',
				'type'=>'horizontal',
				'enableAjaxValidation'=>true,		
			)); ?>
			<div style="margin-bottom:5px;">
			<select id="prov" style="width:400px;" name="proveedor">
				<?php 
					foreach($proveedores as $proveedor){
						echo '<option value="' . $proveedor["id"] . '">' . $proveedor["proveedor"] . '</option>';
					}
				?>        
			</select>

			<select id="uo" style="width:400px;" name="uo">
				<?php 
					foreach($uos as $uo){
						echo '<option value="' . $uo["id"] . '">' . $uo["nombre"] . '</option>';
					}
				?>        
			</select>
			</div>
			<div>
			<?php
		    	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		              'name'=>'fechaInicio',
		              'value'=>date('Y-m-d'),
		              'htmlOptions'=>array(  
		                  'id'=>'fechaInicio',
		              ),
		              'options'=>array(
		                  'dateFormat'=>'yy-mm-dd',               
		              )
		         ));?>
				<?php echo "a ";
		    	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		              'name'=>'fechaFin',
		              'value'=>date('Y-m-d'),
		              'htmlOptions'=>array(  
		                  'id'=>'fechaFin',
		              ),
		              'options'=>array(
		                  'dateFormat'=>'yy-mm-dd',               
		              )
		         ));
		    ?>
			<?php echo CHtml::ajaxSubmitButton(
			   					'Buscar',
									array('ordenCompra/porproveedoryuo', 'tipo'=>'Buscar'),
									array('update'=>'#ordenescompra'),
									array('id'=>'botonBuscar', 'class'=>'btn btn-info'));
									?>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div id="ordenescompra"></div>
		</div>
	</div>