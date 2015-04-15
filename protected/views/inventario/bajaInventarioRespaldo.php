<?php
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Bajas';
	
	$this->breadcrumbs=array(
			'Inventarios'=>array('index'),
			'Bajas',
	);
	
	$this->menu=array(
		array('label'=>'Listar Inventario','url'=>array('index')),
        array('label'=>'Crear Inventario','url'=>array('create')),
        array('label'=>'Reubicación de espacio','url'=>array('reubicacion')),
		array('label'=>'Administrar Inventario','url'=>array('admin')),
	);
	
 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'inventario-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13'),
)); ?>

<div class="row">
	<div class="span3">
		<div class="<?php echo 'control-group'; ?>">
			<?php echo $form->labelEx($model,'salidaResguardo',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'salidaResguardo',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($model,'salidaResguardo'); ?>
			</div>
		</div>
		<?php echo CHtml::ajaxSubmitButton(
		   					'Buscar',
   							array('inventario/bajaInventario'),
   							array('update'=>'#inventariosBaja'),
   							array('id'=>'botonBuscar', 'class'=>'btn btn-primary'));
   							?>
	</div>
</div>

<?php $this->endWidget(); ?>

<div class="row">
	<div id="inventariosBaja" class="span12"></div>
</div>