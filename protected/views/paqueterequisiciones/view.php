<?php
$this->pageCaption='Información del paquete: '.$model->nombre;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Paquete Requisiciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Volver','url'=>array('admin')),
	array('label'=>'Imprimir Relación','url'=>array('imprimirrelacion','id'=>$model->id),"linkOptions"=>array("target"=>"_blank")),
	array('label'=>'Imprimir todas las Requisiciones','url'=>array('imprimir','id'=>$model->id),"linkOptions"=>array("target"=>"_blank")),
);
$usuarioActual = Usuario::model()->obtenerUsuarioActual();
$c = 0;
?>
<h2><?php echo "Nombre: " . $model->nombre; ?></h2>
<?php if($usuarioActual->tipoUsuario->nombre == "Almacen"){
				if($model->estatus_did == 2){
?>
	<div class="pull-right">
		<?php echo CHtml::link('Devolver Paquete',array('paqueterequisiciones/cambiarestatus','id'=>$model->id, 'estatus'=>3),array("class"=>"btn btn-info")); ?>
	</div>
<?php 	}
			} ?>
<br/>
<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<td style="text-align:center">No.</td>
			<td>Número Req.</td>
			<td>Unidad Organizacional</td>
			<td>Proveedor</td>
			<td>Número OC</td>
			<td>Estatus</td>			
			<td>Acción</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($detalle as $d){ $c++; $ordenCompra = OrdenCompra::model()->find("requisicion_did = " . $d->requisicion_did); ?>
			<tr>
				<td style="text-align:center"><?php echo $c; ?></td>
				<td><?php echo CHtml::link($d->requisicion->numeroRequisicion,array("requisicion/view","id"=>$d->requisicion_did, "pr"=>$model->id));?></td>
				<td><?php echo $d->requisicion->unidadOrganizacional->nombre;?></td>
				<td><?php echo $ordenCompra->proveedor->nombre;?></td>
				<td><?php echo CHtml::link($ordenCompra->numeroOrdenCompra,array("ordenCompra/view","id"=>$ordenCompra->id, "pr"=>$model->id, 'alm'=>1));?></td>
					
				<?php // Si no se ha enviado a Almacén
							if($usuarioActual->tipoUsuario->nombre == "Almacen"){ 
								if($d->estatus_did == 1){ ?>
									<td><?php echo $d->estatus->paquetereqdetalle; ?></td>
									<td><?php echo CHtml::link('Devolver',array('paqueterequisicionesdetalle/cambiarestatus','id'=>$d->id, 'estatus'=>2),array("class"=>"btn btn-warning btn-mini")); ?></td>	
				<?php		}else if($d->estatus_did == 2){ ?>
									<td><?php echo $d->estatus->paquetereqdetalle; ?></td>
									<td><?php echo CHtml::link('Recuperar',array('paqueterequisicionesdetalle/cambiarestatus','id'=>$d->id, 'estatus'=>1),array("class"=>"btn btn-warning btn-mini")); ?></td>	
				<?php 	}else if($d->estatus_did == 3){ ?>
									<td><?php echo $d->estatus->paquetereqdetalle; ?></td>
									<td><?php echo "No hay"; ?></td>	
				<?php 	}
							}else if($usuarioActual->tipoUsuario->nombre == "Asistente2"){ 
								if($d->estatus_did == 1){ ?>
									<td><?php echo $d->estatus->paquetereqdetalle;?></td>
									<td><?php echo CHtml::link('Quitar',array('paqueterequisicionesdetalle/delete','id'=>$d->id),array("class"=>"btn btn-danger btn-mini")); ?></td>
				<?php		}
							} ?>
			</tr>
		<?php } ?>
	</tbody>
</table>