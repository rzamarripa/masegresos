<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'inventario-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>true,
	));?>
<div class="row" id="inventariosNormales">
	<div class="span12">
		<?php echo CHtml::label('Rango de Baja','',array('class'=>'control-label')); ?>
	</div>
	<div class="span12">
		<div class="span1">
			<?php echo CHtml::label('De','',array('class'=>'control-label')); ?>
			<input id='inventario' name='inventario' type='hidden' value=<?php echo $inventario->id ?>>
		</div>
		<div class="span3">			
			<?php echo $form->textField($modelDetalle,'numerico',array('id'=>'inicio', 'size'=>45,'maxlength'=>45)); ?>
		</div>
		<div class="span1">
			<?php echo CHtml::label('Hasta','',array('class'=>'control-label')); ?>
		</div>	
		<div class="span3">
			<?php echo CHtml::textField('final', '',
 			array('id'=>'final', 
       		'width'=>100, 
       		'maxlength'=>100)); ?>
		</div>
		<div class="span1">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'danger',
				'label'=>'Baja',
			)); ?>
		</div>
	</div>	
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p class="text-center">Inventario</p></td>
					<td class="span5"><p class="text-center">Articulo</p></td>
					<td class="span2"><p class="text-center">Marca</p></td>
                    <td class="span2"><p class="text-center">Modelo</p></td>					
					<td class="span2"><p class="text-center">Serie</p></td>					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($inventariosMultiples as $inventarioMultiple) { ?>
					<tr>
						<td style='text-align:center;'><?php echo $inventarioMultiple->id; ?></td>
						<td style='text-align:center;'><?php echo $inventarioMultiple->articulo->nombre; ?></td>
						<td style='text-align:center;'><?php echo $inventarioMultiple->marca->nombre; ?></td>
						<td style='text-align:center;'><?php echo $inventarioMultiple->modelo; ?></td>
						<td style='text-align:center;'><?php echo $inventarioMultiple->serie; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->endWidget(); ?> 