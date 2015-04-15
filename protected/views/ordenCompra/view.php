<?php
	$this->pageCaption='Órdenes de Compras';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Ver';



	$usuarioActual = Usuario::model()->obtenerUsuarioActual();
    if($usuarioActual->tipoUsuario->nombre == "Almacén"){
	    $this->menu=array(
		    array('label'=>'Listar Órdenes de Compras','url'=>array('adminalmacen','alm'=>$_GET["alm"]))
	    );
	  }else if(isset($_GET["pr"])){
	  	$this->menu=array(
	  		array('label'=>'Volver','url'=>array('paqueterequisiciones/view','id'=>$_GET["pr"])),
		    array('label'=>'Listar Órdenes de Compras','url'=>array('index')),
		    array('label'=>'Administrar Órdenes de Compras','url'=>array('admin')),
		    array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
	    );
    } else {
	    $this->menu=array(
		    array('label'=>'Listar Órdenes de Compras','url'=>array('index')),
		    array('label'=>'Administrar Órdenes de Compras','url'=>array('admin')),
		    array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
	    );
    }

	if($usuarioActual->tipoUsuario->nombre == 'Capturista')
	{
		$this->breadcrumbs=array(
			'Órdenes de Compra'=>array('index'),
			$model->id,
		);
		$this->menu=array(
			array('label'=>'Volver','url'=>array('site/index')),
			array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
		);
	}
	else if($usuarioActual->tipoUsuario->nombre == 'Proveedor')
	{
		$this->menu=array(
			array('label'=>'Volver','url'=>array('ordenCompra/dashboard','proveedorId' => $model->proveedor_aid)),
			array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
		);
	}
	else if($usuarioActual->tipoUsuario->nombre == 'Almacen')
	{
		$this->breadcrumbs=array(
			'Orden de Compra',
			$model->id,
		);
		if(isset($_GET["pr"])){
			$this->menu=array(
				array('label'=>'Volver','url'=>array('paqueterequisiciones/view','id'=>$_GET["pr"], 'alm' => $_GET["alm"])),
				array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
			);
		}else{
			$this->menu=array(
				array('label'=>'Volver','url'=>array('ordenCompra/adminalmacen','alm' => $_GET["alm"])),
				array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
			);
		}

	}
	else if($usuarioActual->tipoUsuario->nombre == 'Pasivo'){
		if($model->estatus_did == 4){
			$this->menu=array(
		    array('label'=>'Listar Órdenes de Compras','url'=>array('index')),
		    array('label'=>'Administrar Órdenes de Compras','url'=>array('admin')),
				array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
				array('label'=>'Recuperar','url'=>array('recuperar','id'=>$model->id)),
		);
		}else{
			$this->menu=array(
		    array('label'=>'Listar Órdenes de Compras','url'=>array('index')),
		    array('label'=>'Administrar Órdenes de Compras','url'=>array('admin')),
				array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
				array('label'=>'Cancelar','url'=>array('cancelar','id'=>$model->id)),
		);
		}

	}
	$detalleOrdenCompra = DetalleOrdenCompra::model()->findAll("ordenCompra_did = " . $model->id);

	if($usuarioActual->tipoUsuario->nombre == "Almacen"){
		$this->beginWidget('bootstrap.widgets.TbModal', array('htmlOptions'=>array('style'=>'width:700px;margin-left:-400px'),'id'=>'recibioUO' . $model->id));
?>
			<div class="modal-header">
			    <a class="close" data-dismiss="modal">&times;</a>
			    <h4 class="lead">Quién recibió en <strong><?php echo $model->unidadOrganizacional->nombre; ?></strong>?</h4>
			</div>
			<div class="modal-body">
				<p class="text-center"><strong>¿Quién recibió?</strong></p>
				<?php
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					    'id'=>'horizontalForm',
					    'type'=>'horizontal',
					));
				?>
				<div class="<?php echo 'control-group'; ?>">
					<div class="controls" style="text-align:right;padding-right:150px">
						UO
						<div class="input-prepend">
						<span class="add-on">Texto</span><?php echo CHtml::textField('RecibioUO', '',
															 array('id'=>'RecibioUO',
															       'width'=>100,
															       'maxlength'=>100)); ?>
						</div>

					</div>
				</div>
				<div class="<?php echo 'control-group'; ?>">
					<div class="controls" style="text-align:right;padding-right:150px">
						Almacén
						<div class="input-prepend">
						<span class="add-on">Texto</span><?php echo CHtml::textField('RecibioAlm', '',
															 array('id'=>'RecibioAlm',
															       'width'=>100,
															       'maxlength'=>100)); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			    <?php $this->widget('bootstrap.widgets.TbButton', array(
			        'type'=>'info',
			        'label'=>'Aceptar',
			        'url'=>array('#','alm'=>$_GET["alm"]),
					//'url'=>Yii::app()->createUrl('ordenCompra/view', array('alm' => $_GET["alm"],'tipo'=>3)),
					'buttonType'=>'submit',
			    )); ?>
			    <?php $this->widget('bootstrap.widgets.TbButton', array(
			        'label'=>'Cerrar',
			        'url'=>'#',
			        'htmlOptions'=>array('data-dismiss'=>'modal'),
			    )); ?>
			</div>
			<?php $this->endWidget();
		  $this->endWidget();
		  ////////////////////////////////////////////////////////////////////////////////////////////
		$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'recibioAL' . $model->id));
