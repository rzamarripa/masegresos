<?php
	$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
	    'heading'=>'Bienvenido a egresos',
	)); 
?>
    <p>El Sistema consiste en simplificar el trabajo administrativo de las instituciones 
    educativas participantes, para el manejo y control de egresos.</p>
    <p><?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'info',
        'url'=>array('site/login'),
        'size'=>'large',
        'label'=>'Iniciar Sesión',
        'icon'=>'user white',
    )); ?></p>
 
<?php 
	$this->endWidget(); 	
	
	if(!isset($_SERVER["HTTP_REFERER"])){
?>
	<div class="row">
		<div class="span12" style="text-align:center">
			<h4>Aprenda como cotizar</h4>			
			<!-- <iframe width="640" height="480" src="//www.youtube.com/embed/zkxjEJubp4U" frameborder="0" allowfullscreen></iframe> -->
		</div>
	</div>

<?php } ?>

