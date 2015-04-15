<?php
$this->pageCaption=$model->nombre;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Detalle';

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	$model->nombre,
);
?>

<?php $this->menu=array(
	array('label'=>'Volver', 'url'=>array('proyecto/admin')),	
	array('label'=>'Actualizar Proyecto', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Crear Requisición', 'url'=>array('requisicion/create','p'=>$model->id)),
	array('label'=>'Crear Contrarecibo', 'url'=>array('contrarecibo/create','p'=>$model->id)),
	array('label'=>'Subir Archivo', 'url'=>array('archivosproyecto/create','p'=>$model->id)),
); 
?>
<div class="row">
	<div class="span6">
	<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'baseScriptUrl'=>false,
			'cssFile'=>false,
			'htmlOptions'=>array('class'=>'table table-bordered table-striped table-condensed'),
			'attributes'=>array(
				'id',
				'nombre',
				'investigador',
				array('name'=>'unidadOrganizacional_aid',
					        'value'=>$model->unidadOrganizacional->nombre,),
				array('name'=>'estatus_did',
					        'value'=>$model->estatus->nombre,),
			),
		)); 
		$proveedores = Proveedor::model()->findAll('estatus_did = 1');
		$cotizaciones = Cotizacion::model()->findAll("estatus_did = 4 && proyecto_aid = " . $model->id);
		$ordenescompra = OrdenCompra::model()->findAll("proyecto_aid = " . $model->id);
	?>
	</div>
	<div class="span6">
		<div class="row">
			<div class="span2 well">
				<h5>Presupuesto sin aplicar</h5>
			</div>
			<div class="span2 well">
				<h5>Presupuesto aplicado</h5>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="span12">
		<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tableft1" data-toggle="tab">Requisiciones</a></li>
		    <li><a href="#tableft2" data-toggle="tab">Cotizaciones</a></li>
		    <li><a href="#tableft3" data-toggle="tab">Órdenes de Compra</a></li>
		    <li><a href="#tableft4" data-toggle="tab">Contrarecibos</a></li>
		    <li><a href="#tableft5" data-toggle="tab">Archivos</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tableft1">
		      <?php $this->renderPartial("_requisicionesProyecto",array("proveedores" => $proveedores)); ?>
		    </div>
		    <div class="tab-pane" id="tableft2">
		      <?php $this->renderPartial("_cotizacionesProyecto", array("cotizaciones" => $cotizaciones)); ?>
		    </div>
		    <div class="tab-pane" id="tableft3">
		      <?php $this->renderPartial("_ordenesProyecto", array("ordenes" => $ordenescompra)); ?>
		    </div>
		    <div class="tab-pane" id="tableft4">
		      <?php $this->renderPartial("_contrarecibosProyecto", array('id' => $model->id)); ?>
		    </div>
		    <div class="tab-pane" id="tableft5">
		      <?php $this->renderPartial("_archivosProyecto", array('id' => $model->id)); ?>
		    </div>
		  </div>
		</div>
	</div>
</div>

<script>
	$(function() 
	{ 
		$('a[data-toggle="tab"]').on('shown', function (e) { //save the latest tab; use cookies if you like 'em better: 
				localStorage.setItem('ultimoContenidoProyecto', $(e.target).attr('href')); 
		}); //go to the latest tab, if it exists: 
		 
		var ultimoContenidoProyecto = localStorage.getItem('ultimoContenidoProyecto'); 
		if (ultimoContenidoProyecto) { 
			$('ul.nav-tabs').children().removeClass('active');
			$('a[href="' + ultimoContenidoProyecto +'"]').tab('show');
			$('div.tab-content').children().removeClass('active');
			$(ultimoContenidoProyecto).addClass('active');
		} 
	});
</script>