<?php
    $this->pageCaption='Proveedores';
        $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
        $this->pageDescription="Ver";
    
    $this->breadcrumbs=array(
	    'Proveedores'=>array('index'),
        'Ver'
    );

    $this->menu=array(
	    array('label'=>'Listar Proveedores','url'=>array('index')),
	    array('label'=>'Crear Proveedor','url'=>array('create')),
	    array('label'=>'Actualizar Proveedor','url'=>array('update','id'=>$model->id)),
	    array('label'=>'Administrar Proveedores','url'=>array('admin')),
    );
   
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
        'codigo',
		'nombre',
		'direccion',
		array('name'=>'estatus_did',
			    'value'=>$model->estatus->nombre,),
		'rfc',
	),
)); ?>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $model->usuario->usuario; ?></td>
			<td><?php echo CHtml::link('<i class="icon icon-lock icon-white"></i> Cambiar Contraseña',array('usuario/cambiar','id'=>$model->usuario->id), array('class'=>'btn btn-info')); ?></td>
		</tr>
	</tbody>
</table>

<style type="text/css">
    #yw0 th{
        width:150px;
    }
</style>
