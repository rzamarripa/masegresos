<?php
	$inventario = '
		<div class="alert alert-info">
			<h2>Inventario</h2>
		</div>
		<ul>
			<li class="plan-feature">Lista de Resguardos</li>
			<li class="plan-feature">&nbsp;</li>
		</ul>
	';
?>
<div class="row">
	<div class="span12">
		<div class="row-fluid pricing-table pricing-three-column">			
	        <div class="span12 plan">
				<?php echo CHtml::link($inventario,array('inventario/index')); ?>
			</div>            
		</div>
	</div>
</div>