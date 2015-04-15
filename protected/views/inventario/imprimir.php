<?php
date_default_timezone_set("America/Mazatlan");
$this->pageCaption='Inventario';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='reporte';



 	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'inventario-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(			
            array('name'=>'salidaResguardo',
					'type'=> 'raw'
					,'value'=> 'CHtml::link($data->salidaResguardo, array("inventario/impresguardo", "salidaRes"=>$data->salidaResguardo), array("target"=>"_blank"))'
                    ,'htmlOptions'=>array('style'=>'text-align:center; width:100px;')
            ),
            array(
                'name'=>'numeroDocumento'
                ,'value'=>'$data->numeroDocumento'
                ,'htmlOptions'=>array('style'=>'text-align:center; width:100px;')
            ),	
			array('name'=>'unidadOrganizacional_aid',
					'type' => 'raw',
			        'value'=> '$data->unidadOrganizacional->nombre',
					'filter'=>  CHtml::textField('unidadOrganizacional->nombre',''),
                    'htmlOptions'=>array(
                        'style'=>'width:500px;'
                    )
            ),
			array('name'=>'tipoDocumento_did',
			        'value'=>'$data->tipoDocumento->nombre',
				    'filter'=>CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Documento'"), 'id', 'nombre'),
            ),
			array('name'=>'origen_did',
			        'value'=>'$data->origen->nombre',
				    'filter'=>CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Origen'"), 'id', 'nombre'),
            ),
		),
	)); ?>
