<div class="row" id="inventariosNormales">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td class="span1"><p class="text-center">Inventario</p></td>
					<td class="span4"><p class="text-center">Articulo</p></td>
					<td class="span2"><p class="text-center">Marca</p></td>
                    <td class="span2"><p class="text-center">Modelo</p></td>					
					<td class="span2"><p class="text-center">Serie</p></td>					
					<td class="span1"><p class="text-center"></p></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($inventariosNormales as $inventarioNormal) { ?>
					<tr>
						<td style='text-align:center;'><?php echo $inventarioNormal->id; ?></td>
						<td style='text-align:center;'><?php echo $inventarioNormal->articulo->nombre; ?></td>
						<td style='text-align:center;'><?php echo $inventarioNormal->marca->nombre; ?></td>
						<td style='text-align:center;'><?php echo $inventarioNormal->modelo; ?></td>
						<td style='text-align:center;'><?php echo $inventarioNormal->serie; ?></td>
						<td style='text-align:center;'>
							<?php $this->widget('bootstrap.widgets.TbButton', array(
          					'url'=>array('inventario/bajanormal','id'=>$inventarioNormal->id),
          					'label'=>'Baja',
          					'type'=>'danger', 
          					'size'=>'mini', 
               				)); ?>
							</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

