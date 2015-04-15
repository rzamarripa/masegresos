	<?php $reqTemp = RequisicionTemp::model()->find("id = " . $_GET["id"]); ?>
	<div class="row">
		<div class="span12 text-center">
			<h4>Requisición Temporal No. <?php echo $reqTemp->numero; ?></h4>
		</div>
	</div>
	<div class="row">
		<div class="span6">
			<table class="table table-striped table-bordered">
					<tr>
						<td><strong>Unidad Organizacional</strong></td>
						<td><?php echo $reqTemp->unidadOrganizacional->nombre; ?></td>
					</tr>
					<tr>
						<td><strong>Estatus</strong></td>
						<td><?php echo $reqTemp->estatus->requisicion; ?></td>
					</tr>
			</table>
		</div>
		<div class="span6">
			<table class="table table-striped table-bordered">
					<tr>
						<td><strong>Fecha</strong></td>
						<td><?php echo date("d-m-Y H:i:s", strtotime($reqTemp->fechaCreacion_f)); ?></td>
					</tr>
					<tr>
						<td><strong>Usuario</strong></td>
						<td><?php echo $reqTemp->usuario->usuario; ?></td>
					</tr>
			</table>
		</div>
	</div>



	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'requisiciontempdetalle-form',
		'type'=>'in-line',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array("class"=>"well")
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="span1">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'cantidad',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'cantidad',array('class'=>'span1')); ?>
					<?php echo $form->error($model,'cantidad'); ?>
					
				</div>
			</div>
		</div>
		<div class="span5">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'articulo',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'articulo',array('size'=>60,'maxlength'=>100,'class'=>'span5')); ?>
					<?php echo $form->error($model,'articulo'); ?>
					
				</div>
			</div>
		</div>
		<div class="span1">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'unidad_did',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend">
						<?php echo $form->dropDownList($model,'unidad_did',CHtml::listData(unidad::model()->findAll(), "id", "nombre"), array("empty"=>"Elija","class"=>"span1")); ?>			
						<?php echo $form->error($model,'unidad_did'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'comentarios',array('class'=>'control-label')); ?>
				<div class="controls">
					<div class="input-prepend"><?php echo $form->textArea($model,'comentarios',array('cols'=>60,"class"=>"span3")); ?>
					<?php echo $form->error($model,'comentarios'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="span1">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'icon'=>'plus white',
				'label'=>$model->isNewRecord ? 'Agregar' : 'Guardar',
				'htmlOptions'=>array("style"=>"margin-top:20px;")
			)); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<td>Cant.</td>
			<td>Artículo</td>
			<td>Unidad</td>
			<td>Comentarios</td>
			<td>Acción</td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$requisicionestempdetalle = Requisiciontempdetalle::model()->findAll("requisiciontemp_did = " . $_GET["id"]);
		foreach($requisicionestempdetalle as $reqtempdetalle){ ?>
		<tr>
			<td><?php echo $reqtempdetalle->cantidad;?></td>	
			<td><?php echo $reqtempdetalle->articulo;?></td>			
			<td><?php echo $reqtempdetalle->unidad->nombre;?></td>			
			<td><?php echo $reqtempdetalle->comentarios;?></td>
			<td><?php echo CHtml::link('Eliminar',array('delete','id'=>$reqtempdetalle->id),array("class"=>"btn btn-danger btn-mini")); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>