?>
			<div class="modal-header">
			    <a class="close" data-dismiss="modal">&times;</a>
			    <h4 class="lead">¿Quién recibió en Almacén?</h4>
			</div>

			<div class="modal-body">
				<p class="text-center"><strong>¿Quién recibió?</strong></p>
				<?php
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					    'id'=>'horizontalForm',
					    'type'=>'horizontal',
					));
				?>
				<div class="<?php echo 'control-group'; ?>">
					<div class="controls">
						<div class="input-prepend">
						<span class="add-on">Texto</span><?php echo CHtml::textField('RecibioAlm2', '',
															 array('id'=>'RecibioAlm2',
															       'width'=>100,
															       'maxlength'=>100)); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			    <?php $this->widget('bootstrap.widgets.TbButton', array(
			        'type'=>'info',
			        'label'=>'Aceptar',
			        'url'=>array('#','alm'=>$_GET["alm"]),
					'buttonType'=>'submit',
			    )); ?>
			    <?php $this->widget('bootstrap.widgets.TbButton', array(
			        'label'=>'Cerrar',
			        'url'=>'#',
			        'htmlOptions'=>array('data-dismiss'=>'modal'),
			    )); ?>
			</div>
			<?php $this->endWidget();
		$this->endWidget();

		////////////////////////////////////////////////////////////////////////////////////////////
		$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'salidaAL' . $model->id));
?>
		<div class="modal-header">
			    <a class="close" data-dismiss="modal">&times;</a>
			    <h4 class="lead">¿Quién dió Salida en Almacén?</h4>
			</div>

			<div class="modal-body">
				<p class="text-center"><strong>¿Quién dió Salida en Almacén?</strong></p>
				<?php
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					    'id'=>'horizontalForm',
					    'type'=>'horizontal',
					));
				?>
				<div class="<?php echo 'control-group'; ?>">
					<div class="controls">
						<div class="input-prepend">
						<span class="add-on">Texto</span><?php echo CHtml::textField('SalidaAlm', '',
															 array('id'=>'SalidaAlm',
															       'width'=>100,
															       'maxlength'=>100)); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			    <?php $this->widget('bootstrap.widgets.TbButton', array(
			        'type'=>'info',
			        'label'=>'Aceptar',
			        'url'=>array('#','alm'=>$_GET["alm"]),
					'buttonType'=>'submit',
			    )); ?>
			    <?php $this->widget('bootstrap.widgets.TbButton', array(
			        'label'=>'Cerrar',
			        'url'=>'#',
			        'htmlOptions'=>array('data-dismiss'=>'modal'),
			    )); ?>
			</div>

		<?php $this->endWidget();
		$this->endWidget();
?>





