<?php
    $this->breadcrumbs=array(
		'Jessika',
	);

    $proyectosPendientes = Yii::app()->db->createCommand('SELECT count(id) as total FROM Proyecto WHERE estatus_did = 1;')->queryRow();
    
	$proyectos = '
		<div class="alert alert-info">
			<h2>Proyectos</h2>
		</div>
		<ul>
			<li class="plan-feature">' . $proyectosPendientes["total"] . ' Pendientes</li>
			<li class="plan-feature">&nbsp;</li>
		</ul>
	';
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">
			<div class="span8 offset2 plan">
	  	      <?php echo CHtml::link($proyectos,array('proyecto/admin')); ?>
			</div>
		</div>
	</div>
</div>