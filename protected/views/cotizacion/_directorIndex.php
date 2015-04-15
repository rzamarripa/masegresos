<?php
	$this->pageCaption='Cotizaciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
	
    $this->breadcrumbs=array(
		'Cotizaciones'=>array('index'),
        'Listar'
	);
	
    $this->menu=array(
		array('label'=>'Volver','url'=>array('site/index')),
        array('label'=>'Administrar Cotizaciones','url'=>array('admin')),
	);
    
	$cotizaciones = Cotizacion::model()->findAll();
	$requisiciones = Requisicion::model()->findAll();
	
?>
<div class="row">
	<div class="span12">
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		  	<ul class="nav nav-tabs">
		    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Pendientes</a></li>
				<li><a href="#tab2" data-toggle="tab"><i class='icon-ok'></i> Aceptadas</a></li>
				<li class="pull-right"><?php echo CHtml::link("Ir a órdenes de compra <i class='icon-hand-right'></i>",array('ordenCompra/index')); ?></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane" id="tab1">
					<?php $this->renderPartial("_cotizacionesPendientes",array('requisiciones'=>$requisiciones)); ?>
				</div>
				<div class="tab-pane" id="tab2">
					<?php $this->renderPartial("_cotizacionesAceptadas",array('cotizaciones'=>$cotizaciones)); ?>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) {
				localStorage.setItem('ultimoContenidoCotizacion', $(e.target).attr('href')); 
		}); 
		 
		var ultimoContenidoCotizacion = localStorage.getItem('ultimoContenidoCotizacion'); 
		if (ultimoContenidoCotizacion) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoCotizacion +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoCotizacion).addClass('active');
		} 
	});
</script>