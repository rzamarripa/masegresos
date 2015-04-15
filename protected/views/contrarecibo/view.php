<?php 
	$this->pageCaption='Contrarecibos';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Listar';
		
	$this->breadcrumbs=array(
		'Contrarecibos'=>array('index'),
		'Listar'
	); 

	$sumaIva = 0;
	$sumaSubTotal = 0;
	$sumaTotal = 0;
	$sumaTotalFactura = 0;
    
	$this->menu=array(
		array('label'=>'Volver','url'=>array('index')),
		array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)), 
		array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')), 
	);
	$detalleContrarecibo = DetalleContrarecibo::model()->findAll("contrarecibo_did = " . $model->id);
	$tipoUsuarioActual = Usuario::model()->obtenerTipoUsuarioActual();
?>

<div class="container">
	<div class="row">
		<div class="span12">
			<table class="table table-bordered table-condensed">
				<tr>
					<td class="span1"><strong>Contrarecibo</strong></td>
					<td><?php echo $model->id; ?></td>
					<td><strong>Fecha</strong> <?php echo $model->fecha_f;?></td>
				</tr>
				<tr>
					<td><strong>Proveedor</strong></td>
					<td colspan="3"><?php echo $model->proveedor->nombre; ?></td>
				</tr>				
			</table>
			<table class="table table-bordered table-condesed">
				<thead class="thead">
					<th  style="text-align:center";>Orden Compra</th>
					<th  style="text-align:center";>Fecha</th>
					<?php //<th  style="text-align:center";>Subtotal</th>?>
					<?php //<th  style="text-align:center";>I.V.A</th>?>
					<?php //<th  style="text-align:center";>Importe</th>?>
					<th  style="text-align:center";>No. Factura</th>
					<th  style="text-align:center";>F. Fact.</th>
					<th  style="text-align:center";>Total Fact.</th>
					<th  style="text-align:center";>Cheque</th>					
					<?php //<th  style="text-align:center";>Estatus</th>?>
					<th  style="text-align:center";>Acción</th>					
				</thead>
				<tbody>
				<?php foreach($detalleContrarecibo as $detalle){ 					
						if($detalle->estatus_did == 2){						
								$boton = "Pendiente";
								$clase = "warning";								
						} else {								
								$boton = "Pagar";
								$clase = "success";
						}						
						$sumaSubTotal += $detalle->subtotal;
						$sumaIva += $detalle->iva;
						$sumaTotal += $detalle->total;
						$sumaTotalFactura += $detalle->totalFactura;
					?>
					<tr>						
						<td style="text-align:center;"><?php echo $detalle->numeroOrdenCompra; ?></td>
						<td><?php echo $detalle->fechaOrdenCompra_f; ?></td>
						<?php /*<td style="text-align:right;"><?php echo '$' . number_format($detalle->subtotal,2); ?></td>
						<td style="text-align:right;"><?php echo '$' . number_format($detalle->iva,2); ?></td>
						<td style="text-align:right;"><?php echo '$' . number_format($detalle->total,2); ?></td>*/?>
						<td style="text-align:center;"><?php echo $detalle->numeroFactura; ?></td>
						<td><?php echo $detalle->fechaFactura_f; ?></td>
						<td style="text-align:right;"><?php echo '$' . number_format($detalle->totalFactura,2); ?></td>
						<td><?php echo $detalle->cheque; ?></td>						
						<td style="text-align:center;"><span class="label label-<?php echo ($detalle->estatus_did == 1) ? "warning" : "success" ?>"><?php echo $detalle->estatus->contrarecibo;?></span></td>						
						<?php /*<td style='text-align:center;'>
							<?php if($tipoUsuarioActual == "Pasivo"){ ?>
						    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'detalleContrarecibo'.$detalle->id)); ?>
	
								<div class="modal-header">
								    <a class="close" data-dismiss="modal">&times;</a>
								    <h4 class="lead"><strong><?php echo $detalle->contrarecibo->proveedor->nombre; ?></strong></h4>
								</div>
							 
								<div class="modal-body">
									<p class="text-center"><strong>Número de cheque</strong></p>
									<?php
										$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
										    'id'=>'horizontalForm',
										    'type'=>'horizontal',
										)); 
										echo $form->hiddenField($detalle,'id',array('value'=>$detalle->id)); 
										echo $form->hiddenField($detalle,'estatus_did',array('value'=>$detalle->estatus_did)); 
										if($detalle->estatus_did == 2)
											echo "Se eliminará el número de cheque";
										else
											echo CHtml::activeTextField($detalle,'cheque');
									?>
								</div>
							 
								<div class="modal-footer">
								    <?php $this->widget('bootstrap.widgets.TbButton', array(
								        'type'=>'info',
								        'label'=>'Aceptar',
								        'url'=>'#',
										'buttonType'=>'submit',
								    )); ?>
								    <?php $this->widget('bootstrap.widgets.TbButton', array(
								        'label'=>'Cerrar',
								        'url'=>'#',
								        'htmlOptions'=>array('data-dismiss'=>'modal'),
								    )); ?>
								</div>
							<?php $this->endWidget(); $this->endWidget(); 
								if($detalle->estatus_did == 1){
							?>
							<p class="text-center">
								<?php
									$this->widget('bootstrap.widgets.TbButton', array(
								    'label'=>$boton,
								    'type'=>$clase,
								    'icon'=>'file white',
								    'size'=>'',
								    'htmlOptions'=>array(
								        'data-toggle'=>'modal',
								        'data-target'=>'#detalleContrarecibo' . $detalle->id,
								    ),
								   ));
								}
								else
								{									
									$this->widget('bootstrap.widgets.TbButton', array(
								    'label'=>$boton,
								    'type'=>$clase,
								    'icon'=>'file white',
								    'size'=>'',
								    'htmlOptions'=>array(
								        'data-toggle'=>'modal',
								        'data-target'=>'#detalleContrarecibo' . $detalle->id,
								    ),
								));
								}?>
							</p>
						<?php } else { 
									if($detalle->estatus_did == 1){ ?>
									<span class="label label-warning">Pendiente</span>
						
						<?php		} else{ ?>
									<span class="label label-success">Pagada</span>
						<?php		} 
								} ?>	
						</td>*/?>	
					</tr>
				<?php } ?>
				<tr>
						<td colspan="2">
						<?php /*<td style="text-align:right"><?php echo "$" . number_format($sumaSubTotal, 2);?></td>
						<td style="text-align:right"><?php echo "$" . number_format($sumaIva, 2);?></td>
						<td style="text-align:right"><?php echo "$" . number_format($sumaTotal, 2);?></td>*/?>
						<td colspan="2"></td>
						<td style="text-align:right"><?php echo "$" . number_format($sumaTotalFactura, 2);?></td>
						<td colspan="3"></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>