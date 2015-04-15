<?php
date_default_timezone_set("America/Mazatlan");
$this->pageCaption='Inventario';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='reporte bajas';



 	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'inventario-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(			
            array('name'=>'id',
					'type'=> 'raw'
					,'value'=> 'CHtml::link($data->id, array("inventario/impresguardobaja/".$data->id), array("target"=>"_blank"))'
                    ,'htmlOptions'=>array('style'=>'text-align:center; width:100px;')
            ),
            array(
                'name'=>'autorizo_did',
                'value'=>'$data->autorizo->nombre',
                'filter'=>  CHtml::textField('autorizo->nombre',''),
                'htmlOptions'=>array('style'=>'text-align:center; width:200px;')
            ),	
			array('name'=>'unidadOrganizacional_did',
					'type' => 'raw',
			        'value'=> '$data->unidadOrganizacional->nombre',
					'filter'=>  CHtml::textField('unidadOrganizacional->nombre',''),
                    'htmlOptions'=>array(
                        'style'=>'width:400px;'
                    )
            ),
			 array('name'=>'fechaBaja_f',
					'type'=> 'raw',
					'value'=>'$data->fechaBaja_f',
                    'htmlOptions'=>array('style'=>'text-align:center; width:100px;')
            ),
		),
	)); ?>
