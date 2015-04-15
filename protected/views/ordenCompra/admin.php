<?php
    $this->pageCaption='Órdenes de Compra';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Administrar';

    $this->breadcrumbs=array(
	    'Órdenes de Compra'=>array('index'),
	    'Administrar',
    );

    $this->menu=array(
        array('label'=>'Volver','url'=>array('site/index')),
	    array('label'=>'Listar Órdenes de Compra','url'=>array('index')),
    );

    Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
	    $('.search-form').toggle();
	    return false;
    });
    $('.search-form form').submit(function(){
	    $.fn.yiiGridView.update('orden-compra-grid', {
		    data: $(this).serialize()
	    });
	    return false;
    });
    ");
?>

<div class="row" style="text-align:center; padding-top:20px;">
	<div class="span12">
	<?php
		 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'ordenCompra-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>true,
		));
	?>
		<table>
			<tr>
				<td>
					<?php echo CHtml::textField('ordenCompra', '',
									 array(
									       'width'=>100,
									       'maxlength'=>100,
									       'placeholder' => 'Número Orden de Compra',
									       'autocomplete'=>'off',)); ?>
				</td>
				<td>
					<?php
						echo CHtml::ajaxSubmitButton(
					   'Buscar',
			   			array('ordencompra/seguimientorapido'),
			   			array('update'=>'#ordenCompraAjax'),
			   			array('id'=>'botonBuscar', 'class'=>'btn btn-primary'));
					?>
				</td>
				<td>
					<?php
				   		echo CHtml::ajaxSubmitButton(
						   'Limpiar',
				   			array('ordencompra/limpiarseguimientorapido'),
				   			array('update'=>'#ordenCompraAjax'),
				   			array('id'=>'botonLimpiar', 'class'=>'btn btn-warning'));
					?>
				</td>
			</tr>
		</table>
		<?php $this->endWidget(); ?>
	</div>
</div>
<div id="ordenCompraAjax"></div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'orden-compra-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'numeroOrdenCompra',
		'fecha_f',
		array('name'=>'proveedor_aid',
		      'value'=>'$data->proveedor->nombre',
					'filter'=>CHtml::listData(Proveedor::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),
				 ),
		array('name'=>'unidadOrganizacional_aid',
		      'value'=>'$data->unidadOrganizacional->nombre',
					'filter'=>CHtml::listData(UnidadOrganizacional::model()->findAll(array('order'=>'nombre asc')), 'id', 'nombre'),
				 ),
		array('name'=>'requisicion_did',
		      'value'=>'$data->requisicion->numeroRequisicion',
					'filter'=>CHtml::listData(Requisicion::model()->findAll(array('order'=>'numeroRequisicion asc','condition'=>'estatus_did = 4')),'id', 'numeroRequisicion')
				 ),
		array('name'=>'estatus_did',
		      'value'=>'$data->estatus->ordenCompra',
					'filter'=>CHtml::listData(Estatus::model()->findAll('ordenCompra is not null'), 'id', 'ordenCompra')
				 ),
		array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{view}',
        'buttons'=>array(
	        'view'=>array(
	        	'label'=>'Ver',
	        ),
        ),
		),
	),
)); ?>
<script type="text/javascript">
	$("select").addClass("select2minimun4");
	$("select").css("width","150");
</script>
