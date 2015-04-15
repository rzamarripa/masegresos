<?php
$this->pageCaption='Adminisitrar ';
$this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
$this->pageDescription='Paquetes de Requisiciones';
$this->breadcrumbs=array(
	'Paquetes de Requisiciones'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Volver Inicio','url'=>array('site/index')),
	array('label'=>'Volver a Paquetes','url'=>array('paqueteRequisiciones/index')),
);
?>

<?php
	$usuarioActual = Usuario::model()->obtenerUsuarioActual();
	if($usuarioActual->tipoUsuario->nombre == "Almacen"){
		$this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'paqueterequisiciones-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'id',
				'nombre',
				array('name'=>'fechaCreacion_f',
					    'value'=>'Yii::app()->dateFormatter->format("d-M-y H:m:s",strtotime($data->fechaCreacion_f))'),
				array('name'=>'usuario_did',
					    'value'=>'$data->usuario->usuario',
						  'filter'=>CHtml::listData(Usuario::model()->findAll("tipoUsuario_did != 9 && estatus_did = 1"), 'id', 'usuario'),),
				array('name'=>'estatus_did',
					        'value'=>'$data->estatus->paquetealmacen',
						    'filter'=>CHtml::listData(Estatus::model()->findAll("paquetealmacen IS NOT NULL"), 'id', 'paquetealmacen'),),
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=>'{view}',
				),
			),
		));
	} else {
		$this->widget('bootstrap.widgets.TbGridView',array(
				'id'=>'paqueterequisiciones-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					'id',
					'nombre',
					array('name'=>'fechaCreacion_f',
					    'value'=>'Yii::app()->dateFormatter->format("d-M-y H:m:s",strtotime($data->fechaCreacion_f))'),
					array('name'=>'usuario_did',
						        'value'=>'$data->usuario->usuario',
							    'filter'=>CHtml::listData(Usuario::model()->findAll(), 'id', 'nombre'),),
					array('name'=>'estatus_did',
						        'value'=>'$data->estatus->paquete',
							    'filter'=>CHtml::listData(Estatus::model()->findAll("paquete IS NOT NULL"), 'id', 'paquete'),),
					array(
						'class'=>'bootstrap.widgets.TbButtonColumn',
					),
				),
			));


	}

 ?>