<div class="row">
	<div class="span12">
		<?php
		if($usuarioActual->tipoUsuario->nombre == 'Almacen')
		{
			$this->breadcrumbs=array(
				'Orden de Compra',
				$model->id,
			);
			if($model->estatusAlmacen_did == 1){
				$this->widget('bootstrap.widgets.TbButton', array(
					'url'=>array('ordenCompra/cambiarestatus','id' => $model->id, 'estatus' => 2, 'recibio' => 1, 'alm' => $_GET["alm"]),
					'label'=>'Recibí en Almacén',
					'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'size'=>'',
					'htmlOptions'=>array('data-toggle'=>'modal',
												'data-target'=>'#recibioAL' . $model->id), // null, 'large', 'small' or 'mini'
				));
				$this->widget('bootstrap.widgets.TbButton', array(
					'url'=>array('#'),
					'label'=>'Recibió la UO',
					'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'size'=>'',
					'htmlOptions'=>array('data-toggle'=>'modal',
												'data-target'=>'#recibioUO' . $model->id,
											), // null, 'large', 'small' or 'mini'
				));

			} else if($model->estatusAlmacen_did == 2){

				$this->widget('bootstrap.widgets.TbButton', array(
					'url'=>array('ordenCompra/cambiarestatus','id' => $model->id, 'estatus' => 4, 'alm' => $_GET["alm"]),
					'label'=>'No Recibir (Deshacer)',
					'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'size'=>'',
					'htmlOptions'=>array('onclick'=>'return confirm("¿Estás seguro de no recibir la mercancía?")'), // null, 'large', 'small' or 'mini'
				));

				$this->widget('bootstrap.widgets.TbButton', array(
					'url'=>array('#','id' => $model->id, 'estatus' => 3, 'recibio' => 2, 'alm' => $_GET["alm"]),
					'label'=>'Salida en Almacén',
					'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'size'=>'',
					'htmlOptions'=>array('data-toggle'=>'modal',
												'data-target'=>'#salidaAL' . $model->id), // null, 'large', 'small' or 'mini'
				));
			}/*
 else if($model->estatusAlmacen_did == 3){

				$this->widget('bootstrap.widgets.TbButton', array(
					'url'=>array('ordenCompra/cambiarestatus','id' => $model->id, 'estatus' => 2, 'alm' => $_GET["alm"]),
					'label'=>'No Salió (Deshacer)',
					'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'size'=>'',
					'htmlOptions'=>array('onclick'=>'return confirm("¿Estás seguro que no salió la mercancía?")'), // null, 'large', 'small' or 'mini'
				));
			}
*/
		}
		?>
	</div>
