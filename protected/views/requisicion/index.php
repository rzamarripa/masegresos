<?php
	$this->pageCaption='Requisiciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';

	$this->breadcrumbs=array(
		'Requisiciones'=>array('index'),
        'Listar'
	);

	$this->menu=array(
		array('label'=>'Crear Requisición','url'=>array('create')),
		array('label'=>'Administrar Requisiciones','url'=>array('admin')),
	);

	$requisiciones = Requisicion::model()->findAll(array('order'=>'numeroRequisicion ASC', 'condition'=>"proyecto_aid = 1"));
?>

<div class="row" style="text-align:center; padding-top:20px;">
	<div class="span12">
	<?php
		 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'requisicion-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>true,
		));
	?>
		<table>
			<tr>
				<td>
					<?php echo CHtml::textField('requisicion', '',
									 array(
									       'width'=>100,
									       'maxlength'=>100,
									       'placeholder' => 'Número Requisición',
									       'autocomplete'=>'off',)); ?>
				</td>
				<td>
					<?php
						echo CHtml::ajaxSubmitButton(
					   'Buscar',
			   			array('requisicion/seguimientorapido'),
			   			array('update'=>'#requisicionAjax'),
			   			array('id'=>'botonBuscar', 'class'=>'btn btn-primary'));
					?>
				</td>
				<td>
					<?php
						echo CHtml::ajaxSubmitButton(
					   'Seguimiento',
			   			array('requisicion/seguimientocontrol'),
			   			array('update'=>'#requisicionAjax'),
			   			array('id'=>'botonControl', 'class'=>'btn btn-info'));
					?>
				</td>
				<td>
					<?php
			   		echo CHtml::ajaxSubmitButton(
					   'Limpiar',
			   			array('requisicion/limpiarseguimientorapido'),
			   			array('update'=>'#requisicionAjax'),
			   			array('id'=>'botonLimpiar', 'class'=>'btn btn-warning'));

						$this->endWidget();
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<div id="requisicionAjax"></div>
<?php /*
<div class="row">
	<div class="span12">
		<div class="tabbable">
		  	<ul class="nav nav-tabs">
		    	<li><?php echo CHtml::link("<i class='icon-hand-left'></i> Volver",array('site/index')); ?></li>
		    	<li class="active"><a href="#tab1" data-toggle="tab"><i class='icon-warning-sign'></i> Pendientes</a></li>
				<li><a href="#tab2" data-toggle="tab"><i class='icon-cog'></i> Enviadas</a></li>
				<li><a href="#tab4" data-toggle="tab"><i class='icon-resize-small'></i> Cerradas</a></li>
				<li><a href="#tab3" data-toggle="tab"><i class='icon-trash'></i> Papelera reciclaje</a></li>
				<li class="pull-right"><?php echo CHtml::link("Ir a cotizaciones <i class='icon-hand-right'></i>",array('cotizacion/index')); ?></li>
			</ul>
			<div class="tab-content">
		    	<div class="tab-pane active" id="tab1">
					<?php $this->renderPartial("_requisicionesPendientes",array('requisiciones'=>$requisiciones)); ?>
				</div>
				<div class="tab-pane" id="tab2">
					<?php $this->renderPartial("_requisicionesEnviadas",array('requisiciones'=>$requisiciones)); ?>
				</div>
				<div class="tab-pane" id="tab3">
					<?php //$this->renderPartial("_requisicionesPapelera",array('requisiciones'=>$requisiciones)); ?>
				</div>
				<div class="tab-pane" id="tab4">
					<?php //$this->renderPartial("_requisicionesCerradas",array('requisiciones'=>$requisiciones)); ?>
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
</script> */ ?>