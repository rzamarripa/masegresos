<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="clearfix">
		<?php echo $form->label($model,'id'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
		</div>
	</div> 


	<div class="clearfix">
		<?php echo $form->label($model,'codigo'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'codigo',array('size'=>20,'maxlength'=>20)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'nombre'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'unidad_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"unidad_did",CHtml::listData(Unidad::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
