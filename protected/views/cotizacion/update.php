<?php
    $this->pageCaption='Cotizaciones';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='Actualizar';
    if(isset($_GET['origen'])){
          
    } else {
    $this->breadcrumbs=array(
        'Cotizaciones'=>array('index'),
        'Actualizar'
    );
    }

    $usuarioActual = Usuario::model()->obtenerUsuarioActual();
    if($usuarioActual->tipoUsuario->nombre == "Proveedor"){
        $this->menu=array(
        array('label'=>'Volver','url'=>array('proveedor/dashboard','proveedorId'=> $model->proveedor_aid)),
        array('label'=>'Ver Cotización','url'=>array('view','id'=>$model->id,'origen'=>'proveedor')),
    );

    }else{
    $this->menu=array(
        array('label'=>'Listar Cotizaciones','url'=>array('index')),
        array('label'=>'Ver Cotización','url'=>array('view','id'=>$model->id)),
        array('label'=>'Administrar Cotizaciones','url'=>array('admin')),
    );
}
    
    echo $this->renderPartial('_form',array('model'=>$model, 'requisicion' => $requisicion, 'detalle_cotizacion' => $detalle_cotizacion)); 
?>