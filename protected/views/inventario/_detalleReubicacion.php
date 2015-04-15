<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'detalle-inventario-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
    ));
?>
<div id='detalle'>
    <div class='row'>
        <div class='span12'>
	        <div class="<?php echo 'control-group'; ?>">
                <blockquote>
                <p><?php echo $modelDetail->inventario->unidadOrganizacional->nombre; ?></p>
                <small><cite title="Source Title"><?php echo $modelDetail->funcion->nombre; ?></cite></small>
                <small><cite title="Source Title"><?php echo $modelDetail->articulo->nombre; ?></cite></small>
                </blockquote>  
	        </div>
        </div>
    </div> 
</div> 
<?php $this->endWidget(); ?>