<?php 
	$this->pageCaption='Órdenes de Compras';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
	
    $this->breadcrumbs=array(
		'Órdenes de Compras'=>array('index'),
        'Listar'
	); 
    
    $ordenesPendientes = OrdenCompra::model()->findAll("estatus_did = 1");
    $ordenesAgendadas = OrdenCompra::model()->findAll("estatus_did = 2");
    $ordenesPagadas = OrdenCompra::model()->findAll("estatus_did = 3");
    $ordenesCanceladas = OrdenCompra::model()->findAll("estatus_did = 4");
?>
<div class="row">
	<div class="span12">
		<div class="tabbable"> <!-- Only required for left/right tabs -->
  	<ul class="nav nav-tabs">
    	<li><?php echo CHtml::link("<i class='icon-hand-left'></i> Volver",array('ordenCompra/admin')); ?></li>
    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Pendientes</a></li>
    	<li><a href="#tab2" data-toggle="tab"><i class='icon-cog'></i> Agendadas</a></li>		
    	<li><a href="#tab3" data-toggle="tab"><i class='icon-ok'></i> Pagadas</a></li>		
    	<li><a href="#tab4" data-toggle="tab"><i class='icon-remove'></i> Canceladas</a></li>		
	</ul>
	<div class="tab-content">
    	<div class="tab-pane active" id="tab1">
			<?php $this->renderPartial("_ordenesPendientes",array('ordenesPendientes'=>$ordenesPendientes)); ?>
		</div>
		<div class="tab-pane" id="tab2">
			<?php $this->renderPartial("_ordenesAgendadas",array('ordenesAgendadas'=>$ordenesAgendadas)); ?>
		</div>
		<div class="tab-pane" id="tab3">
			<?php $this->renderPartial("_ordenesPagadas",array('ordenesPagadas'=>$ordenesPagadas)); ?>
		</div>
		<div class="tab-pane" id="tab4">
			<?php $this->renderPartial("_ordenesCanceladas",array('ordenesCanceladas'=>$ordenesCanceladas)); ?>
		</div>
	</div>
</div>
<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) {
				localStorage.setItem('ultimoContenidoOrdenCompra', $(e.target).attr('href')); 
		}); 
		 
		var ultimoContenidoOrdenCompra = localStorage.getItem('ultimoContenidoOrdenCompra'); 
		if (ultimoContenidoOrdenCompra) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoOrdenCompra +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoOrdenCompra).addClass('active');
		} 
	});
</script>