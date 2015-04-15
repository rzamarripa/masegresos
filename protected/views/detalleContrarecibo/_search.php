<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="clearfix">
		<?php echo $form->label($model,'id'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'id'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'idContrarecibo'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'idContrarecibo'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'idOrdenCompra'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'idOrdenCompra'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'numeroOrdenCompra'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'numeroOrdenCompra',array('size'=>45,'maxlength'=>45)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fechaOrdenCompra_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fechaOrdenCompra_f!='') 
						$fechaOrdenCompra_f=date('d-m-Y',strtotime($fechaOrdenCompra_f));
					else
						$fechaOrdenCompra_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fechaOrdenCompra_f',
					                                       'value'=>$fechaOrdenCompra_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fechaOrdenCompra_f,
					                                               'dateFormat'=>'yy-mm-dd',
					                                               'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
					                                               'buttonImageOnly'=>true,
					                                               'buttonText'=>'Fecha',
					                                               'selectOtherMonths'=>true,
					                                               'showAnim'=>'slide',
					                                               'showButtonPanel'=>true,
					                                               'showOn'=>'button',
					                                               'showOtherMonths'=>true,
					                                               'changeMonth' => 'true',
					                                               'changeYear' => 'true',
					                                               'minDate'=>"-70Y", //fecha minima
					                                               'maxDate'=> "+10Y", //fecha maxima
					                                       ),)); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'subtotal'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'subtotal',array('size'=>10,'maxlength'=>10)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'iva'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'iva',array('size'=>10,'maxlength'=>10)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'total'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'total',array('size'=>10,'maxlength'=>10)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'numeroFactura'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'numeroFactura',array('size'=>45,'maxlength'=>45)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fechaFactura_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fechaFactura_f!='') 
						$fechaFactura_f=date('d-m-Y',strtotime($fechaFactura_f));
					else
						$fechaFactura_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fechaFactura_f',
					                                       'value'=>$fechaFactura_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fechaFactura_f,
					                                               'dateFormat'=>'yy-mm-dd',
					                                               'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
					                                               'buttonImageOnly'=>true,
					                                               'buttonText'=>'Fecha',
					                                               'selectOtherMonths'=>true,
					                                               'showAnim'=>'slide',
					                                               'showButtonPanel'=>true,
					                                               'showOn'=>'button',
					                                               'showOtherMonths'=>true,
					                                               'changeMonth' => 'true',
					                                               'changeYear' => 'true',
					                                               'minDate'=>"-70Y", //fecha minima
					                                               'maxDate'=> "+10Y", //fecha maxima
					                                       ),)); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fechaCreacion_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fechaCreacion_f!='') 
						$fechaCreacion_f=date('d-m-Y',strtotime($fechaCreacion_f));
					else
						$fechaCreacion_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fechaCreacion_f',
					                                       'value'=>$fechaCreacion_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fechaCreacion_f,
					                                               'dateFormat'=>'yy-mm-dd',
					                                               'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
					                                               'buttonImageOnly'=>true,
					                                               'buttonText'=>'Fecha',
					                                               'selectOtherMonths'=>true,
					                                               'showAnim'=>'slide',
					                                               'showButtonPanel'=>true,
					                                               'showOn'=>'button',
					                                               'showOtherMonths'=>true,
					                                               'changeMonth' => 'true',
					                                               'changeYear' => 'true',
					                                               'minDate'=>"-70Y", //fecha minima
					                                               'maxDate'=> "+10Y", //fecha maxima
					                                       ),)); ?>		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
