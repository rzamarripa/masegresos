<?php
    $this->pageCaption="Proveedor " . $id;
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='';
?>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  	<ul class="nav nav-tabs">
    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Cotizaciones</a></li>		
		<li><a href="#tab2" data-toggle="tab"><i class='icon-ok'></i> Órdenes de Compra</a></li>
		<li><a href="#tab3" data-toggle="tab"><i class='icon-ok'></i> Contrarecibos</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tab1">
			<?php $this->renderPartial("_documentoCotizacion",array('cotizaciones'=>$cotizaciones,'modelCotizacion'=>$modelCotizacion)); ?>
		</div>
		<div class="tab-pane" id="tab2">
			<?php $this->renderPartial("_documentoOrdenCompra",array('ordenesCompra'=>$ordenesCompra,'modelOrdenCompra'=>$modelOrdenCompra)); ?>
		</div>
		<div class="tab-pane" id="tab3">
			<?php $this->renderPartial("_documentoContrarecibo",array('contrarecibo'=>$contrarecibo,'modelContrarecibo'=>$modelContrarecibo)); ?>
		</div>
	</div>
</div>