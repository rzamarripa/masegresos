<script src="../../themes/bootstrap/js/controllers/bajaInventario.js"></script>
<div ng-controller='BajaInventarioController'>
<?php
	
	$this->pageCaption='Inventario';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Baja';
		
	$this->breadcrumbs=array(
		'Inventario'=>array('index'),
		'Baja'
	); 
    
	$this->menu=array(
		array('label'=>'Volver','url'=>array('index')),
		array('label'=>'Crear Inventario','url'=>array('create')),
		array('label'=>'Listar Inventario','url'=>array('index')),
		array('label'=>'Reubicación de espacio','url'=>array('reubicacion')),		
		array('label'=>'Buscar Inventario','url'=>array('detalleInventario/admin')),
	);
	
	$usuarioActual = Usuario::model()->obtenerUsuarioActual();
?>
<div class="row">
	<div class="span12 well">
		<label style="width:160px;text-align:left;float:left" for="unidadOrganizacional">
			Autorizó:			
		</label>
		<span><strong><?php echo $usuarioActual->nombre; ?></strong></span>
		<br/><br/>
		<label style="width:160px;text-align:left;float:left" for="unidadOrganizacional">
			Unidad Organizacional:			
		</label>
		<?php	echo CHtml::dropDownList('unidadOrganizacional', 'unidadOrganizacional', 
              CHtml::listData(UnidadOrganizacional::model()->findAll(),"id","nombre"),
              array("class"=>"input-xxlarge select2", 'empty'=>''));
		?>
	</div>
</div>
<div class="row">
	<div class="span12">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
					'id'=>'bajaInventario-form',
					'type'=>'inline',
					'htmlOptions'=>array('class'=>'well'),
				));
		?>
		<div class="span10">
				<label style="width:150px;">
					<?php echo CHtml::CheckBox('checkMultiple',false) . ' Es múltiple';?> 
				</label>
		<?php	echo CHtml::textField('inventarioDe', '', array('id'=>'inventarioDe', 'class'=>'input-small', 'placeholder'=>'Desde', 'ng-model'=>'invInicio', 'ng-class'=>"{true: 'error', false: ''}[errorInicio]"));
				echo CHtml::textField('inventarioA', '', array('id'=>'inventarioA', 'class'=>'input-small', 'placeholder' =>'Hasta', 'disabled'=>'disabled', 'ng-model'=>'invFin', 'ng-class'=>"{true: 'error', false: ''}[errorFin]"));?>
				<label style="width:100px;text-align:right" for="motivoBaja">
					Motivo de baja: 
				</label>
		<?php	echo CHtml::dropDownList('motivoBaja', 'motivoBaja', 
              CHtml::listData(MotivoBaja::model()->findAll("estatus_did = 1"),"id","nombre"),
              array("class"=>"input-large select2",'empty'=>''));
		?>
		<a ng-click="agregar()" href="" class="btn btn-info" >Agregar</a>
		</div>
		<div class="span1">
			<input type="button" id="btnBaja" value="Baja" ng-click="baja()" href="" class="btn btn-danger" />
		</div>
		<?php	$this->endWidget(); ?>

	</div>
</div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'inventarioDetalle-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13', "target"=>"_blank"),
	)); ?>
	<input type="hidden" id="autorizo_did" name="autorizo_did" value="<?php echo $usuarioActual->id; ?>">
	<input type="hidden" id="uo_did" name="uo_did">
<div>
	<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Invantario</th>
							<th>Articulo</th>
							<th>Unidad Org.</th>
							<th>Lote</th>
							<th>Baja Lote</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(key, item) in inventarios">
							<td>									
								{{item.id}}
				     		</td>
				     		<td>
				     			{{item.nombre}}
				     		</td>
				     		<td>
				     			{{item.uo}}
				     		</td>
				     		<td style="text-align:center;">
					     		<div ng-switch on="item.lote">
					     			<div ng-switch-when="0">				     				
						     				
					 	    		</div>
					 	    		<div ng-switch-default>
					     					{{item.cantidadLote}}
					 	    		</div>
					 	    	</div>
					 	    </td>
				     		<td>
				     			<div ng-switch on="item.lote">
					     			<div ng-switch-when="0">				     				
						     				<input name="detalle[{{key}}][cantidadLoteBaja]" type="hidden" value="0" style='width:45px;padding:0px 0px;margin-bottom:0px;'/>
					 	    		</div>
					 	    		<div ng-switch-default>
					     					<input name="detalle[{{key}}][cantidadLoteBaja]" class="cantBaja" value="0" style='width:45px;padding:0px 0px;margin-bottom:0px;' />
					 	    		</div>
					 	    	</div>
				     		</td>
				     		<td>
				     			<button ng-click="cancelar(item, $event)" class="btn btn-mini btn-danger">Cancelar</button>
				     			<input name="detalle[{{key}}][id]" type="hidden" value="{{item.id}}" />
				     			<input name="detalle[{{key}}][lote]" type="hidden" value="{{item.lote}}" />
				     			<input name="detalle[{{key}}][motivoBaja]" type="hidden" value="{{item.motivoBaja}}" />
				     			<input name="detalle[{{key}}][cantLote]" type="hidden" value="{{item.cantidadLote}}" />
				     		</td>
				     	</tr>
				    </tbody>
				</table>				
</div>
<?php $this->endWidget(); ?>
</div>