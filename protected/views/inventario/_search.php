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
		<?php echo $form->label($model,'origen_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"origen_did",CHtml::listData(Origen::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'tipoDocumento_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"tipoDocumento_did",CHtml::listData(TipoDocumento::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'numeroDocumento'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'numeroDocumento',array('size'=>50,'maxlength'=>50)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'salidaResguardo'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'salidaResguardo',array('size'=>50,'maxlength'=>50)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'proveedor_aid'); ?>
		<div class="input">
			
			<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
					      'model'=>$model, 
					      'attribute'=>'proveedor_aid', 
					      'sourceUrl'=>Yii::app()->createUrl('proveedor/autocompletesearch'), 
					      'showFKField'=>false,
					      'relName'=>'proveedor', // the relation name defined above
					      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display

					      'options'=>array(
					          'minLength'=>1, 
					      ),
					 )); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fechaAdquisicion_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fechaAdquisicion_f!='') 
						$fechaAdquisicion_f=date('d-m-Y',strtotime($fechaAdquisicion_f));
					else
						$fechaAdquisicion_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fechaAdquisicion_f',
					                                       'value'=>$fechaAdquisicion_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fechaAdquisicion_f,
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
		<?php echo $form->label($model,'ejercicio'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'ejercicio',array('size'=>50,'maxlength'=>50)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fondo_aid'); ?>
		<div class="input">
			
			<?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
					      'model'=>$model, 
					      'attribute'=>'fondo_aid', 
					      'sourceUrl'=>Yii::app()->createUrl('fondo/autocompletesearch'), 
					      'showFKField'=>false,
					      'relName'=>'fondo', // the relation name defined above
					      'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display

					      'options'=>array(
					          'minLength'=>1, 
					      ),
					 )); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'autorizo'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'autorizo',array('size'=>60,'maxlength'=>200)); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fechaCaptura_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fechaCaptura_f!='') 
						$fechaCaptura_f=date('d-m-Y',strtotime($fechaCaptura_f));
					else
						$fechaCaptura_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fechaCaptura_f',
					                                       'value'=>$fechaCaptura_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fechaCaptura_f,
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
		<?php echo $form->label($model,'estatus'); ?>
		<div class="input">
			
			<?php echo $form->textField($model,'estatus'); ?>
		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'fechaBaja_f'); ?>
		<div class="input">
			
			<?php
					if ($model->fechaBaja_f!='') 
						$fechaBaja_f=date('d-m-Y',strtotime($fechaBaja_f));
					else
						$fechaBaja_f=date('d-m-Y');
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                                       'model'=>$model,
					                                       'attribute'=>'fechaBaja_f',
					                                       'value'=>$fechaBaja_f,
					                                       'language' => 'es',
					                                       'htmlOptions' => array('readonly'=>"readonly"),
					                                       'options'=>array(
					                                               'autoSize'=>true,
					                                               'defaultDate'=>$fechaBaja_f,
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
		<?php echo $form->label($model,'usuarioAlta_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"usuarioAlta_did",CHtml::listData(UsuarioAlta::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>


	<div class="clearfix">
		<?php echo $form->label($model,'usuarioBaja_did'); ?>
		<div class="input">
			
			<?php echo $form->dropDownList($model,"usuarioBaja_did",CHtml::listData(UsuarioBaja::model()->findAll(), 'id', 'nombre')); ?>		</div>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
