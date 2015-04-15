<?php
	$this->pageCaption='Cotizaciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='por estatus';
?>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  	<ul class="nav nav-tabs">
    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Pendientes</a></li>
		<li><a href="#tab3" data-toggle="tab"><i class='icon-retweet'></i> Cotizadas</a></li>
		<li><a href="#tab4" data-toggle="tab"><i class='icon-ok'></i> Aceptadas</a></li>
		<li><a href="#tab5" data-toggle="tab"><i class='icon-trash'></i> Papelera reciclaje</a></li>
	</ul>
	<div class="tab-content">
    	<div class="tab-pane active" id="tab1">
			<?php $this->renderPartial("_cotizacionesPendientes",array('cotizacionesPendientes'=>$cotizacionesPendientes)); ?>
		</div>
		<div class="tab-pane" id="tab3">
			<?php $this->renderPartial("_cotizacionesCotizadas",array('cotizacionesCotizadas'=>$cotizacionesCotizadas)); ?>
		</div>
		<div class="tab-pane" id="tab4">
			<?php $this->renderPartial("_cotizacionesAceptadas",array('cotizacionesAceptadas'=>$cotizacionesAceptadas)); ?>
		</div>
		<div class="tab-pane" id="tab5">
			<?php $this->renderPartial("_cotizacionesPapelera",array('cotizacionesEliminadas'=>$cotizacionesEliminadas)); ?>
		</div>
	</div>
</div>

<script>
	$(function()
	{
		$('a[data-toggle="tab"]').on('shown', function (e) { //save the latest tab; use cookies if you like 'em better:
				localStorage.setItem('ultimoContenidoProveedorDashboard', $(e.target).attr('href'));
		}); //go to the latest tab, if it exists:

		var ultimoContenidoProveedorDashboard = localStorage.getItem('ultimoContenidoProveedorDashboard');
		if (ultimoContenidoProveedorDashboard) {
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoProveedorDashboard +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoProveedorDashboard).addClass('active');
		}
	});
</script>