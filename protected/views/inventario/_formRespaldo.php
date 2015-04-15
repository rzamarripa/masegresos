<script src="../../themes/bootstrap/js/controllers/inventario.js"></script>
<div ng-controller='InventarioController'>
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'inventario-form',
		'type'=>'vertical',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13'),
	));  ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'origen_did',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->dropDownList($model,'origen_did',CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Origen'"), "id", "nombre"), array('class'=>'input-large select2', )); ?>			
					<?php echo $form->error($model,'origen_did'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'tipoDocumento_did',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->dropDownList($model,'tipoDocumento_did',CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Documento'"), "id", "nombre"),array('class'=>'input-large select2')); ?>						
					<?php echo $form->error($model,'tipoDocumento_did'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'salidaResguardo',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'salidaResguardo',array('size'=>50,'maxlength'=>50, 'readonly' => 'readonly')); ?>
					<?php echo $form->error($model,'salidaResguardo'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'numeroDocumento',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'numeroDocumento',array('size'=>50,'maxlength'=>50)); ?>
					<?php echo $form->error($model,'numeroDocumento'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span6">
			<div class="control-group">
				<?php echo $form->labelEx($model,'proveedor_aid',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
					$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
				    'name'=>'Inventario[proveedor_aid]',
				    'id'=>'Inventario_proveedor_aid',
				    'htmlOptions'=>array(
				    	'class'=>'input-xxlarge'),
					));
					echo $form->error($model,'proveedor_aid'); ?>
				</div>
			</div>
		</div>
		<div class="span6">			
			<div class="control-group">
				<?php echo $form->labelEx($model,'unidadOrganizacional_aid',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
						$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
					    'name'=>'Inventario[unidadOrganizacional_aid]',
					    'id'=>'Inventario_unidadOrganizacional_aid',
					    'htmlOptions'=>array(
					    	'class'=>'input-xxlarge'),
						));
					echo $form->error($model,'unidadOrganizacional_aid'); ?>
				</div>
			</div>
		</div>		
	</div>
	<div class="row">
		<div class="span6">			
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'fondo_aid',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
						$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
					    'name'=>'Inventario[fondo_aid]',
					    'id'=>'Inventario_fondo_aid',
					    'htmlOptions'=>array(
					    	'class'=>'input-xxlarge'),
						)); 
					echo $form->error($model,'fondo_aid'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'ejercicio',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'ejercicio',array('size'=>50,'maxlength'=>50, 'value' => date("Y"))); ?>
					<?php echo $form->error($model,'ejercicio'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($model,'fechaAdquisicion_f',array('class'=>'control-label')); ?>
				<div class="controls">	
						<?php
						if ($model->fechaAdquisicion_f!='') 
							$model->fechaAdquisicion_f=date('d-m-Y',strtotime($model->fechaAdquisicion_f));
						    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'model'=>$model,
										'attribute'=>'fechaAdquisicion_f',
										'value'=>$model->fechaAdquisicion_f,
										'language' => 'es',
										'htmlOptions' => array('readonly'=>"", 'style'=>'width:65%;vertical-align:top', 'value' => date("Y-m-d")),
										'options'=> array(
										  'dateFormat'=>'yy-mm-dd', 
										  'altFormat'=>'dd-mm-yy', 
										  'changeMonth'=>'true', 
										  'changeYear'=>'true', 
										  'yearRange'=>'-10:+0', 
										  'showOn'=>'both',
										  'buttonText'=>'<i class="icon-calendar"></i>'
										),)); ?>			
						<?php echo $form->error($model,'fechaAdquisicion_f'); ?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php // Aquí estoy poniendo el detalle ?>
	<div class="row">
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'tipoCaptura',array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
		    			$this->widget('bootstrap.widgets.TbButtonGroup', array(
						    'type' => 'primary',
						    'toggle' => 'radio', // 'checkbox' or 'radio'
						    'buttons' => array(
						    	 array(	'label'=>'Normal', 
						        		'active' => true,
								        'htmlOptions' => array(
									        'id' => 'Inventario_tipoCaptura_0',
									        "onClick"=>'
										    	$("#Inventario_tipoCaptura_0").click(function(){
											        $("#CargaPorLotes").hide();
											        $("#CargaMultiple").hide();
		                                            $("#Inventario_lote").val("");
		                                            $("#Inventario_cantidadPorLote").val("");
											        $("#Inventario_tipoCaptura_2").removeClass("active");
											        $("#Inventario_tipoCaptura_1").removeClass("active");
											        $("#Inventario_tipoCaptura_0").addClass("active");
		                                            $("#Inventario_esLote").val(0);
		                                            $("#DetalleInventario_tipoCaptura").val("Normal");
											    });'
										),
								),
						        array(	'label'=>'Múltiple', 
								        'htmlOptions' => array(
									        'id' => 'Inventario_tipoCaptura_1',
									        "onClick"=>'
										    	$("#Inventario_tipoCaptura_1").click(function(){
											        $("#CargaPorLotes").hide();
											        $("#CargaMultiple").show();
		                                            $("#Inventario_lote").val("");
		                                            $("#Inventario_cantidadPorLote").val("");
											        $("#Inventario_tipoCaptura_2").removeClass("active");
											        $("#Inventario_tipoCaptura_1").addClass("active");
											        $("#Inventario_tipoCaptura_0").removeClass("active");
		                                            $("#Inventario_esLote").val(0);
		                                            $("#DetalleInventario_tipoCaptura").val("Multiple");
											    });'
										),
								),
								array(	'label'=>'Lote', 
								    	'htmlOptions' => array(
									        'id' => 'Inventario_tipoCaptura_2',
									        "onClick"=>'
										    	$("#Inventario_tipoCaptura_2").click(function(){
											        $("#CargaPorLotes").show();
											        $("#CargaMultiple").hide();
		                                            $("#Inventario_cantidad").val("");
											        $("#Inventario_tipoCaptura_2").addClass("active");
											        $("#Inventario_tipoCaptura_1").removeClass("active");
											        $("#Inventario_tipoCaptura_0").removeClass("active");
		                                            $("#Inventario_esLote").val(1);
		                                            $("#DetalleInventario_tipoCaptura").val("Lote");
											    });'
											),
									   ),       
								),    
						));
					?>
					<?php echo $form->hiddenField($modelDetalle,'tipoCaptura',array('value'=>'')); ?>
				</div>
			</div>
		</div>
		<div class="span9">
			<div class="row">
		        <div id="CargaMultiple" style="display:none;">
		            <div class="span9">
			            <div class="<?php echo 'control-group'; ?>">
				            <?php echo $form->labelEx($modelDetalle,'cantidad',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorCantidad]")); ?>
				            <div class="controls">
	                            <?php echo $form->textField($modelDetalle,'cantidad',array('size'=>10,'maxlength'=>10, 'ng-model' => 'detalle.cantidad')); ?>
				                <?php echo $form->error($modelDetalle,'cantidad'); ?>
				            </div>
			            </div>
		            </div>
		        </div>
		        <div id="CargaPorLotes" style="display:none;">
		            <div class="span3">
		                <div class="<?php echo 'control-group'; ?>">
				            <?php echo $form->labelEx($modelDetalle,'lote',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorLote]")); ?>
				            <div class="controls">
					            <div class="input-prepend">
		                            <?php echo $form->textField($modelDetalle,'lote',array('readonly' => 'readonly', 'size'=>50,'maxlength'=>50, 'ng-model' => 'detalle.lote')); ?>
					                <?php echo $form->error($modelDetalle,'lote'); ?>
					            </div>
				            </div>
		                </div>
		            </div>
		            <div class="span6">
		                <div class="<?php echo 'control-group'; ?>">
				            <?php echo $form->labelEx($modelDetalle,'cantidadPorLote',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorCantLote]")); ?>
				            <div class="controls">
					            <div class="input-prepend">
		                            <?php echo $form->textField($modelDetalle,'cantidadPorLote',array('size'=>50,'maxlength'=>50,'ng-model' => 'detalle.cantidadPorLote')); ?>
					                <?php echo $form->error($modelDetalle,'cantidadPorLote'); ?>
					            </div>
				            </div>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
	<input id="valorIva" name="valorIva" hidden value=<?php echo $configuraciones->iva; ?>>
	<div class="row">
		<div class="span4">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'articulo_aid',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorArticulo]")); ?>
				<div class="controls">
					<?php 
     				echo CHtml::CheckBox('chkArticulo', false, array('ng-model'=>'articulo'));
						$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
					    'name'=>'DetalleInventario[articulo_aid]',
					    'id'=>'DetalleInventario_articulo_aid',
					    'htmlOptions'=>array(
					    	'class'=>'input-xlarge',
					    	'ng-model' => 'detalle.articulo_aid'),
						));
						echo $form->error($modelDetalle,'articulo_aid'); ?>
				</div>
			</div>
		</div>
		<div class="span4">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'unidadOrganizacional_did',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorUo]")); ?>
				<div class="controls">
					<?php 
	        				echo CHtml::CheckBox('chkUo', false, array('ng-model'=>'uo'));?>
					<?php
						$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
					    'name'=>'DetalleInventario[unidadOrganizacional_did]',
					    'id'=>'DetalleInventario_unidadOrganizacional_did',
					    'options'=>array(
				        'delay'=>300,
				        'minLength'=>2,
				        'showAnim'=>'fold',
				        				       
					    ),
					    'htmlOptions'=>array(
					    	'class'=>'input-xlarge',
					    	'ng-model' => 'detalle.uo_did',),
						));
						
						/*
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					    'name'=>'DetalleInventario[unidadOrganizacional_aid]',
					    'id'=>'Inventario_unidadOrganizacional_aid',
					    'source'=>$this->createUrl('unidadOrganizacional/autocompletesearchinventario'),
					    'options'=>array(
					        'delay'=>300,
					        'minLength'=>2,
					        'showAnim'=>'fold',
					        'select'=>"js:function(event, ui) {
                                    jQuery.ajax({
                                            'url':'/inventario/espacios',
                                            'data':{'id':ui.item.id},
                                            'type':'post',
                                            'success':function(data){
                                              $('#DetalleInventario_funcion_aid').html(data);
                                            }
                                    }); 
                            }",
					    ),
					    'htmlOptions'=>array(
					        'size'=>'40',
					        'ng-model' => 'detalle.uo_did',
					        'class'=>'input-xlarge',
					    ),
						));
*/
						
						echo $form->error($modelDetalle,'unidadOrganizacional_did'); ?>
				</div>
			</div>
		</div>
		<div class="span4">
			<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($modelDetalle,'espacio_aid',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorEspacio]")); ?>
		        <div class="controls">
	        			<?php 
	        				echo CHtml::CheckBox('chkEspacio', false, array('ng-model'=>'espacio'));?>
	           		<?php	echo $form->dropDownList($modelDetalle,'funcion_aid',array(),array(
	           									'style'=>'width:90%;border:1px black red;',
	           									'class'=>'select2',
	           									'ng-model' => 'detalle.espacio_aid'));
				         echo $form->error($model,'funcion_aid'); 
				      ?>
		        </div>
	        </div>
		</div>
	</div>
	<div class="row">
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'marca_aid',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorMarca]")); ?>
				<div class="controls">
					<?php echo CHtml::CheckBox('chkMarca', false, array('ng-model'=>'marcas'));
					$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
					    'name'=>'DetalleInventario[marca_aid]',
					    'id'=>'DetalleInventario_marca_aid',
					    'htmlOptions'=>array(
					    	'class'=>'input-large',
					    	'ng-model' => 'detalle.marca_aid'),
						));
					echo $form->error($modelDetalle,'marca_aid'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'modelo',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorModelo]")); ?>
				<div class="controls">
					<?php echo CHtml::CheckBox('chkModelo', false, array (
                                        'ng-model'=>'modelo',
                    )); ?>
					<?php echo $form->textField($modelDetalle,'modelo',array('size'=>60,'maxlength'=>100, 'ng-model'=>'detalle.modelo')); ?>
					<?php echo $form->error($modelDetalle,'modelo'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'serie',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorSerie]")); ?>
				<div class="controls">
					<?php echo $form->textField($modelDetalle,'serie',array('size'=>60,'maxlength'=>100, 'ng-model'=>'detalle.serie')); ?>
					<?php echo $form->error($modelDetalle,'serie'); ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'costoAdquisicion',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorCosto]")); ?>
				<div class="controls">
					<?php echo CHtml::CheckBox('chkCosto', false, array (
                                        'ng-model'=>'costo',
                    )); ?>
					<?php echo $form->textField($modelDetalle,'costoAdquisicion', array('ng-model'=>'detalle.costoAdquisicion')); ?>
					<?php echo $form->error($modelDetalle,'costoAdquisicion'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="<?php echo 'control-group'; ?>">
				<?php echo $form->labelEx($modelDetalle,'observaciones',array('class'=>'control-label', 'ng-class'=>"{true: 'error', false: ''}[errorObservaciones]")); ?>
				<div class="controls">
					<?php echo CHtml::CheckBox('chkObservaciones', false, array (
                                        'ng-model'=>'observaciones',
                    )); ?>
					<?php echo $form->textArea($modelDetalle,'observaciones',array('rows'=>6,'style'=>'width:95%', 'ng-model'=>'detalle.observaciones')); ?>
					<?php echo $form->error($modelDetalle,'observaciones'); ?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" id="detalleInventario">
    	<div class="span12">
		    <div id="ctrl-exmpl" >
		    	<div class="row">
		    		<div class="span12">
			    		<a ng-click="agregar()" href="" class="btn pull-right" style="margin-bottom:20px;"><i class="icon-plus">&nbsp;</i> Agregar</a>
		    		</div>
		    	</div>
			    <table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Cantidad</th>
							<th>Articulo</th>
							<th>Costo</th>
							<th>Iva</th>
							<th>Costo Total</th>
							<th>Unidad Org.</th>
							<th>Espacio</th>
							<th>Tipo</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(key, item) in inventarios">
							<td>									
								{{item.cantidad}}
								{{item.cantidadPorLote}}								
				     		</td>
				     		<td>
				     			{{item.articulo_descripcion}}
				     		</td>
				     		<td>
				     			{{item.costoAdquisicion}}
				     		</td>
				     		<td>
				     			{{item.iva}}
				     		</td>
				     		<td>
				     			{{item.totalCostoAdquisicion}}
				     		</td>
				     		<td>
				     			{{item.uo_descripcion}}
				     		</td>
							<td>
				     			{{item.espacio_descripcion}}
				     		</td>
				     		<td>
				     			{{item.tipo}}
				     		</td>
				     		<td>
				     			<button ng-click="cancelar(item, $event)" class="btn btn-mini btn-danger">Cancelar</button>
				     			<input name="detalle[{{key}}][articulo_aid]" type="hidden" value="{{item.articulo_aid}}" />
				     			<input name="detalle[{{key}}][uo_did]" type="hidden" value="{{item.uo_did}}" />
				     			<input name="detalle[{{key}}][espacio_aid]" type="hidden" value="{{item.espacio_aid}}" />
				     			<input name="detalle[{{key}}][marca_aid]" type="hidden" value="{{item.marca_aid}}" />
				     			<input name="detalle[{{key}}][modelo]" type="hidden" value="{{item.modelo}}" />
				     			<input name="detalle[{{key}}][serie]" type="hidden" value="{{item.serie}}" />
				     			<input name="detalle[{{key}}][costoAdquisicion]" type="hidden" value="{{item.costoAdquisicion}}" />
				     			<input name="detalle[{{key}}][iva]" type="hidden" value="{{item.iva}}" />
				     			<input name="detalle[{{key}}][totalCostoAdquisicion]" type="hidden" value="{{item.totalCostoAdquisicion}}" />
				     			<input name="detalle[{{key}}][porcentajeIva]" type="hidden" value="{{item.porcentajeIva}}" />				     			
				     			<input name="detalle[{{key}}][observaciones]" type="hidden" value="{{item.observaciones}}" />
				     			<input name="detalle[{{key}}][cantidad]" type="hidden" value="{{item.cantidad}}" />
				     			<input name="detalle[{{key}}][lote]" type="hidden" value="{{item.lote}}" />
				     			<input name="detalle[{{key}}][cantidadPorLote]" type="hidden" value="{{item.cantidadPorLote}}" />
				     			<input name="detalle[{{key}}][tipo]" type="hidden" value="{{item.tipo}}" />
				     		</td>
				     	</tr>
				    </tbody>
				</table>				
			</div>
		</div>
	</div>
	<hr>
	<?php // Aquí termina el detalle ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>


<?php $this->endWidget(); ?> 

</div>


