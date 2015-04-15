<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'inventario-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>false,
	));?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'danger',
				'label'=>'Baja',
			)); ?>
<div class="row" id="inventariosNormales">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p class="text-center">Inventario</p></td>
					<td class="span3"><p class="text-center">Articulo</p></td>
					<td class="span2"><p class="text-center">Marca</p></td>
                    <td class="span2"><p class="text-center">Modelo</p></td>					
					<td class="span1"><p class="text-center">Cantidad</p></td>
					<td class="span1"><p class="text-center">Existencia</p></td>
					<td class="span1"><p class="text-center"></p></td>					
					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($inventariosLotes as $inventarioLote) { ?>
					<tr>
						<td style='text-align:center;'><?php echo $inventarioLote->id; ?></td>
						<td style='text-align:center;'><?php echo $inventarioLote->articulo->nombre; ?></td>
						<td style='text-align:center;'><?php echo $inventarioLote->marca->nombre; ?></td>
						<td style='text-align:center;'><?php echo $inventarioLote->modelo; ?></td>
						<td style='text-align:center;'><?php echo $inventarioLote->cantidadPorLote; ?></td>
						<td style='text-align:center;'><?php echo $inventarioLote->cantidadPorLoteAct; ?></td>
						<td style='text-align:center;'>
							<?php echo CHtml::textField($inventarioLote->id, '0',
 								array('id'=>$inventarioLote->id, 
       							'style'=>'width:45px;padding:0px 0px;margin-bottom:0px;', 
       							'maxlength'=>15)); ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->endWidget(); ?> 