<?php	
	$this->pageCaption='Pasivo por Proveedor';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Elija';
	
	$this->breadcrumbs=array(
	 'Contrarecibos'=>array('index'),
	  'Ver pasivos'
	);
	
	$this->menu=array(
		array('label'=>'Volver','url'=>array('contrarecibo/index')),		
	);	
	
?>
    
    <script>
        $(document).ready(function() { 
        		$("#prov").select2(); 
        		$('#prov').change(function(){        			        			
			  		$('#facturasporproveedor').fadeOut(500, function() {
				  		$('#facturasporproveedor').html('<span class="label">¿Qué quieres hacer con este proveedor?</span>');
				  		$('#facturasporproveedor').fadeIn(500);
				  	});
        		});
        		
        	});
    </script>
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
			   					'Pendientes',
									array('contrarecibo/verfacturasproveedor', 'tipo'=>'pendientes'),
									array('update'=>'#facturasporproveedor'),
									array('id'=>'botonPendientes', 'class'=>'btn btn-info'));
									?>
			<?php echo CHtml::ajaxSubmitButton(
			   					'Pagadas',
									array('contrarecibo/verfacturasproveedor', 'tipo'=>'pagadas'),
									array('update'=>'#facturasporproveedor'),
									array('id'=>'botonPagadas', 'class'=>'btn btn-success'));
									?>
			<?php echo CHtml::ajaxSubmitButton(
			   					'Ambas',
									array('contrarecibo/verfacturasproveedor','tipo'=>'ambos'),
									array('update'=>'#facturasporproveedor'),
									array('id'=>'botonAmbos', 'class'=>'btn btn-warning'));
									?>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div id="facturasporproveedor"></div>
		</div>
	</div>