</div><br/>
<div class="row">
	<div class="span7">

		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Proveedor</strong></td>
					<td class="span5"><?php echo $model->proveedor->nombre; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php echo $model->proveedor->direccion; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Orden de Compra</strong></td>
					<td class="span2"><?php echo $model->numeroOrdenCompra; ?></td>
				</tr>
				<tr>
					<td><strong>Fecha</strong></td>
					<td><?php echo $model->fecha_f; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2">
						<strong>Unidad Organizacional</strong>
					</td>
					<td class="span9">
						<?php echo $model->unidadOrganizacional->nombre;?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<thead>
				<tr>
					<td style="text-align:center"><strong>Código</strong></td>
					<td style="text-align:center"><strong>Descripción</strong></td>
					<td style="text-align:center"><strong>Unidad</strong></td>
					<td style="text-align:center"><strong>Cantidad</strong></td>
					<td style="text-align:center"><strong>P. Unitario</strong></td>
					<td style="text-align:center"><strong>Total</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleOrdenCompra as $detalle){ ?>
				<tr>
					<td style="text-align:center"><?php echo $detalle->articulo->id; ?></td>
					<td><?php echo $detalle->articulo->nombre; ?></td>
					<td style="text-align:center"><?php echo $detalle->articulo->unidad; ?></td>
					<td style="text-align:center"><?php echo $detalle->cantidad; ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->precioUnitario); ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->importe); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span7"><strong>Cantidad con letra</strong><br><?php $this->widget('ext.numaletras.numerosALetras', array('valor'=>$model->total)); ?></td>
				</tr>
			</tbody>
		</table>
		<div class="text-center">
			<u><strong><?php echo $model->requisicion->director; ?></strong></u>
			<p class="small">DIRECTOR DE CONTROL DE BIENES E INVENTARIOS</p>
		</div>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Subtotal</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->subtotal); ?></td>
				</tr>
				<tr>
					<td class="span2"><strong>IVA</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->iva); ?></td>
				</tr>
				<tr>
					<td class="span2"><strong>Total</strong></td>
					<td style="text-align:right" class="span2"><?php echo Cotizacion::model()->formatCurrency($model->total); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php } else{ ?>
<div class="row">
	<div class="span7">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
							'url'=>array('imprimir','id'=>$model->id),
							'label'=>'Imprimir',
							'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'', // null, 'large', 'small' or 'mini'
							'htmlOptions' => array('target'=> '_blank'),
						)); ?><br/>
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Proveedor</strong></td>
					<td class="span5"><?php echo $model->proveedor->nombre; ?></td>
				</tr>
				<tr>
					<td><strong>Dirección</strong></td>
					<td><?php echo $model->proveedor->direccion; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="span4">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Orden de Compra</strong></td>
					<td class="span2"><?php echo $model->numeroOrdenCompra; ?></td>
				</tr>
				<tr>
					<td><strong>Fecha</strong></td>
					<td><?php echo $model->fecha_f; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2">
						<strong>Unidad Organizacional</strong>
					</td>
					<td class="span9">
						<?php echo $model->unidadOrganizacional->codigo . " - " . $model->unidadOrganizacional->nombre;?>
					</td>
				</tr>
				<tr>
					<td class="span2">
						<strong>Comentario Requisición</strong>
					</td>
					<td class="span9">
						<?php echo $model->requisicion->comentarios;?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row ">
	<div class="span11">
		<table class="table table-condensed table-bordered">
			<thead>
				<tr>
					<td style="text-align:center"><strong>Código</strong></td>
					<td style="text-align:center"><strong>Descripción</strong></td>
					<td style="text-align:center"><strong>Unidad</strong></td>
					<td style="text-align:center"><strong>Cantidad</strong></td>
					<td style="text-align:center"><strong>P. Unitario</strong></td>
					<td style="text-align:center"><strong>Total</strong></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleOrdenCompra as $detalle){ ?>
				<tr>
					<td style="text-align:center"><?php echo $detalle->articulo->codigo; ?></td>
					<td><?php echo $detalle->articulo->nombre; ?></td>
					<td style="text-align:center"><?php echo $detalle->articulo->unidad; ?></td>
					<td style="text-align:center"><?php echo $detalle->cantidad; ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->precioUnitario); ?></td>
					<td style="text-align:right"><?php echo Cotizacion::model()->formatCurrency($detalle->importe); ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php }

	if($usuarioActual->tipoUsuario->nombre == "Almacen" && $model->estatusAlmacen_did >= 2){
		$detalleBitacoras = BitacoraAlmacenes::model()->findAll("ordenCompra_did = :o", array(':o' =>$model->id));
		$b = 0;
		?>
		<hr>
		<div class="well">
			<h3>Historial de movimientos</h3>
			<table class="table table-striped table-bordered table-condensed">
				<thead class="thead">
					<tr>
						<td style="text-align:center">No.</td>
						<td style="text-align:center">Fecha Movimiento</td>
						<td style="text-align:center">Responsable</td>
						<td style="text-align:center">Tipo de Movimiento</td>
						<td style="text-align:center">Almacenista</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($detalleBitacoras as $detalleBit){ $b++; ?>
					<tr>
						<td style="text-align:center"><?php echo $b;?></td>
						<td style="text-align:center"><?php echo $detalleBit->fechaCreacion_f;?></td>
						<td style="text-align:center"><?php echo $detalleBit->usuario->usuario;?></td>
						<td style="text-align:center"><?php
								if($detalleBit->estatus_did == 1)
									echo '<span class="label label-success">' . $detalleBit->estatus->bitacora . '</span>';
								else if($detalleBit->estatus_did == 2)
									echo '<span class="label label-important">' . $detalleBit->estatus->bitacora . '</span>';
							?></td>
						<td style="text-align:left"><?php echo $detalleBit->nombreRecibioAlmacen;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
	<?php } ?>
	<hr>
	<?php
		if($usuarioActual->tipoUsuario->nombre == "Almacen"){ ?>
	<div class="row">
		<div class="span5 offset6 img-rounded" style="border: 1px solid #cecece">
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'orden-compra-form',
				'type'=>'horizontal',
				'enableAjaxValidation'=>false,
			)); ?>

			<?php echo $form->errorSummary($model); ?>

			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'comentarioAlmacenista',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
					<?php echo $form->textArea($model,'comentarioAlmacenista'); ?>
					<?php echo $form->error($model,'comentarioAlmacenista'); ?>
					</div>
				</div>
			</div>

			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'info',
					'label'=>$model->isNewRecord ? 'Comentar' : 'Guardar',
				)); ?>
			</div>

			<?php $this->endWidget(); ?>
		</div>
	</div>
	<?php } ?>