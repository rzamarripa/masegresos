<?php	
	$this->pageCaption='Cotizaciones';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='de la Requisición de '. $cotizaciones[0]->requisicion->unidadOrganizacional->nombre;
	$tipoUsuarioActual = Usuario::model()->obtenerTipoUsuarioActual();
	if($tipoUsuarioActual == "Asistente1"){
								
	}else if($tipoUsuarioActual == "Asistente2"){
		$this->breadcrumbs=array(
		 'Requisiciones'=>array('requisicion/index'),
		 'Cotizaciones'=>array('cotizacion/index'),
		);
    }else if($tipoUsuarioActual == "OrdenCompra"){
	    $this->breadcrumbs=array(
		 'Requisiciones',
		 'Cotizaciones',
		);
    }
    if(isset($_GET["p"]))
	    $this->menu=array(
		    array('label'=>'Volver','url'=>array('proyecto/view','id' => $_GET["p"])),
	    );
	else if($tipoUsuarioActual == "OrdenCompra"){
		$this->menu=array(
		    array('label'=>'Volver','url'=>array('requisicion/requisicionesenviadas')),
	    );
	}
	else{
		$this->menu=array(
		    array('label'=>'Volver','url'=>array('requisicion/index')),
	    );
	}
		
    $c = 0;
    $existeAceptada = 0;
    
    $tipoUsuarioActual = Usuario::model()->obtenerTipoUsuarioActual();
    
?>
<div class="row">
	<div class="span12">
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
					<?php if($tipoUsuarioActual == "Asistente1"){
		                		
	                	}else if($tipoUsuarioActual == "Asistente2" || $tipoUsuarioActual == "OrdenCompra"){
							 	echo '<td class="span2"></td>';
							} ?>
					<td><p class="text-center">Estatus</p></td>
				</tr>
			</thead>
			<tbody>
				<?php 
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
	                <td><strong><?php echo CHtml::link($cotizacion->proveedor->nombre,array('cotizacion/view', 'id' => $cotizacion->id)); ?></strong></td>
	                <td><p class="text-center"><?php echo $cotizacion->numeroCotizacion;?></p></td>
	                <td><p class="text-center"><?php echo $cotizacion->fecha_f;?></p></td>                
	                <td><p class="text-center"><?php echo $cotizacion->fechaEntrega_f;?></p></td>                
	                <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($cotizacion->subtotal); ?></p></td>
	                <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($cotizacion->iva); ?></p></td>
	                <td><p class="text-right"><?php echo '$' . Cotizacion::model()->formatMoney($cotizacion->total); ?></p></td>
	                
						<?php
							if($tipoUsuarioActual == "Asistente1"){
								
							}else if($tipoUsuarioActual == "Asistente2" || $tipoUsuarioActual == "OrdenCompra"){
								echo '<td><p class="text-center">';
								if($existeAceptada == 1)
							{
								if($cotizacion->estatus_did == 4)
							 	{
							       	$this->widget('bootstrap.widgets.TbButton', array(
										'label'=>'Pendiente',
										'type'=>'info',
										'icon'=>'share white',
										'size'=>'mini',
							                    'url'=>'#',
							                    'htmlOptions'=>array(
							                        'data-toggle'=>'modal',
							                        'data-target'=>'#rechazarCotizacion'.$cotizacion->id,
										)
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
							                    'url'=>'#',
							                    'htmlOptions'=>array(
							                        'data-toggle'=>'modal',
							                        'data-target'=>'#aceptarCotizacion'.$cotizacion->id,
							                    ),
								)); 
							}
							echo '</p></td>';
							}
						
						?>
	                
	                <td><p class="text-center"><?php echo $cotizacion->estatus->cotizacion;?></p></td>                
					</tr>
					<?php 
                    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'aceptarCotizacion'.$cotizacion->id));?>
 
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">&times;</a>
                        <h4>Confirmación</h4>
                    </div>
 
                    <div class="modal-body">
                        <p>¿Está seguro de que desea aceptar esta cotización?</p>
                    </div>
 
                    <div class="modal-footer">
                        <?php 
                            echo CHtml::button('Aceptar', 
                            array('class'=>'btn btn-info',
                                'submit' => array('cotizacion/aceptar',
                                                        'id' => $cotizacion->id,
                                                        'reqid' => $cotizacion->requisicion_did,
                                                        'provid'=> $cotizacion->proveedor_aid,
                                                        'tipoCambio' => 101,
                                                        'p' => (isset($_GET["p"]))?$_GET["p"]:NULL)));
                        ?>
        
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label'=>'Cancelar',
                            'url'=>'#',
                            'htmlOptions'=>array('data-dismiss'=>'modal'),
                        )); ?>
                    </div>
    
                   <?php $this->endWidget();
                   
                   $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'rechazarCotizacion'.$cotizacion->id));?>
 
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">&times;</a>
                        <h4>Confirmación</h4>
                    </div>
 
                    <div class="modal-body">
                        <p>¿Está seguro de que desea rechazar esta cotización?</p>
                    </div>
 
                    <div class="modal-footer">
                        <?php 
                            echo CHtml::button('Aceptar', 
                            array('class'=>'btn btn-info',
                                'submit' => array('cotizacion/aceptar',
                                                        'id'=>$cotizacion->id,
                                                        'reqid'=>$cotizacion->requisicion_did,
                                                        'provid'=>$cotizacion->proveedor_aid,
                                                        'tipoCambio' => 2,
                                                        'p' => (isset($_GET["p"]))?$_GET["p"]:NULL)));
                        ?>
        
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label'=>'Cancelar',
                            'url'=>'#',
                            'htmlOptions'=>array('data-dismiss'=>'modal'),
                        )); ?>
                    </div>
    
                    <?php $this->endWidget();
                }
                ?>				
            </tbody>
        </table>
	</div>
</div>