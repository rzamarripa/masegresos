<?php
    $this->widget('bootstrap.widgets.TbGridView',array(
	    'id'=>'documentoOrdenCompra-grid',
	    'dataProvider'=>$modelOrdenCompra->searchDoctos($_GET['id']),
	    'filter'=>$modelOrdenCompra,
	    'columns'=>array(
		    array(
                'name'=>'numeroOrdenCompra',
                'value'=>'CHtml::link($data->numeroOrdenCompra,Yii::app()->createUrl("ordenCompra/view", array("id"=>$data->id)))',
                'type'=>'raw',
                'htmlOptions'=>array('class'=>'span3'),
            ),
            array(
                'name'=>'requisicion_did',
                'value'=>'CHtml::link($data->requisicion->numeroRequisicion,Yii::app()->createUrl("requisicion/view", array("id"=>$data->requisicion_did)))',
                'type'=>'raw',
                'htmlOptions'=>array('class'=>'span3'),
            ),
		    array(
                'name'=>'subtotal',
                'value'=>'Cotizacion::model()->formatCurrency($data->subtotal)',
                'type'=>'raw',
            ),
		    array(
                'name'=>'iva',
                'value'=>'Cotizacion::model()->formatCurrency($data->iva)',
                'type'=>'raw',
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