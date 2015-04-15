<?php

class CotizacionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('autocompletesearch'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete','cotporreq','aceptar','imprimir'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$detalleCotizacion = DetalleCotizacion::model()->findAll('cotizacion_did = ' . $model->id);
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha visto la cotización " . $model->numeroCotizacion . "', '" . Yii::app()->user->name . "')")->execute();
		$this->render('view',array(
			'model'=>$model,
			'detalleCotizacion' => $detalleCotizacion,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$requisicion_id = 0;
		if (!isset($_GET['requisicion_id']) || empty($_GET['requisicion_id'])) {
			$this->redirect(array('index'));
		} else {
			$requisicion_id = $_GET['requisicion_id'];
		}

		$model=new Cotizacion;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(isset($_POST['Cotizacion']) && isset($_POST['detalle']))
		{
			try
			{
				//echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
				$proveedor = Proveedor::model()->obtenerProveedorActual();
				$requisicion = Requisicion::model()->find('id = ' . $requisicion_id);				
				
				$cotizacion = $_POST['Cotizacion'];
				$proyectoId = 1;
				if(isset($requisicion->proyecto_aid))
					$proyectoId = $requisicion->proyecto_aid;

				$conection = Yii::app()->db;
				$transaction = $conection->beginTransaction();	
				$comandoCotizacion = $conection->createCommand("INSERT INTO Cotizacion 
					(numeroCotizacion, fecha_f, fechaEntrega_f, director, 
					subtotal, iva, total, estatus_did, requisicion_did, proveedor_aid, proyecto_aid) 
					VALUES (:numeroCotizacion, :fecha_f, :fechaEntrega_f, :director, :subtotal, 
					:iva, :total, :estatus_did, :requisicion_did, :proveedor_aid, :proyecto_aid)");
				$comandoCotizacion->bindValue(":numeroCotizacion", $requisicion->numeroRequisicion,PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":fecha_f",date('Y-m-d'),PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":fechaEntrega_f",$cotizacion['fechaEntrega_f'],PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":director",$requisicion->director,PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":subtotal",$cotizacion['subtotal'],PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":iva",$cotizacion['iva'],PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":total",$cotizacion['total'],PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":estatus_did",3,PDO::PARAM_INT);
				$comandoCotizacion->bindValue(":requisicion_did",$cotizacion['requisicion_did'],PDO::PARAM_INT);
				$comandoCotizacion->bindValue(":proveedor_aid",$proveedor->id,PDO::PARAM_INT);
				$comandoCotizacion->bindValue(":proyecto_aid", $proyectoId ,PDO::PARAM_INT);
				//Creo la cotización
				if($comandoCotizacion->execute())
				{					
					$comandoRequisicion = $conection->createCommand("UPDATE Requisicion SET estatus_did = 3 WHERE id = :id");
					$comandoRequisicion->bindValue(":id",$requisicion->id,PDO::PARAM_INT);
					//Actualizo la requisición a cotizada para informar a staff que ya le mandaron una cotización
					if($comandoRequisicion->execute() || $requisicion->estatus_did == 3)
					{
						$comandoProveedoresPorRequisicion = $conection->createCommand("UPDATE ProveedoresPorRequisicion 
							SET estatus_did = 3 WHERE proveedor_aid = :proveedor_aid && requisicion_aid = :requisicion_aid");
						$comandoProveedoresPorRequisicion->bindValue(":requisicion_aid",$requisicion->id,PDO::PARAM_INT);
						$comandoProveedoresPorRequisicion->bindValue(":proveedor_aid",$proveedor->id,PDO::PARAM_INT);
						//Actualizo la tabla donde relaciono la requisicion y el proveedor, para saber que de todos los proveedores que les envié la requisición uno ya me respondió
						if($comandoProveedoresPorRequisicion->execute())
						{
							$detalleCotizacion = $_POST['detalle'];
					
							$criteria = new CDbCriteria;
							$criteria->select='MAX(id) as id';
							$cotizacion = Cotizacion::model()->find($criteria);
							//Leo todos los detalles
							foreach($detalleCotizacion as $detalle)
							{
								$comandoDetalle = $conection->createCommand("INSERT INTO DetalleCotizacion
									(cantidad, articulo_aid, precioUnitario, importe, observaciones, cotizacion_did) VALUES(:cantidad, :articulo_aid, :precioUnitario, :importe, :observaciones, :cotizacion_did)");
								$comandoDetalle->bindValue(":cantidad", $detalle['cantidad'],PDO::PARAM_INT);
								$comandoDetalle->bindValue(":articulo_aid",$detalle['articulo_aid'],PDO::PARAM_INT);
								$comandoDetalle->bindValue(":precioUnitario",$detalle['precioUnitario'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":importe",$detalle['importe'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":observaciones",$detalle['observaciones'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":cotizacion_did",$cotizacion->id,PDO::PARAM_INT);
								//Inserto el detalle de la cotización
								$comandoDetalle->execute();
							}
							$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha creado una cotización', '" . Yii::app()->user->name . "')")->execute();
							$transaction->commit();
						}						
					}
				}				
				$this->redirect(array('proveedor/dashboard','proveedorId'=>$proveedor->id));
			}
			catch(Exception $e)
			{
				$transaction->rollBack();
				
				echo '<pre>';print_r($e); echo "</pre>";
				echo '<pre>';print_r($_POST); echo "</pre>";
			}
		}

		$this->addCss('cotizaciones.css');

		$requisicion = Requisicion::model()->findByPK($requisicion_id);
		if (!$requisicion) $this->redirect(array('index'));

		//echo '<pre>'; print_r($requisicion->to_array($include_detalle = true)); echo '</pre>';
		Yii::app()->clientScript->registerCoreScript('yiiactiveform');

		$this->render('create',array(
			'model'=>$model,
			'requisicion' => $requisicion->to_array($include_detalle = true)
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Cotizacion']))
		{
			$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha actualizado una cotización', '" . Yii::app()->user->name . "')")->execute();
			$model->attributes=$_POST['Cotizacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$requisicion = Requisicion::model()->findByPK($model->requisicion_did);

		$items = $model->detalleCotizacions();
		$detalle_cotizacion = array();
		foreach ($items as $item) {
			$detalle_cotizacion[] = $item->to_array();
		}

		$this->render('update',array(
			'model'=>$model,
			'requisicion' => $requisicion->to_array($include_detalle = true),
			'detalle_cotizacion' => $detalle_cotizacion
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		try{
			if(isset($_POST['Cotizacion']) && isset($_POST['Proveedores']))
			{
				$conection = Yii::app()->db;
				$transaction = $conection->beginTransaction();
				$cotizacion = Cotizacion::model()->find("id = " . $_POST['Cotizacion']["id"]);
				$comandoCotizacion = $conection->createCommand("UPDATE Cotizacion SET estatus_did = :estatus_did");
				$comandoCotizacion->bindValue(":estatus_did",2,PDO::PARAM_STR);
				if($comandoCotizacion->execute() || $cotizacion->estatus_did == 2)
				{
					if(isset($_POST['Proveedores']))
					{
						$proveedores = $_POST['Proveedores'];
						foreach($proveedores as $proveedor)
						{
							
							if(!empty($proveedor) && isset($proveedor))
							{	
								$idProveedor = explode("-", $proveedor);
								$existeCotconProveedor = ProveedoresPorCotizacion::model()->exists("cotizacion_aid = :c && proveedor_aid = :p", array(":c"=>$cotizacion->id, ":p" => $idProveedor[0]));
								if(!$existeCotconProveedor)
								{
									$sqlProveedor = "INSERT INTO ProveedoresPorCotizacion (cotizacion_aid, proveedor_aid) VALUES (:cotizacion_aid, :proveedor_aid)";
									$comandoProveedor = $conection->createCommand($sqlProveedor);
									$comandoProveedor->bindParam(":proveedor_aid", $idProveedor[0], PDO::PARAM_STR);
									$comandoProveedor->bindValue(":cotizacion_aid", $cotizacion->id, PDO::PARAM_INT);									
									if($comandoProveedor->execute())
									{
										$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha enviado la cotización: " . $cotizacion->numeroCotizacion . "', '" . Yii::app()->user->name . "')")->execute();
										Yii::app()->user->setFlash('success', '<strong><i class="icon-ok"></i> La cotización se ha enviado correctamente!</strong>');
									}
									else
									{
										Yii::app()->user->setFlash('warning', '<strong>Hubo error en la enviada!</strong>');
									}
								}
								else
								{
									Yii::app()->user->setFlash('warning', '<strong><i class="icon-exclamation-sign"></i> No se envió<br/></strong>La cotización ya había sido enviada');
								}
							}
						}
					}
				}
				$transaction->commit();
			}
			
		}
		catch(Exception $e)
		{
			Yii::app()->user->setFlash('warning', '<strong>Al parecer ya le enviaste la cotización a esos proveedores</strong>');
			//echo '<pre>';print_r($e->message); echo "</pre>";
			$transaction->rollBack();
		}
		
		
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cotizacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cotizacion']))
			$model->attributes=$_GET['Cotizacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Cotizacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cotizacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAutocompletesearch()
	{
	    $q = "%". $_GET['term'] ."%";
	 	$result = array();
	    if (!empty($q))
	    {
			$criteria=new CDbCriteria;
			$criteria->select=array('id', "CONCAT_WS(' ',nombre) as nombre");
			$criteria->condition="lower(CONCAT_WS(' ',nombre)) like lower(:nombre) ";
			$criteria->params=array(':nombre'=>$q);
			$criteria->limit='10';
	       	$cursor = Cotizacion::model()->findAll($criteria);
			foreach ($cursor as $valor)	
				$result[]=Array('label' => $valor->nombre,  
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}
	
	public function actionCotporreq($id)
	{		
		$cotizaciones = Cotizacion::model()->findAll(array('order'=>'total ASC', 'condition'=>'requisicion_did=:r', 'params'=>array(':r'=>$id)));		
		$this->render('cotporreq',array('cotizaciones' => $cotizaciones));
	}
	
	public function actionAceptar($id)
	{
		$this->generarOrdenCompra($id);
		
	}
	
	public function generarOrdenCompra($id)
	{	
		try
		{
			$conection = Yii::app()->db;
			$transaction = $conection->beginTransaction();	
			$cotizacion = Cotizacion::model()->find('id = :c', array(':c'=>$id));
			if($_GET['tipoCambio']==101)
			{
				/*
					1.- Pregunta si estoy Aceptando o Rechazando
					2.- Si estoy Aceptando
						-2.1.- Cambiar cotización seleccionada a Aceptada
						-2.2.- Cambiar las otras cotizaciones a Rechazada
						2.3.- Crear la Orden de Compra
						2.4.- Crear el Detalle de la Orden de Compra
						2.5.- Poner las relaciones de Proveedores Por Requisición Aceptada
				*/	
				$cotizacion = Cotizacion::model()->find('id = :c', array(':c'=>$id));
				//Pongo la requisicion en cerrada
				$comandoRequisicion = $conection->createCommand("UPDATE Requisicion SET estatus_did = :estatus_did WHERE id = :id");
				$comandoRequisicion->bindValue(":estatus_did",4,PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":id",$cotizacion->requisicion_did,PDO::PARAM_STR);
				$comandoRequisicion->execute();
				
				//Pongo la cotización en aceptada
				$comandoCotizacion = $conection->createCommand("UPDATE Cotizacion SET estatus_did = :estatus_did WHERE id = :id");
				$comandoCotizacion->bindValue(":estatus_did",4,PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":id",$id,PDO::PARAM_STR);
				$comandoCotizacion->execute();
				
				//Pongo las demás cotizaciones en rechazadas
				$comandoCotizacionRechazada = $conection->createCommand("UPDATE Cotizacion SET estatus_did = 5 WHERE requisicion_did = :req_id && estatus_did = 3");
				$comandoCotizacionRechazada->bindValue(":req_id",$cotizacion->requisicion_did, PDO::PARAM_INT);
				$comandoCotizacionRechazada->execute();
				
				//Pongo las demás requisiciones en rechazadas de la tabla relacionada
				$comandoProveedoresPorRequisicion = $conection->createCommand("UPDATE ProveedoresPorRequisicion SET estatus_did = :estatus_did WHERE requisicion_aid = :requisicion_aid && proveedor_aid != :proveedor_aid");
				$comandoProveedoresPorRequisicion->bindValue(":requisicion_aid",$_GET['reqid'],PDO::PARAM_INT);
				$comandoProveedoresPorRequisicion->bindValue(":proveedor_aid",$_GET['provid'],PDO::PARAM_INT);
				$comandoProveedoresPorRequisicion->bindValue(":estatus_did",5,PDO::PARAM_STR);
				$comandoProveedoresPorRequisicion->execute();
				
				//Pregunto si viene de un proyecto esta cotización aceptada
				$proyectoId = NULL;
				$almacenId = 0;
				if(isset($_GET["p"]) && !empty($_GET["p"])){
					$proyectoId = $_GET["p"];
					$almacenId = 2;
				} else {
					$almacenId = 1;
				}
				
				$comandoOrden = $conection->createCommand("INSERT INTO OrdenCompra (numeroOrdenCompra, fecha_f, proveedor_aid, unidadOrganizacional_aid, requisicion_did, subtotal, iva, total, estatus_did, estatusAlmacen_did, proyecto_aid, cotizacion_did, almacen_aid) VALUES(:numeroOrdenCompra, :fecha_f, :proveedor_aid, :unidadOrganizacional_aid, :requisicion_did, :subtotal, :iva, :total, :estatusAlmacen_did, :estatus_did, :proyecto_aid, :cotizacion_did, :almacen_aid);");
				$comandoOrden->bindValue(":numeroOrdenCompra",'OC'.$cotizacion->numeroCotizacion,PDO::PARAM_STR);
				$comandoOrden->bindValue(":fecha_f",date('Y-m-d'),PDO::PARAM_STR);
				$comandoOrden->bindValue(":proveedor_aid",$cotizacion->proveedor_aid,PDO::PARAM_INT);
				$comandoOrden->bindValue(":unidadOrganizacional_aid",$cotizacion->requisicion->unidadOrganizacional_aid,PDO::PARAM_INT);
				$comandoOrden->bindValue(":requisicion_did",$cotizacion->requisicion_did,PDO::PARAM_INT);
				$comandoOrden->bindValue(":subtotal",$cotizacion->subtotal,PDO::PARAM_STR);
				$comandoOrden->bindValue(":iva",$cotizacion->iva,PDO::PARAM_STR);
				$comandoOrden->bindValue(":total",$cotizacion->total,PDO::PARAM_STR);
				$comandoOrden->bindValue(":estatusAlmacen_did",1,PDO::PARAM_INT);
				$comandoOrden->bindValue(":estatus_did",1,PDO::PARAM_INT);
				$comandoOrden->bindValue(":proyecto_aid",$proyectoId,PDO::PARAM_INT);
				$comandoOrden->bindValue(":cotizacion_did",$cotizacion->id,PDO::PARAM_INT);
				$comandoOrden->bindValue(":almacen_aid", $almacenId,PDO::PARAM_INT);

				$comandoOrden->execute();
				
				//Inserto el Detalle de la Orden de Compra
				$detalleCotizacion = DetalleCotizacion::model()->findAll('cotizacion_did = ' . $cotizacion->id);
				
				//Obtener la última Orden de Compra para obtener el id
				$criteria = new CDbCriteria;
				$criteria->select='MAX(id) as id';
				$ordenCompra = OrdenCompra::model()->find($criteria);
				foreach($detalleCotizacion as $detalle)
				{
					$comandoDetalle = $conection->createCommand("INSERT INTO DetalleOrdenCompra (cantidad, articulo_aid, precioUnitario, importe, ordenCompra_did) VALUES (:cantidad, :articulo_aid, :precioUnitario, :importe, :ordenCompra_did);");
					$comandoDetalle->bindValue(":cantidad",$detalle->cantidad,PDO::PARAM_INT);
					$comandoDetalle->bindValue(":articulo_aid",$detalle->articulo_aid,PDO::PARAM_INT);
					$comandoDetalle->bindValue(":precioUnitario",$detalle->precioUnitario,PDO::PARAM_STR);
					$comandoDetalle->bindValue(":importe",$detalle->importe,PDO::PARAM_STR);
					$comandoDetalle->bindValue(":ordenCompra_did",$ordenCompra->id,PDO::PARAM_INT);
					$comandoDetalle->execute();
				}
				$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha generado la orden de compra: " . "OC" . $cotizacion->numeroCotizacion . " al aceptar la cotización " . $cotizacion->numeroCotizacion . "', '" . Yii::app()->user->name . "')")->execute();
				$transaction->commit();			
				Yii::app()->user->setFlash('success', '<strong><i class="icon-ok"></i> La cotización del proveedor ' . 
							$cotizacion->proveedor->nombre . ' se ha aceptado!</strong>');	
				$this->redirect(array('cotporreq','id' => $_GET['reqid']));
			}
			else if($_GET['tipoCambio'] == 2)
			{
				/*	3.- Si estoy Rechazando
						3.1.- Cambiar todas las cotizaciones a Pendiente
						3.2.- Borrar Detalle de la Orden de Compra
						3.3.- Borrar la Orden de Compra
						3.4.- Poner las relaciones de Proveedores Por Requisición en Cotizada 				 
				*/
				
				//Pongo la requisicion en cotizada
				$comandoRequisicion = $conection->createCommand("UPDATE Requisicion SET estatus_did = :estatus_did WHERE id = :id");
				$comandoRequisicion->bindValue(":estatus_did",3,PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":id",$cotizacion->requisicion_did,PDO::PARAM_STR);
				$comandoRequisicion->execute();
				
				//Pongo la cotización en pendiente
				$comandoCotizacion = $conection->createCommand("UPDATE Cotizacion SET estatus_did = :estatus_did WHERE requisicion_did = :req_id");
				$comandoCotizacion->bindValue(":estatus_did",3,PDO::PARAM_STR);
				$comandoCotizacion->bindValue(":req_id",$cotizacion->requisicion_did,PDO::PARAM_STR);
				$comandoCotizacion->execute();
				
								
				//Pongo las demás cotizaciones en pendiente
				$comandoProveedoresPorRequisicion = $conection->createCommand("UPDATE ProveedoresPorRequisicion SET estatus_did = :estatus_did WHERE requisicion_aid = :requisicion_aid && proveedor_aid != :proveedor_aid");
				$comandoProveedoresPorRequisicion->bindValue(":requisicion_aid",$_GET['reqid'],PDO::PARAM_INT);
				$comandoProveedoresPorRequisicion->bindValue(":proveedor_aid",$_GET['provid'],PDO::PARAM_INT);
				$comandoProveedoresPorRequisicion->bindValue(":estatus_did",3,PDO::PARAM_INT);
				$comandoProveedoresPorRequisicion->execute();
				
				//Borro el detalle de la orden de compra
				$ordenCompra = OrdenCompra::model()->find("requisicion_did = " . $_GET['reqid']); //Idenfico la orden de compra
				$comandoDetalle = $conection->createCommand("DELETE FROM DetalleOrdenCompra WHERE ordenCompra_did = " . $ordenCompra->id);
				$comandoDetalle->execute();
				
				//Borro la orden de compra
				$comandoOrden = $conection->createCommand("DELETE FROM OrdenCompra WHERE id = " . $ordenCompra->id);
				$comandoOrden->execute();
				
				$transaction->commit();
				Yii::app()->user->setFlash('success', '<strong><i class="icon-ok"></i> La cotización se ha puesto en Pendiente!</strong>');	
				$this->redirect(array('cotporreq','id' => $_GET['reqid']));
			}
			else
			{
				Yii::app()->user->setFlash('error', '<strong><i class="icon-remove"></i> No identifico el tipo de cambio!</strong>');
			}
		}
		catch(Exception $e)
		{
			$transaction->rollBack();
			echo '<pre>';print_r($e); echo "</pre>";
			Yii::app()->user->setFlash('warning', '<strong><i class="icon-remove"></i> Hubo un error al generar la orden de compra del proveedor ' . 	$cotizacion->proveedor->nombre . ', asegúrese que está conectado a internet y vuelva a intentarlo por favor!</strong>');
		}		
	}
	
	public function actionImprimir($id)
	{
		$detalleCotizacion = DetalleCotizacion::model()->findAll('cotizacion_did = ' . $id);	
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('L');
		$mPDF1->WriteHTML($this->renderPartial('imprimir', array('model'=> $this->loadModel($id),'detalleCotizacion'=>$detalleCotizacion),true),2); 
		$mPDF1->Output();	
	}
}