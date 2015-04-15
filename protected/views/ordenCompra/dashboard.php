<?php
   	$this->pageCaption='Órdenes de Compra';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='por estatus';
?>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  	<ul class="nav nav-tabs">
    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Pendientes</a></li>		
    	<li><a href="#tab4" data-toggle="tab"><i class='icon-ok'></i> Recibidas</a></li>
		<li><a href="#tab3" data-toggle="tab"><i class='icon-retweet'></i> Pagadas</a></li>		
	</ul>
	<div class="tab-content">
    	<div class="tab-pane active" id="tab1">
			<?php $this->renderPartial("_ordenesPendientes",array('ordenesPendientes'=>$ordenesPendientes)); ?>
		</div>
		<div class="tab-pane" id="tab3">
			<?php $this->renderPartial("_ordenesPagadas",array('ordenesPagadas'=>$ordenesPagadas)); ?>
		</div>
		<div class="tab-pane" id="tab4">
			<?php $this->renderPartial("_ordenesAgendadas",array('ordenesAgendadas'=>$ordenesAgendadas)); ?>
		</div>
	</div>
</div>

<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) { //save the latest tab; use cookies if you like 'em better: 
				localStorage.setItem('ultimoContenidoOrdenesDashboard', $(e.target).attr('href')); 
		}); //go to the latest tab, if it exists: 
		 
		var ultimoContenidoOrdenesDashboard = localStorage.getItem('ultimoContenidoOrdenesDashboard'); 
		if (ultimoContenidoOrdenesDashboard) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoOrdenesDashboard +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoOrdenesDashboard).addClass('active');
		} 
	});
</script>