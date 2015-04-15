<?php
    $this->widget('bootstrap.widgets.TbGridView',array(
	    'id'=>'documentoContrarecibo-grid',
	    'dataProvider'=>$modelContrarecibo->buscar($_GET["id"]),
	    'filter'=>$modelContrarecibo,
	    'columns'=>array(
		    array(
                'name'=>'id',
                'value'=>'CHtml::link($data->id,Yii::app()->createUrl("contrarecibo/view", array("id"=>$data->id)))',
                'type'=>'raw',
                'htmlOptions'=>array('class'=>'span3'),
            ),
            'fecha_f',            
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