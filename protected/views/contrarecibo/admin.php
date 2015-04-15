<?php
	$this->pageCaption='Contrarecibos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';
	
    $this->breadcrumbs=array(
	    'Contrarecibos',
	    'Administrar',
    );
    
    $this->menu=array(
  		array('label'=>'Volver','url'=>array('site/index')),
  		array('label'=>'Crear Contrarecibos','url'=>array('create')),
      array('label'=>'Imprimir Facturas Pendientes','url'=>array('facturaspendientes')),
      array('label'=>'Cancelar Facturas','url'=>array('cancelarfacturas')),
    );
        
    $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'contrarecibo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',		
		array('name'=>'proveedor_did',
		        'value'=>'$data->proveedor->nombre',
			    'filter'=>CHtml::listData(Proveedor::model()->findAll(), 'id', 'nombre'),),	
		array('name'=>'fecha_f',
                'value'=>'$data->fecha_f',
                'htmlOptions'=>array('class'=>'span2'),
        ),
        //array(
  //          'name' => 'fecha_f',
  //          'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
  //              'model'=>$model, 
  //              'attribute'=>'fecha_f', 
  //              'language' => 'es',
  //              'i18nScriptFile' => 'jquery.ui.datepicker-es.js',
  //              'htmlOptions' => array(
  //                  'id' => 'datepicker_for_due_date',
  //                  'size' => '10',
  //              ),
  //              'defaultOptions' => array(
  //                  'showOn' => 'focus', 
  //                  'dateFormat' => 'yy-mm-dd',
  //                  'showOtherMonths' => true,
  //                  'selectOtherMonths' => true,
  //                  'changeMonth' => true,
  //                  'changeYear' => true,
  //                  'showButtonPanel' => true,
  //              )
  //          ), 
  //          true),
  //      ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'Ver',
                ),
            ),
		),		
	),
	
)); 


Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
}
");
?>
