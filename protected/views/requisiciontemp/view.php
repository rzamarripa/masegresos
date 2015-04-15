<?php
$this->pageCaption='Ver Requisicion Temp #'.$model->numero;
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='';
$this->breadcrumbs=array(
	'Requisiciones Temporales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Volver','url'=>array('index')),
	array('label'=>'Imprimir','url'=>array('imprimir','id'=>$model->id),'linkOptions' => array('target'=>'_blank')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'baseScriptUrl'=>false,
	'cssFile'=>false,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped'),
	'attributes'=>array(
		'id',
		'numero',
		array(	'name'=>'usuario_did',
			        'value'=>$model->usuario->usuario,),
		array(	'name'=>'estatus_did',
			        'value'=>$model->estatus->nombre,),
		array(	'name'=>'unidadOrganizacional_did',
			        'value'=>$model->unidadOrganizacional->nombre,),
	),
)); ?>

<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<td>Cant.</td>
			<td>Artículo</td>
			<td>Unidad</td>
			<td>Comentarios</td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$requisicionestempdetalle = Requisiciontempdetalle::model()->findAll("requisiciontemp_did = " . $_GET["id"]);
		foreach($requisicionestempdetalle as $reqtempdetalle){ ?>
		<tr>
			<td><?php echo $reqtempdetalle->cantidad;?></td>	
			<td><?php echo $reqtempdetalle->articulo;?></td>			
			<td><?php echo $reqtempdetalle->unidad->nombre;?></td>			
			<td><?php echo $reqtempdetalle->comentarios;?></td>			
		</tr>
		<?php } ?>
	</tbody>
</table>