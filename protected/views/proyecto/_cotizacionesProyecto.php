<table class="table table-striped table-bordered table-hover table-condensed">
	<thead class="thead">
		<tr>
			<td class="span1"><p class="text-center">No.</p></td>
			<td class="span1"><p class="text-center">Número Req.</p></td>
			<td ><p class="text-center">Cot. Proveedor</p></td>
			<td class="span1"><p class="text-center">Número Cot.</p></td>
			<td><p class="text-center">Fecha de Cotización</p></td>					
			<td><p class="text-center">Fecha Entrega</p></td>					
			<td><p class="text-center">Subtotal</p></td>
			<td><p class="text-center">IVA</p></td>
			<td><p class="text-center">Total</p></td>
			<td class="span2"></td>
			<td><p class="text-center">Estatus</p></td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$c = 0;
			$existeAceptada = 0;
			foreach($cotizaciones as $cotizacion1){
				if($cotizacion1->estatus_did == 4)
				{
					$existeAceptada = 1;
				}						
			}
		
			foreach($cotizaciones as $cotizacion){  $c++;
				
				if($c == 1)
					$color = "success";
				else if($c == count($cotizaciones))
					$color = "error";
				else
					$color = "warning";
				
			
		?>
		<tr class="<?php echo $color; ?>">
            <td><p class="text-center"><?php echo $c;?></p></td>                
            <td><p class="text-center"><?php echo $cotizacion->requisicion->numeroRequisicion; ?></p></td>
            <td><strong><?php echo $cotizacion->proveedor->nombre; ?></strong></td>
            <td><p class="text-center"><?php echo CHtml::link($cotizacion->numeroCotizacion,array('cotizacion/view', 'id' => $cotizacion->id, 'p' => $cotizacion->proyecto_aid));?></p></td>
            <td><p class="text-center"><?php echo $cotizacion->fecha_f;?></p></td>                
             <td><p class="text-center"><?php echo $cotizacion->fechaEntrega_f;?></p></td>                
            <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($cotizacion->subtotal); ?></p></td>
            <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($cotizacion->iva); ?></p></td>
            <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($cotizacion->total); ?></p></td>
            <td><p class="text-center">
            		<?php
						if($existeAceptada == 1)
						{
//								echo '<pre>';print_r($cotizacion->attributes); echo "</pre>";
							if($cotizacion->estatus_did == 4)
                			{
		                		$this->widget('bootstrap.widgets.TbButton', array(
								    'label'=>'Pendiente',
								    'type'=>'info',
								    'icon'=>'share white',
								    'size'=>'mini',
		                            'url'=>array('cotizacion/aceptar','id'=>$cotizacion->id, 'reqid'=>$cotizacion->requisicion_did, 
		                            													'provid'=>$cotizacion->proveedor_aid, 'tipoCambio' => 2),
								)); 
							}
							else
							{
								echo '<span class="label label-danger">Rechazada</span>';
							}
						}
						else
						{
							$this->widget('bootstrap.widgets.TbButton', array(
								    'label'=>'Aceptar',
								    'type'=>'info',
								    'icon'=>'ok white',
								    'size'=>'mini',
		                            'url'=>array('cotizacion/aceptar','id'=>$cotizacion->id, 'reqid'=>$cotizacion->requisicion_did, 
		                            				'provid'=>$cotizacion->proveedor_aid, 'tipoCambio' => 101),
							)); 
						}
            			
						
						?></p>
            </td>
            <td><p class="text-center"><?php echo $cotizacion->estatus->cotizacion;?></p></td>                
        </tr>
        <?php } ?>				
    </tbody>
</table>