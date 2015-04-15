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
		<?php echo $form->label($model,'numeroRequisicion'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'numeroRequisicion',array('size'=>20,'maxlength'=>20)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fecha_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fecha_f!='') 
						$fecha_f=date('d-m-Y',strtotime($fecha_f));
					else
						$fecha_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fecha_f',
					                                       'value'=>$fecha_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fecha_f,
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
		<?php echo $form->label($model,'unidadOrganizacional_aid'); ?>
		<div class="input">
			
			<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
					      'model'=>$model, 
					      'attribute'=>'unidadOrganizacional_aid', 
					      'sourceUrl'=>Yii::app()->createUrl('unidadOrganizacional/autocompletesearch'), 
					      'showFKField'=>false,
					      'relName'=>'unidadOrganizacional', // the relation name defined above
					      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display

					      'options'=>array(
					          'minLength'=>1, 
					      ),
					 )); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'comentarios'); ?>
		<div class="input">
			
			<?php echo $form->textArea($model,'comentarios',array('rows'=>6, 'cols'=>50)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'director'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'director',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'titular'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'titular',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'recibio'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'recibio',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'entrego'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'entrego',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'estatus_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"estatus_did",CHtml::listData(Estatus::model()->findAll(), 'id', 'nombre')); ?>		</div>
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
