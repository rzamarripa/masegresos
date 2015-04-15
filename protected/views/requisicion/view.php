<?php
    $this->pageCaption='Requisiciones';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Ver';

    $proveedorActual = Proveedor::model()->obtenerProveedorActual();

    if(isset($_GET['origen'])=='proveedor'){

    } else {
        $this->breadcrumbs=array(
	        'Requisiciones'=>array('index'),
            'Ver'
        );
    }
	$usuarioActual = Usuario::model()->obtenerUsuarioActual();
	if($usuarioActual->tipoUsuario->nombre == 'Director' || $usuarioActual->tipoUsuario->nombre == 'Asistente1' || $usuarioActual->tipoUsuario->nombre == 'Asistente2')
	{
		if(isset($_GET["pr"])){
	  	$this->menu=array(
	  		array('label'=>'Volver','url'=>array('paqueterequisiciones/view','id'=>$_GET["pr"])),
		    array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
	    );
	  }	else{
		  $this->menu=array(
		    array('label'=>'Volver','url'=>array('index')),
		    array('label'=>'Actualizar','url'=>array('update','id'=>$model->id)),
		    array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id), 'linkOptions' => array('target'=>'_blank')),
		    array('label'=>'Cotizar','url'=>array('formcotproves','id'=>$model->id)),
		    array('label'=>'Seguimiento','url'=>array('seguimiento','id'=>$model->numeroRequisicion)),
	    );
	  }

	} else if ($usuarioActual->tipoUsuario->nombre == 'Proveedor'){
		$this->menu=array(
	    	array('label'=>'Volver','url'=>array('proveedor/dashboard','proveedorId'=>$proveedorActual->id)),
	    );
	} else if ($usuarioActual->tipoUsuario->nombre == 'Administrador'){
		$this->menu=array(
	    	array('label'=>'Volver','url'=>array('proyecto/view','id'=>$_GET["p"])),
	    );
	} else if ($usuarioActual->tipoUsuario->nombre == 'OrdenCompra'){
		$this->menu=array(
	    array('label'=>'Volver','url'=>array('requisicionesenviadas')),
    );
	} else if ($usuarioActual->tipoUsuario->nombre == 'Almacen'){
		$this->menu=array(
	    array('label'=>'Volver','url'=>array('paqueterequisiciones/view','id'=>$_GET["pr"])),
    );
  }

    $c=0;

?>
<div class="row">
	<div class="span7">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Unidad Org:</strong></td>
					<td class="span5"><?php echo $model->unidadOrganizacional->nombre; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="span5">
		<table class="table table-condensed table-bordered">
			<tbody>
				<tr>
					<td class="span2"><strong>Requisición</strong></td>
					<td class="span2"><?php echo $model->numeroRequisicion; ?></td>
				</tr>
				<tr>
					<td><strong>Fecha</strong></td>
					<td><?php echo $model->fecha_f; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php if(count($detalleRequisicion)>0){ ?>
<div class="row">
	<div class="span12">
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead class="thead">
				<tr>
					<td>No.</td>
					<td>Cantidad</td>
					<td>Artículo</td>
					<td>Observaciones</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalleRequisicion as $detalle){ $c++;?>
				<tr>
					<td><?php echo $c;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->articulo->nombre;?></td>
					<td><?php echo $detalle->observaciones;?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<table class="table table-bordered table-condensed">
			<tr>
				<td class="span2"><strong>Comentario</strong></td>
				<td><?php echo $model->comentarios; ?></td>
			</tr>
		</table>
	</div>
</div>
<?php }else{ echo "Esta requisición no tiene detalle"; }?>