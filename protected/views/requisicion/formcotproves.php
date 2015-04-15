<?php 
	$this->pageCaption='Mandar a cotizar';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription="la Req. " . $requisicion->numeroRequisicion;
	
	$this->breadcrumbs=array(
		'Requisiciones'=>array('index'),
        'Cotizar'
	);
	$proveedoresListos = array();
	
	foreach($proveedores as $proveedor){
	 	$proveedoresListos[]= trim($proveedor->codigo) . '-' . trim($proveedor->nombre);							 	
	}
	
?>
	
<div class="row">
	<div class="span6">
<?php
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>'cotizarForm',
	    'type'=>'horizontal',
	)); 

	echo $form->hiddenField($requisicion,'id',array('value'=>$requisicion->id)); 
	for($i=1; $i<=2; $i++){ ?>	
		<div class="control-group">
			<?php echo CHtml::label('Proveedor #'.$i,'Proveedores[proveedor'.$requisicion->id . $i.']',array('class'=>'control-label')); ?>
			<div class="controls">
				<div class="input-prepend"><?php
					$this->widget('bootstrap.widgets.TbTypeahead', array(
				    'name'=>'Proveedores[proveedor'.$requisicion->id . $i.']',
				    'options'=>array(
				        'source'=>$proveedoresListos,
				        'items'=>10,
				    ),
				    'htmlOptions'=>array(
				    		'autocomplete'=>'off',
				    ),
				)); ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="form-actions">		
		<?php 
			$this->widget('bootstrap.widgets.TbButton', array(
			  'type'=>'info',
			  'label'=>'Aceptar',
			  'url'=>'#',
			  'buttonType'=>'submit',
			)); 
			
			$this->widget('bootstrap.widgets.TbButton', array(
			  'type'=>'',
			  'label'=>'Cancelar',
			  'url'=>array("requisicion/index"),
			  'htmlOptions'=>array(
			  		"style"=>"margin-left:30px;"
			  )
			));
		?>
	</div>
<?php $this->endWidget(); ?>
	</div>
	
	<div class="span6">
		<dl class="dl-horizontal">
		  <dt>Unidad organizacional</dt>
		  <dd><?php echo $requisicion->unidadOrganizacional->nombre; ?></dd>
		  <dt>No. Req</dt>
		  <dd><?php echo $requisicion->numeroRequisicion; ?></dd>
		  <dt>Fecha</dt>
		  <dd><?php echo $requisicion->fecha_f; ?></dd>
		  <dt>Comentarios</dt>
		  <dd><?php echo $requisicion->comentarios; ?></dd>
		</dl>
	</div>
</div>