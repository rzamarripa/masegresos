<div ng-controller="InventarioController">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'inventario-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13'),
	)); ?>

	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Instrucciones</h4>	
		Los campos con <span class="required">*</span> son requeridos.
   </div>
	
	<?php echo $form->errorSummary($model); ?>
        
    <div class="row">
        <div class="span4">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'codigoInventario',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'codigoInventario',array('size'=>50,'maxlength'=>50,"class"=>"span2","readonly"=>"readonly", 'ng-model' => 'encabezado.codigoInventario')); ?>
			            <?php echo $form->error($model,'codigoInventario'); ?>
			        </div>
		        </div>
            </div>
        </div>
        <div class="span4">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'salidaResguardo',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'salidaResguardo',array('size'=>50,'maxlength'=>50,"class"=>"span2", 'ng-model' => 'encabezado.salidaResguardo')); ?>
			            <?php echo $form->error($model,'salidaResguardo'); ?>
			        </div>
		        </div>
            </div>
        </div>
        <div class="span4">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'numeroDocumento',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'numeroDocumento',array('size'=>50,'maxlength'=>50,"class"=>"span2", 'ng-model' => 'encabezado.numeroDocumento')); ?>
			            <?php echo $form->error($model,'numeroDocumento'); ?>
			        </div>
		        </div>
	        </div>
         </div>
    </div>
    <hr/>
        
    <div class="row">
        <div class="span7">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'proveedor_aid',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
					    <?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
						    'model'=>$model, 
						    'attribute'=>'proveedor_aid', 
						    'sourceUrl'=>Yii::app()->createUrl('proveedor/autocompletesearch'), 
						    'showFKField'=>false,
						    'relName'=>'proveedor', // the relation name defined above
						    'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display
						    'options'=>array(
						        'minLength'=>1
						    ),
                            'htmlOptions'=>array(
                                "class"=>"span5",
                                "autocomplete"=>"off",
                                'ng-model' => 'encabezado.proveedor_aid'
                            )
					    )); ?>
                        <?php echo $form->error($model,'proveedor_aid'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span5">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'origen_did',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
						<?php echo $form->dropDownList($model,'origen_did',CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Origen'"), "id", "nombre"),array("class"=>"span3", 'ng-model' => 'encabezado.origen_did')); ?>
                        <?php echo $form->error($model,'origen_did'); ?>
			        </div>
		        </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="span7">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'unidadOrganizacional_aid',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
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
                            'htmlOptions'=>array(
                                "class"=>"span5",
                                "autocomplete"=>"off",
                                'ng-model' => 'encabezado.unidadOrganizacional_aid'
                            )
					    )); ?>			
                        <?php echo $form->error($model,'unidadOrganizacional_aid'); ?>
			        </div>
		        </div>
            </div>
        </div>
        <div class="span5">
            <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'tipoDocumento_did',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
						<?php echo $form->dropDownList($model,'tipoDocumento_did',CHtml::listData(TipoOpciones::model()->findAll("tipo = 'Documento'"), "id", "nombre"),array("class"=>"span3",'ng-model' => 'encabezado.tipoDocumento_did')); ?>
                        <?php echo $form->error($model,'tipoDocumento_did'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
        
    <div class="row">
        <div class="span12">
	        <div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'autorizo',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
						        <?php 
                                    echo $form->textField($model,'autorizo',array("class"=>"span5","value"=>"C. Norma Alicia Aguilar Navarro","readonly"=>"readonly",'ng-model' => 'encabezado.autorizo'));
                                 ?>	<?php echo $form->error($model,'autorizo'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
    <hr/>

    <div class="row">
        <div class="span9">
        	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'articulo_aid',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
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
                                    'htmlOptions'=>array(
                                        "class"=>"span5",
                                        "autocomplete"=>"off",
                                        'ng-model' => 'detalle.articulo_aid',
                                    )
						         )); ?>			<?php echo $form->error($model,'articulo_aid'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span3">
            <?php
                $model->tipoCaptura = 1;
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
									    });'
									),
							   ),       
						),    
				));
			?>
        </div>
    </div>
    <?php echo $form->hiddenField($model,'esLote',array('value'=>0, 'ng-model' => 'detalle.esLote')); ?>
    
    <div class="row">
        <div id="CargaMultiple" style="display:none;">
            <div class="span12">
	            <div class="<?php echo 'control-group'; ?>">
		            <?php echo $form->labelEx($model,'cantidad',array('class'=>'control-label')); ?>
		            <div class="controls">
			            <div class="input-prepend">
                            <?php echo $form->textField($model,'cantidad',array('size'=>10,'maxlength'=>10, 'ng-model' => 'detalle.cantidad')); ?>
			                <?php echo $form->error($model,'cantidad'); ?>
			            </div>
		            </div>
	            </div>
            </div>
        </div>
        <div id="CargaPorLotes" style="display:none;">
            <div class="span3">
                <div class="<?php echo 'control-group'; ?>">
		            <?php echo $form->labelEx($model,'lote',array('class'=>'control-label')); ?>
		            <div class="controls">
			            <div class="input-prepend">
                            <?php echo $form->textField($model,'lote',array('size'=>50,'maxlength'=>50,"class"=>"span2", 'ng-model' => 'detalle.lote')); ?>
			                <?php echo $form->error($model,'lote'); ?>
			            </div>
		            </div>
                </div>
            </div>
            <div class="span9">
                <div class="<?php echo 'control-group'; ?>">
		            <?php echo $form->labelEx($model,'cantidadPorLote',array('class'=>'control-label')); ?>
		            <div class="controls">
			            <div class="input-prepend">
                            <?php echo $form->textField($model,'cantidadPorLote',array('size'=>50,'maxlength'=>50,"class"=>"span2", 'ng-model' => 'detalle.cantidadPorLote')); ?>
			                <?php echo $form->error($model,'cantidadPorLote'); ?>
			            </div>
		            </div>
                </div>
            </div>
            
        </div>
    </div>
     <!-- Aquí iba la tabla -->
	<div style="margin-top:20px;"></div>
    <div style="width:430px; float:left;">
        <div class="<?php echo 'control-group'; ?>">
	        <?php echo $form->labelEx($model,'fechaAdquisicion_f',array('class'=>'control-label')); ?>
	        <div class="controls">
		        <div class="input-prepend">	
			        <?php
			        if ($model->fechaAdquisicion_f!='') 
				        $model->fechaAdquisicion_f=date('Y-m-d',strtotime($model->fechaAdquisicion_f));
				        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	                                    'model'=>$model,
	                                    'attribute'=>'fechaAdquisicion_f',
	                                    'value'=>$model->fechaAdquisicion_f,
	                                    'language' => 'es',
	                                    'htmlOptions' => array('readonly'=>"","autocomplete"=>"off",'ng-model' => 'encabezado.fechaAdquisicion_f',),
	                                    'options'=> array(	                                    	
									        'dateFormat'=>'yy-mm-dd', 
									        'altFormat'=>'yy-mm-dd', 
									        'changeMonth'=>'true', 
									        'changeYear'=>'true', 
									        'showOn'=>'both',
									        'buttonText'=>'<i class="icon-calendar"></i>'
								        ),)); ?>			<?php echo $form->error($model,'fechaAdquisicion_f'); ?>
		        </div>
	        </div>
        </div>
    </div>
    <div style="float:left;">
        <div class="<?php echo 'control-group'; ?>">
		    <?php echo $form->labelEx($model,'fondo_aid',array('class'=>'control-label','style'=>'width:130px;')); ?>
		    <div class="controls">
			    <div class="input-prepend" style="margin-left:-30px; width:570px;">
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
                                'htmlOptions'=>array(
                                    "class"=>"span6",
                                    "autocomplete"=>"off",
                                    'ng-model' => 'encabezado.fondo_aid'
                                )
						        )); ?>			<?php echo $form->error($model,'fondo_aid'); ?>
			    </div>
		    </div>
	    </div>
    </div>    
    <div class="row">
        <div class="span4">
            	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'costoAdquisicion',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'costoAdquisicion',array('ng-model' => 'detalle.costoAdquisicion')); ?>
			            <?php echo $form->error($model,'costoAdquisicion'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span8">
            	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'funcion_aid',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
						        <?php $this->widget('ext.custom.widgets.EJuiAutoCompleteFkField', array(
						            'model'=>$model, 
						            'attribute'=>'funcion_aid', 
						            'sourceUrl'=>Yii::app()->createUrl('funcion/autocompletesearch',array("uo"=>$model->unidadOrganizacional_aid)), 
						            'showFKField'=>false,
						            'relName'=>'funcion', // the relation name defined above
						            'displayAttr'=>'nombre',  // attribute or pseudo-attribute to display
	
						            'options'=>array(
						                'minLength'=>1, 
						            ),
                                    'htmlOptions'=>array(
                                        "class"=>"span6",
                                        "autocomplete"=>"off",
                                        'ng-model' => 'detalle.funcion_aid'
                                    )
						         )); ?>			<?php echo $form->error($model,'funcion_aid'); ?>
			        </div>
		        </div>
	        </div>
	        <?php echo $form->hiddenField($model,'espacio_did',array('value'=>'','ng-model' => 'detalle.espacio_did')); ?>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'ejercicio',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'ejercicio',array('size'=>50,'maxlength'=>50, 'ng-model' => 'encabezado.ejercicio')); ?>
			            <?php echo $form->error($model,'ejercicio'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span3">
            	<div class="<?php echo 'control-group'; ?>">
		        <?php echo $form->labelEx($model,'serie',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'serie',array('size'=>45,'maxlength'=>45, 'ng-model' => 'detalle.serie')); ?>
			            <?php echo $form->error($model,'serie'); ?>
			        </div>
		        </div>
	        </div>
        </div>
        <div class="span5">
            	<div class="<?php echo 'control-group'; ?> pull-right" style="margin-right:20px;">
		        <?php echo $form->labelEx($model,'modelo',array('class'=>'control-label')); ?>
		        <div class="controls">
			        <div class="input-prepend">
                        <?php echo $form->textField($model,'modelo',array('size'=>45,'maxlength'=>45, 'ng-model' => 'detalle.modelo')); ?>
			            <?php echo $form->error($model,'modelo'); ?>
			        </div>
		        </div>
	        </div>
        </div>
    </div>
	<div class="<?php echo 'control-group'; ?>">
		<?php echo $form->labelEx($model,'observaciones',array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend">
			    <?php echo $form->textArea($model,'observaciones',array('size'=>500,'maxlength'=>500,'rows'=>'5','class'=>'span10','ng-model' => 'encabezado.observaciones')); ?>
			    <?php echo $form->error($model,'observaciones'); ?>
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
							<th>Factura</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(key, item) in inventarios">
							<td>
								{{item.detalle.costoAdquisicion}}
								<input class="cantidad" type="hidden" name="detalle[{{key}}][cantidad]" value="{{item.detalle.cantidad}}" />
				     		</td>
				     		<td>
				     			{{item.detalle.serie}}
								<input class="articulo" type="hidden" name="detalle[{{key}}][articulo_aid]" value="{{item.detalle.articulo_aid}}" />
				     		</td>
				     		<td>
				     			{{item.encabezado.ejercicio}}
				     			<input class="documento" type="hidden" name="detalle[{{key}}][numeroDocumento]" value="{{item.encabezado.numeroDocumento}}" />
				     		</td>
				     		<td>
				     			<button ng-click="cancelar(item, $event)" class="btn btn-mini btn-danger">Cancelar</button>
				     		</td>
				     	</tr>
				    </tbody>
				</table>				
			</div>
		</div>
	</div>
	<hr>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
</div>