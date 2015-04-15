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
		<?php echo $form->label($model,'precioUnitario'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'precioUnitario'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'importe'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'importe'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'ordenCompra_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"ordenCompra_did",CHtml::listData(OrdenCompra::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
