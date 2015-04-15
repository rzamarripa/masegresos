<?php
date_default_timezone_set("America/Mazatlan");
$this->pageCaption='Existencia';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Reporte';
$uos = UnidadOrganizacional::model()->findAll();
$nombreUo = array();
foreach($uos as $uo)
	array_push($nombreUo,$uo->id . "-" . $uo->nombre);
?>

<div class="row" style="text-align:center; padding-top:20px;">
	<div class="span12">
	<?php
		 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'almacen-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>true,
		));
	?>	
		<table>
			<tr>
				<td>
					<?php
					$this->widget('bootstrap.widgets.TbTypeahead', array(
					    'name'=>'almacen',
					    'options'=>array(
					        'source'=>$nombreUo,
					        'items'=>4,
					        'matcher'=>"js:function(item) {
					            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
					        }",
					    ),
					    'htmlOptions'=>array(			    	
					    	'style'=>'	width: 500px;
					    					onkeydown="return checkEnter(event);
					    					text-align:center;			    					
											height: 20px;
											font-size: 12pt;
											font-family: Arial, Helvetica, sans-serif;',
					    	'placeholder' => 'Unidad Organizacional',
					    	'autocomplete' => 'off',
					    	'required' => 'required',
					    ),
					));
					?>
				</td>
				<td>
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
																		'name'=>'inicio',
																		'options'=>array(
																						'showAnim'=>'fold',
																						'dateFormat'=>'yy-mm-dd',
																						),
																		'htmlOptions'=>array(
																							'style'=>'width: 100px;
																									  height: 20px;',
																							'placeholder' => 'Fecha Inicio',
																							'required' => 'required',
																							),
					));
					?>
				</td>
				<td>
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array('name'=>'fin',
																		'options'=>array(
																						'showAnim'=>'fold',
																						'dateFormat'=>'yy-mm-dd',
																						),
																		'htmlOptions'=>array(
																							'style'=>'width: 100px;
																									  height: 20px;',
																							'placeholder' => 'Fecha Fin',
																							'required' => 'required',
																							),
					));	
					?>
				</td>
				<td>
					<?php
						echo CHtml::ajaxSubmitButton(
					   'Buscar',
			   			array('ordenCompra/imprimirExistencia'),
			   			array('update'=>'#almacenes'),
			   			array('id'=>'botonBuscar', 'class'=>'btn btn-primary'));
				
						$this->endWidget(); 
					?>
				</td>
			</tr>
		</table>	
	</div>
</div>

<div id="almacenes"></div>		
