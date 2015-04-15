<?php 
	$this->pageCaption='Inventarios';
	$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
	$this->pageDescription='Detalle de Reubicación';
	
	$this->breadcrumbs=array(
			'Inventarios'=>array('index'),
			'Reubicación',
	);
?>

<div class='row'>
	<div class='span5'>
		<div class="<?php echo 'control-group'; ?>">
			<blockquote>
				<p><?php echo $modelDetail->unidadOrganizacional->nombre; ?> </p>
				<small><cite title="Source Title"><?php echo $modelDetail->funcion->nombre; ?></small>
				<small><cite title="Source Title"><?php echo $modelDetail->articulo->nombre; ?></small>
			</blockquote>
		</div>
	</div>
	<div class='span7'>
		<?php
		    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'detalleReubicacion-form',
				'type'=>'vertical',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('onkeypress' => 'return event.keyCode != 13'),
		        )
		    );
		   
			echo $form->hiddenField($modelDetail,'id');
		    echo $form->labelEx($modelDetail,'unidadOrganizacional_did');
		    echo $form->dropDownList($modelDetail,'unidadOrganizacional_did',
	        CHtml::listData(UnidadOrganizacional::model()->findAllbySql(
	                                                        'SELECT id, CONCAT(codigo, " - ", nombre) AS nombre 
	                                                         FROM UnidadOrganizacional 
	                                                         ORDER BY nombre ASC'
	                                                        ), 'id', 'nombre'),
	            array(
	                'ajax'=>array(
	                    'type'=>'POST'
	                    ,'url'=>CController::createUrl('inventario/espacios')
	                    ,'update'=>'#DetalleInventario_funcion_aid'
	                )
	                ,'prompt'=>'Selecciona ...'
	                ,'style'=>'width:600px;'
	            )
	        );
	    echo $form->error($modelDetail,'unidadOrganizacional_did');
	    ?>
	    <br/>
	    <br/>

	    <?php
	        echo $form->labelEx($modelDetail,'funcion_aid');
			$funciones = CHtml::listData(Funcion::model()->findAllbySql(
			                                'SELECT 
			                                    F.id
			                                    ,F.nombre
			                                FROM Funcion as F
			                                INNER JOIN Espacio as E
			                                    ON F.id = E.funcion_did
			                                INNER JOIN UnidadOrganizacional AS U
			                                    ON E.uO_did = U.codigo
			                                WHERE U.id ='. $modelDetail->unidadOrganizacional_did.'
			                                ORDER BY nombre ASC'
			                                ), 'id', 'nombre');

			echo $form->dropDownList($modelDetail,'funcion_aid',$funciones,array('empty'=>'Selecciona ...','style'=>'width:600px;'));
	        echo $form->error($modelDetail,'funcion_aid');
	    ?>
	    <br/>
	    <br/> 	    

  		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'type'=>'info',
				'htmlOptions'=>array('onclick'=>'window.location.href="index"'),
				'label'=>"Cancelar",
			)); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'type'=>'info',
				'label'=>'Reubicar',
				'htmlOptions'=>array(
				'data-toggle'=>'modal',
				'data-target'=>'#myModal',
				),
			)); ?>
       </div>
	<?php $this->endWidget(); ?>
	</div>
</row>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Confirmación</h4>
    </div>
    <div class="modal-body">
        <p>Esta seguro que desea realizar la reubicación ?</p>
    </div>
    <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'info',
            'label'=>'Guardar',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal','onclick'=>'$("#detalleReubicacion-form").submit()'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Cancelar',
            'url'=>'#',
            'htmlOptions'=>array('data-dismiss'=>'modal'),
        )); ?>
    </div>
<?php $this->endWidget(); ?>