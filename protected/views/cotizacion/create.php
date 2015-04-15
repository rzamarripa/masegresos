<?php
    $this->pageCaption='Cotización';
    $this->pageTitle=Yii::app()->name . ' - ' . $this->pageCaption;
    $this->pageDescription='nueva';
    
    $this->breadcrumbs=array(
		'Cotizaciones',
		'Crear',
	);
 
    echo $this->renderPartial('_form', array('model'=>$model, 'requisicion' => $requisicion)); 
?>