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
		<?php echo $form->label($model,'tipoCaptura'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'tipoCaptura'); ?>
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
		<?php echo $form->label($model,'marca_aid'); ?>
		<div class="input">
			
			<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
					      'model'=>$model, 
					      'attribute'=>'marca_aid', 
					      'sourceUrl'=>Yii::app()->createUrl('marca/autocompletesearch'), 
					      'showFKField'=>false,
					      'relName'=>'marca', // the relation name defined above
					      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display

					      'options'=>array(
					          'minLength'=>1, 
					      ),
					 )); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'modelo'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'modelo',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'serie'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'serie',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'costoAdquisicion'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'costoAdquisicion'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'espacio_aid'); ?>
		<div class="input">
			
			<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
					      'model'=>$model, 
					      'attribute'=>'espacio_aid', 
					      'sourceUrl'=>Yii::app()->createUrl('espacio/autocompletesearch'), 
					      'showFKField'=>false,
					      'relName'=>'espacio', // the relation name defined above
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
		<?php echo $form->label($model,'cantidad'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'cantidad'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'cantidadPorLote'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'cantidadPorLote'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'lote'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'lote',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
