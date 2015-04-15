<?php
	$this->pageCaption='Cotizaciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Estatus';
	
	$this->breadcrumbs=array(
		'Cotizaciones',
        'Listar'
	);
	
	$requisiciones = Requisicion::model()->findAll(array('order'=>'numeroRequisicion ASC', 'condition'=>"proyecto_aid = 1"));
?>
<div class="row">
	<div class="span12">
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		  	<ul class="nav nav-tabs">
		    	<li><?php echo CHtml::link("<i class='icon-hand-left'></i> Volver",array('site/index')); ?></li>
		    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Pendientes</a></li>
				<li><a href="#tab2" data-toggle="tab"><i class='icon-cog'></i> Cerradas</a></li>		
			</ul>
			<div class="tab-content">
		    	<div class="tab-pane active" id="tab1">
					<?php $this->renderPartial("_requisicionesEnviadas",array('requisiciones'=>$requisiciones)); ?>
				</div>
				<div class="tab-pane" id="tab2">
					<?php $this->renderPartial("_requisicionesCerradas",array('requisiciones'=>$requisiciones)); ?>
				</div>				
			</div>
		</div>
	</div>
</div>
<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) { //save the latest tab; use cookies if you like 'em better: 
				localStorage.setItem('ultimoContenidoRequisicion', $(e.target).attr('href')); 
		}); //go to the latest tab, if it exists: 
		 
		var ultimoContenidoRequisicion = localStorage.getItem('ultimoContenidoRequisicion'); 
		if (ultimoContenidoRequisicion) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoRequisicion +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoRequisicion).addClass('active');
		} 
	});
</script>