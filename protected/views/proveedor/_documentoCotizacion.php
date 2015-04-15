<?php 
    
    $this->widget('bootstrap.widgets.TbGridView',array(
	    'id'=>'documentoCotizacion-grid',
	    'dataProvider'=>$modelCotizacion->search($_GET['id']),
	    'filter'=>$modelCotizacion,
	    'columns'=>array(
		    'id',
            array(
                'name'=>'requisicion_did',
                'value'=>'CHtml::link($data->requisicion->numeroRequisicion,Yii::app()->createUrl("requisicion/view", array("id"=>$data->requisicion_did)))',
                'type'=>'raw',
                'htmlOptions'=>array('class'=>'span3'),
            ),
		    array(
                'name'=>'numeroCotizacion',
			    'header'=>'Cotización',
			    'type'=>'raw',
			    'value'=>'CHtml::link($data->numeroCotizacion,Yii::app()->createUrl("cotizacion/view", array("id"=>$data->id)))',
			    'htmlOptions'=>array('class'=>'span3'),                        
               ),
            array(
                    'name'=>'fecha_f',
                    'type'=>'raw',
                    'value'=>'$data["fecha_f"]',
            ),
            array(
                'name'=>'subtotal',
                'value'=>'$data->requisicion->unidadOrganizacional->nombre',
                'header'=>'Unidad Org',
                'type'=>'raw',
                'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(array("order"=>"nombre")),"id","nombre"),
                
            ),
		    array(
                'name'=>'total',
                'value'=>'Cotizacion::model()->formatCurrency($data->total)',
                'type'=>'raw',
            ),
        )
    ));
?>

<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) { //save the latest tab; use cookies if you like 'em better: 
				localStorage.setItem('documentoProveedor', $(e.target).attr('href')); 
		}); //go to the latest tab, if it exists: 
		 
		var documentoProveedor = localStorage.getItem('documentoProveedor'); 
		if (documentoProveedor) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + documentoProveedor +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(documentoProveedor).addClass('active');
		} 
	});
</script>