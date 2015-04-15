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
		<?php echo $form->label($model,'cantidad'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'cantidad'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'unidad_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"unidad_did",CHtml::listData(Unidad::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'articulo_aid'); ?>
		<div class="input">
			
			<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
					      'model'=>$model, 
					      'attribute'=>'articulo_aid', 
					      'sourceUrl'=>Yii::app()->createUrl('articulo/autocompletesearch'), 
					      'showFKField'=>false,
					      'relName'=>'articulo', // the relation name defined above
					      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display

					      'options'=>array(
					          'minLength'=>1, 
					      ),
					 )); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'observaciones'); ?>
		<div class="input">
			
			<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'requisicion_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"requisicion_did",CHtml::listData(Requisicion::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
