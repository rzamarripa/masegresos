<?php

	$this->pageCaption='Contrarecibo';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='';
	?>
	<div class="span3 text-center">
		<h4>Proveedores</h4>
		<div class="well" style="height:880px;overflow: auto;">		
			<?php 
				$this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'proveedorDeudad-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'type'=>'striped bordered condensed',
				'columns'=>array(
					'codigo',
					array(
			            'name'=>'nombre',
						'header'=>'Nombre',
						'type'=>'raw',
						'value'=>'CHtml::link($data["nombre"],Yii::app()->createUrl("proveedor/mostrardocumentos", array("id"=>$data["id"])))',
						'htmlOptions'=>array('class'=>'span10'),                        
			           ),
			           array(
			           			'header' => 'Cantidad',
			           			'name' => 'id',
					   			'type' => 'raw',
						        'value' => '$data->getDeuda($data["id"])',
						),					
				),
			)); ?>
		</div>
	</div>