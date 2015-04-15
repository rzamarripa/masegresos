<?php
   	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Reubicación';

	$this->breadcrumbs=array(
			'Inventarios'=>array('index'),
			'Reubicación',
	);

	$this->menu=array(
    array('label'=>'Volver','url'=>array('index')),
    array('label'=>'Listar Inventario','url'=>array('index')),
    array('label'=>'Crear Inventario','url'=>array('create')),
    array('label'=>'Baja de Inventario','url'=>array('bajaInventario')),
    array('label'=>'Buscar Inventario','url'=>array('detalleInventario/admin')),
	);

    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    	'id'=>'inventario-form',
    	'type'=>'vertical',
    	'enableAjaxValidation'=>true,
    	'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13'),
        'clientOptions' => array('validateOnSubmit' => false),
        )
    );
?>

<div class="controls">
    <?php
        $this->widget('bootstrap.widgets.TbButtonGroup', array(
            'type' => 'primary',
            'toggle' => 'radio', // 'checkbox' or 'radio'
            'buttons' => array(
                 array( 'label'=>'Num Inventario',
                        'active' => true,
                        'htmlOptions' => array(
                            'id' => 'Reubicacion_tipoBusqueda_0',
                            "onClick"=>'
                                $("#Reubicacion_tipoBusqueda_0").click(function(){
                                    $("#bInventario").show();
                                    $("#bSerie").hide();
                                    $("#DetalleInventario_tipoBusqueda").val("bInventario");
                                });'
                        ),
                ),
                array(  'label'=>'Num Serie',
                        'htmlOptions' => array(
                            'id' => 'Reubicacion_tipoBusqueda_1',
                            "onClick"=>'
                                $("#Reubicacion_tipoBusqueda_1").click(function(){
                                    $("#bSerie").show();
                                    $("#bInventario").hide();
                                    $("#DetalleInventario_tipoBusqueda").val("bSerie");
                                });'
                        ),
                ),
            ),
        ));
    ?>

    <?php
        // la busqueda por default es por num de inventario.
        echo $form->hiddenField($modelDetail,'tipoBusqueda',array('value'=>'bInventario'));
    ?>
</div>
<br/>
<br/>
<br/>

<div class="row">
	<div class="span6">
		<div id="bInventario" class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($modelDetail,'id',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($modelDetail,'id',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelDetail,'id'); ?>

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                   //'buttonType'=>'submit',
                   'type'=>'info',
                   'label'=>"Buscar",
                   'htmlOptions'=>array(
                       'id'=>"buscando1",
                       'onClick'=>"$('#buscando1').click(function(){
                                        if($('#DetalleInventario_id').val() == ''){
                                            $('#msg1').show('slow').delay(3000).hide('slow');
                                        } else {
                                           $('#inventario-form').submit();
                                        }
                                    });"
                   ),
                  )); ?>
            </div>
        </div>
        <div id="bSerie" class="<?php echo 'control-group'; ?>" style="display:none;">
            <?php echo $form->labelEx($modelDetail,'serie',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($modelDetail,'serie',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($modelDetail,'serie'); ?>

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                   //'buttonType'=>'submit',
                   'type'=>'info',
                   'label'=>"Buscar",
                   'htmlOptions'=>array(
                       'id'=>"buscando2",
                       'class'=>'select2minimun4',
                       'onClick'=>"$('#buscando2').click(function(){
                                        if($('#DetalleInventario_serie').val() == ''){
                                            $('#msg2').show('slow').delay(3000).hide('slow');
                                        } else {
                                           $('#inventario-form').submit();
                                        }
                                    });"
                   ),
                  )); ?>
            </div>
        </div>

        <div id="msg1" class="info alert alert-warning" style="font-weight:bold; display: none;">
            Necesita introducir un número de inventario, verifique su información.
        </div>
        <div id="msg2" class="info alert alert-warning" style="font-weight:bold; display: none;">
            Necesita introducir un número de serie, verifique su información.
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>