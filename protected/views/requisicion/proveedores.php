<div class="row-fluid">
	<p class="text-center"><strong>Seleccione los proveedores</strong></p>
	<?php
	for($i=0; $i<=2; $i++){ ?>
		<div class="control-group">
			<?php echo CHtml::label('Proveedor #'.$i.'','Proveedor[proveedor'.$i.']',array('class'=>'control-label')); ?>
			<div class="controls">
				<div class="input-prepend"><?php
					$this->widget('bootstrap.widgets.TbTypeahead', array(
					    'name'=>'Proveedores[proveedor'.$i.']',
					    'options'=>array(
					        'source'=>$proveedores,
					        'items'=>4,
					    ),
					)); ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>