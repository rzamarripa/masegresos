<?php

class RequisicionController extends Controller
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
				'actions'=>array('index','view','create','update','admin',
										'delete','cambiarestatus','generarproveedores','imprimir','formcotproves',
										'requisicionesenviadas','verproveedorespendientes','seguimiento','seguimientorapido',
										'limpiarseguimientorapido','seguimientocontrol','requisicionesprovuo'),
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
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha visto la requisición: " .
																			$model->numeroRequisicion . "', '"  .
																			Yii::app()->user->name . "')")->execute();
		$detalleRequisicion = DetalleRequisicion::model()->findAll('requisicion_did = ' . $model->id);

		$this->render('view',array(
			'model'=>$model,
			'detalleRequisicion' => $detalleRequisicion,
		));
	}

	public function actionSeguimiento($id)
	{
		$model = Requisicion::model()->find("numeroRequisicion= " . $id);
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha visto el seguimiento de la requisición: " .
																			$model->numeroRequisicion . "', '"  .
																			Yii::app()->user->name . "')")->execute();
		$detalleRequisicion = DetalleRequisicion::model()->findAll('requisicion_did = ' . $model->id);

		$this->render('seguimiento',array(
			'model'=>$model,
			'detalleRequisicion' => $detalleRequisicion,
		));
	}

	public function actionSeguimientorapido()
	{
		$model = Requisicion::model()->find("numeroRequisicion= " . $_POST["requisicion"]);
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha visto el seguimiento rápido de la requisición: " .
																			$model->numeroRequisicion . "', '"  .
																			Yii::app()->user->name . "')")->execute();
		$detalleRequisicion = DetalleRequisicion::model()->findAll('requisicion_did = ' . $model->id);

		$this->renderPartial('_seguimientorapido',array(
			'model'=>$model,
			'detalleRequisicion' => $detalleRequisicion,
		));
	}

	public function actionLimpiarseguimientorapido()
	{
		echo "";
		exit;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Requisicion;
		$this->performAjaxValidation($model);

		if(isset($_POST['Requisicion']) && isset($_POST['detalle']))
		{
			try
			{
				$requisicion = $_POST['Requisicion'];
				$proyectoId = 1;
				$unidadOrg = NULL;
				if(isset($_GET["p"]))
				{
					$proyecto = Proyecto::model()->find("id = " . $_GET["p"]);
					$proyectoId = $proyecto->id;
					$unidadOrg = $proyecto->unidadOrganizacional_aid;
				}
				else
				{
					$unidadOrg = $requisicion['unidadOrganizacional_aid'];
				}
				$conection = Yii::app()->db;
				$usuarioActual = Usuario::model()->obtenerUsuarioActual();
				$transaction = $conection->beginTransaction();
				$comandoRequisicion = $conection->createCommand("INSERT INTO Requisicion
					(numeroRequisicion, fecha_f, unidadOrganizacional_aid,
					comentarios, director, titular, recibio, entrego, estatus_did, proyecto_aid, usuario_aid)
					VALUES (:numeroRequisicion, :fecha_f, :unidadOrganizacional_aid, :comentarios,
					:director, :titular, :recibio, :entrego, :estatus_did, :proyecto_aid, :usuario_aid)");
				$comandoRequisicion->bindValue(":numeroRequisicion", $requisicion['numeroRequisicion'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":fecha_f",$requisicion['fecha_f'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":unidadOrganizacional_aid",$unidadOrg,PDO::PARAM_INT);
				$comandoRequisicion->bindValue(":comentarios",$requisicion['comentarios'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":director","C. Norma Alicia Aguilar Navarro",PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":titular",$requisicion['titular'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":recibio",$requisicion['recibio'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":entrego",$requisicion['entrego'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":estatus_did",$requisicion['estatus_did'],PDO::PARAM_INT);
				$comandoRequisicion->bindValue(":proyecto_aid",$proyectoId,PDO::PARAM_INT);
				$comandoRequisicion->bindValue(":usuario_aid",$usuarioActual->id,PDO::PARAM_INT);
				if($comandoRequisicion->execute())
				{
					$criteria = new CDbCriteria;
					$criteria->select='MAX(id) as id';
					$requisicionId = Requisicion::model()->find($criteria);

					$detalleRequisicion = $_POST['detalle'];
					foreach($detalleRequisicion as $detalle)
					{
						$comandoDetalle = $conection->createCommand("INSERT INTO DetalleRequisicion
							(cantidad, articulo_aid, observaciones, requisicion_did)
							VALUES(:cantidad, :articulo_aid, :observaciones, :requisicion_did)");
						$comandoDetalle->bindValue(":cantidad", $detalle['cantidad'],PDO::PARAM_STR);
						$comandoDetalle->bindValue(":articulo_aid",$detalle['articulo'],PDO::PARAM_STR);
						$comandoDetalle->bindValue(":observaciones",$detalle['observaciones'],PDO::PARAM_STR);
						$comandoDetalle->bindValue(":requisicion_did",$requisicionId->id,PDO::PARAM_STR);
						$comandoDetalle->execute();
					}
				}
				$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha creado una requisición', '" . Yii::app()->user->name . "')")->execute();
				$transaction->commit();
				if(isset($_GET["p"]))
					$this->redirect(array('proyecto/view','id'=>$_GET["p"]));
				$this->redirect(array('index'));
			}
			catch(Exception $e)
			{
				$transaction->rollBack();

				echo '<pre>';print_r($e); echo "</pre>";
				echo '<pre>';print_r($_POST); echo "</pre>";
				exit;
			}
		}

		$this->addCss('requisiciones.css');

		$this->render('create',array(
			'model'=>$model,
			//'unidades' => $unidades
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$this->performAjaxValidation($model);

		if(isset($_POST['Requisicion']))
		{
			$conection = Yii::app()->db;
			try
			{
				$requisicion = $_POST['Requisicion'];
				$conection = Yii::app()->db;
				$transaction = $conection->beginTransaction();
				$comandoRequisicion = $conection->createCommand("UPDATE Requisicion SET
					numeroRequisicion = :numeroRequisicion,
					fecha_f = :fecha_f,
					unidadOrganizacional_aid = :unidadOrganizacional_aid,
					comentarios = :comentarios,
					director = :director,
					titular = :titular,
					recibio = :recibio,
					entrego = :entrego,
					estatus_did = :estatus_did
					WHERE id = " . $id);
				$comandoRequisicion->bindValue(":numeroRequisicion", $requisicion['numeroRequisicion'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":fecha_f",$requisicion['fecha_f'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":unidadOrganizacional_aid",$requisicion['unidadOrganizacional_aid'],PDO::PARAM_INT);
				$comandoRequisicion->bindValue(":comentarios",$requisicion['comentarios'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":director",$requisicion['director'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":titular",$requisicion['titular'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":recibio",$requisicion['recibio'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":entrego",$requisicion['entrego'],PDO::PARAM_STR);
				$comandoRequisicion->bindValue(":estatus_did",$requisicion['estatus_did'],PDO::PARAM_INT);
				//$comandoRequisicion->bindValue(":grupo_articulos", requisicion['grupo_articulos'],PDO::PARAM_STR);
				$comandoRequisicion->execute();
					$detalleRequisicion = $_POST['detalle'];
					$comandoEliminaDetalle = $conection->createCommand("DELETE FROM DetalleRequisicion WHERE requisicion_did = " . $id);
					$comandoEliminaDetalle->execute();
					foreach($detalleRequisicion as $detalle)
					{
						$comandoInsertaDetalle = $conection->createCommand("INSERT INTO DetalleRequisicion
							(cantidad, articulo_aid, observaciones, requisicion_did)
							VALUES(:cantidad, :articulo_aid, :observaciones, :requisicion_did)");
						$comandoInsertaDetalle->bindValue(":cantidad", $detalle['cantidad'],PDO::PARAM_STR);

						$comandoInsertaDetalle->bindValue(":articulo_aid",$detalle['articulo'],PDO::PARAM_STR);
						$comandoInsertaDetalle->bindValue(":observaciones",$detalle['observaciones'],PDO::PARAM_STR);
						$comandoInsertaDetalle->bindValue(":requisicion_did",$id,PDO::PARAM_STR);
						$comandoInsertaDetalle->execute();
					}
					Yii::app()->user->setFlash('success', '<strong>Se ha actualizado la requisición correctamente!</strong>');

				$conection->createCommand("INSERT INTO Actividad (mensaje, usuario) Values ('Ha actualizado una requisición', '" . Yii::app()->user->name . "')")->execute();
				$transaction->commit();
				$this->redirect(array('view','id'=>$id));
			}
			catch(Exception $e)
			{
				echo '<pre>';print_r($e); echo "</pre>";
				exit;
				$transaction->rollBack();
				Yii::app()->user->setFlash('warning', '<strong>Hubo un error al actualizar la requisición!</strong>');
			}
		}

		//$unidades_model = Unidad::model()->findAll();
		$unidades = array();
		/*foreach ($unidades_model as $u) {
			$unidades[] = $u->to_array();
		}*/

		$detalle_model = DetalleRequisicion::model()->findAll('requisicion_did = ' . $id);
		$detalle = array();
		foreach ($detalle_model as $d) {
			$detalle[] = $d->to_array(array('articulo'));
		}

		$this->addCss('requisiciones.css');

		$this->render('update',array(
			'model'=>$model,
			'unidades' => $unidades,
			'detalle' => $detalle
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

		$this->render('index');
	}

	public function actionRequisicionesenviadas()
	{

		$requisiciones = Requisicion::model()->findAll();
		$this->render('requisicionesEnviadas',array("requisiciones" => $requisiciones));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Requisicion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Requisicion']))
			$model->attributes=$_GET['Requisicion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCambiarestatus($id)
	{
		$model = $this->loadModel($id);
		$model->estatus_did = $_GET['estatus'];

		if($model->save())
			    $this->redirect(array('index'));
  }

	public function actionGenerar($id)
	{
		$model = $this->loadModel($id);
		$model->estatus_did = $_GET['estatus'];
		$existeCotizacion = Cotizacion::model()->exists('requisicion_did = ' . $model->id);

		if(!$existeCotizacion)
		{
			$modelCotizacion = new Cotizacion;
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Requisicion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='requisicion-form')
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
	       	$cursor = Requisicion::model()->findAll($criteria);
			foreach ($cursor as $valor)
				$result[]=Array('label' => $valor->nombre,
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}

	public function actionGenerarproveedores()
	{
		$this->layout='inside';
		$proveedoresListos = array();
		$proveedores = Proveedor::model()->findAll('estatus_did = 1');
		foreach($proveedores as $proveedor)
		{
		 	$proveedoresListos[]= $proveedor->id . '-' . $proveedor->nombre;
		}
		$this->render("proveedores",array('proveedores'=>$proveedoresListos));
	}

	public function actionImprimir($id)
	{
		$detalleRequisicion = DetalleRequisicion::model()->findAll('requisicion_did = ' . $id);
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha entrado a la vista de impresión de la requisición: " .
												$detalleRequisicion[0]->requisicion->numeroRequisicion . "', '"  .
												Yii::app()->user->name . "')")->execute();
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('L');
		$mPDF1->WriteHTML($this->renderPartial('imprimir', array('model'=> $this->loadModel($id),'detalleRequisicion' => $detalleRequisicion),true),2);
		$mPDF1->Output();
	}

	public function avisarResponsable($id)
	{
		$model= Proveedor::model()->findByPk($id);
		if(isset($model->correo)){
			$body = "UAS solicita que le cotice una requisición";
			Yii::app()->email->send('uasrobot@gmail.com',$model->correo,'UAS: Cotización ' . $model->nombre,$body);
		} else {
			Yii::app()->user->setFlash('warning', '<strong>El proveedor ' . $model->nombre . ' no tiene correo!</strong>');
		}
	}

	public function actionFormcotproves($id){
		$model = $this->loadModel($id);

		if(isset($_POST['Requisicion']) && isset($_POST['Proveedores'])){
			try{

				$requisiconesEnviadas = 0;
				$conection = Yii::app()->db;
				$transaction = $conection->beginTransaction();
				$requisicion = Requisicion::model()->find("id = " . $_POST['Requisicion']["id"]);
				// Insersión a la tabla de seguimiento
				$existeSeguimiento = Seguimiento::model()->exists("requisicion_aid = " . $requisicion->id);


				if($existeSeguimiento){
					date_default_timezone_set('America/Mazatlan');
					$fecha = date('Y-m-d h:i:s a', time());
					$seguimiento = Seguimiento::model()->find("requisicion_aid = " . $requisicion->id);
					if(empty($seguimiento->fechaCotizacion_f)){
						$comandoSeguimiento = $conection->createCommand("UPDATE Seguimiento SET fechaEnvio_f = :fechaEnvio, estatus_did = 2, usuarioEnvio = :usuarioEnvio WHERE requisicion_aid = " .$requisicion->id);
						$comandoSeguimiento->bindValue(":fechaEnvio", date("Y-m-d h:i:s"), PDO::PARAM_STR);
						$comandoSeguimiento->bindValue(":usuarioEnvio", Yii::app()->user->name, PDO::PARAM_STR);
						$comandoSeguimiento->execute();
					}

				}

				// Actualizar la requisición a enviada

				$comandoRequisicion = $conection->createCommand("UPDATE Requisicion SET estatus_did = :estatus_did WHERE id = " . $requisicion->id);
				$comandoRequisicion->bindValue(":estatus_did",2,PDO::PARAM_STR);
				if($comandoRequisicion->execute() || $requisicion->estatus_did == 2)
				{
					// Insertar los proveedores por cotización
					if(isset($_POST['Proveedores']))
					{
						$proveedores = $_POST['Proveedores'];
						foreach($proveedores as $proveedor)
						{
							if(!empty($proveedor) && isset($proveedor))
							{
								$idProveedor = explode("-", $proveedor);
								$proveedorActual = Proveedor::model()->find("codigo=".$idProveedor[0]);
								$existeReqconProveedor = ProveedoresPorRequisicion::model()->exists("estatus_did != 6 && requisicion_aid = :r && proveedor_aid = :p", array(":r"=>$requisicion->id, ":p" => $proveedorActual->id));
								if(!$existeReqconProveedor)
								{

									$sqlProveedor = "INSERT INTO ProveedoresPorRequisicion (requisicion_aid, proveedor_aid, estatus_did, fechaEnvio_ft) VALUES (:requisicion_aid, :proveedor_aid, 2, :fechaEnvio)";
									$comandoProveedor = $conection->createCommand($sqlProveedor);
									$comandoProveedor->bindValue(":proveedor_aid", $proveedorActual->id, PDO::PARAM_INT);
									$comandoProveedor->bindValue(":requisicion_aid", $requisicion->id, PDO::PARAM_INT);
									$comandoProveedor->bindValue(":fechaEnvio", date("Y-m-d H:i:s"), PDO::PARAM_STR);
									if($comandoProveedor->execute())
									{
										$requisiconesEnviadas++;
										Yii::app()->user->setFlash('success', '<strong>La requisición fue enviada!</strong>');
										$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha enviado la requisición: " .
																			$requisicion->numeroRequisicion . " al proveedor " . $proveedorActual->id . "', '"  .
																			Yii::app()->user->name . "')")->execute();
										//Enviar correo al proveedor avisándole de la solicitud de cotización
										$this->avisarResponsable($proveedorActual->id);
										//$this->redirect(array('index'));
									}
									else
									{
										Yii::app()->user->setFlash('warning', '<strong>Hubo error al enviar la cotización!</strong>');
									}
								}
								else
								{
									Yii::app()->user->setFlash('warning', '<strong>El proveedor ' . $idProveedor[1] . ' ya había recibido la requisición!</strong>');
								}
							}
						}
						if($requisiconesEnviadas > 0)
						{
							if($requisiconesEnviadas > 1)
							{
								Yii::app()->user->setFlash('success', '<strong>Los proveedores han recibido la requisición correctamente!</strong>');
							}
							else
							{
								Yii::app()->user->setFlash('success', '<strong>El proveedor ha recibido la requisición correctamente!</strong>');
							}
						}
					}
					$transaction->commit();
					//Revisando el enviar correos.

					$this->redirect(array('index'));
				}
				else
				{
					Yii::app()->user->setFlash('warning', '<strong>Error cambiar el estatus de la requisición!</strong>');
				}
			}
			catch(Exception $e)
			{
				echo '<pre>';print_r($e); echo "</pre>";
				Yii::app()->user->setFlash('warning', '<strong>Hubo un error al intentar enviar la requisición!</strong>');
				$transaction->rollBack();
			}
		}

		$proveedores = Proveedor::model()->findAll('estatus_did = 1');

		$this->render("formcotproves", array("requisicion" => $model, "proveedores"=>$proveedores));
	}

	public function actionVerproveedorespendientes($id){
		$proveedores = ProveedoresPorRequisicion::model()->findAll("requisicion_aid = " . $id);
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha visto los proveedores pendientes de la requisición: " .
																			$proveedores[0]->requisicion->numeroRequisicion . "', '"  .
																			Yii::app()->user->name . "')")->execute();

		$this->render("verproveedorespendientes",array("proveedores"=>$proveedores));
	}

	public function actionSeguimientocontrol(){

		$seguimiento = Seguimiento::model()->find("numeroRequisicion = '" . $_POST["requisicion"] . "'");
		$this->renderPartial('_seguimientocontrol',array(
			'seguimiento'=>$seguimiento,
		));
	}
}
