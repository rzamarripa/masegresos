<?php
$this->pageCaption='Requisiciones';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Agregar';
$this->breadcrumbs=array(
	'Paquetes Requisiciones'=>array('index'),
	'Agregar',
);
$this->menu=array(
	array('label'=>'Ver Paquetes','url'=>array('index')),
);

$c = 0;
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'paqueterequisiciones-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
	)); ?>
<h2><?php echo "Nombre del paquete: " . $paquete->nombre; ?></h2>
<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Crear Paquete',
	)); ?>
</div>
<table class="table table-striped table-bordered">
	<thead class="thead">	
		<tr>
			<td style="text-align:center">Sel.</td>
			<td>Número</td>
			<td>Unidad Organizacional</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($detallePaquetes as $detallePaquete){ $c++; ?>
		<tr>
			<td style="text-align:center"><?php echo CHtml::CheckBox("Requisiciones[".$c."]",false, array (
                                        'value'=>$detallePaquete->requisicion->numeroRequisicion,
                                        )); ?></td>
			<td><?php echo $detallePaquete->requisicion->numeroRequisicion;?></td>	
			<td><?php echo $detallePaquete->requisicion->unidadOrganizacional->nombre;?></td>			
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Crear Paquete',
	)); ?>
</div>

<?php $this->endWidget(); ?>