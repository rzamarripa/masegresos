<?php

class ProyectoController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete'),
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
		if(isset($_POST['Requisicion']) && isset($_POST['Proveedores'])){			
			try{				
				$requisiconesEnviadas = 0;
				$conection = Yii::app()->db;
				$transaction = $conection->beginTransaction();
				// Actualizar la requisición a enviada
				$requisicion = Requisicion::model()->find("id = " . $_POST['Requisicion']["id"]);
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
								$existeReqconProveedor = ProveedoresPorRequisicion::model()->exists("requisicion_aid = :r && proveedor_aid = :p", array(":r"=>$requisicion->id, ":p" => $idProveedor[0]));
								if(!$existeReqconProveedor)
								{
									$sqlProveedor = "INSERT INTO ProveedoresPorRequisicion (requisicion_aid, proveedor_aid, estatus_did) VALUES (:requisicion_aid, :proveedor_aid, 2)";
									$comandoProveedor = $conection->createCommand($sqlProveedor);
									$comandoProveedor->bindParam(":proveedor_aid", $idProveedor[0], PDO::PARAM_STR);
									$comandoProveedor->bindValue(":requisicion_aid", $requisicion->id, PDO::PARAM_INT);
									if($comandoProveedor->execute())
									{
										$requisiconesEnviadas++;
										Yii::app()->user->setFlash('success', '<strong>La requisición fue enviada!</strong>');
										$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha enviado la requisición: " . $requisicion->numeroRequisicion . " al proveedor " . $idProveedor[0] . "', '"  . Yii::app()->user->name . "')")->execute();
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
					$this->redirect(array("view", "id"=>$requisicion->proyecto_aid));
				}
				else
				{
					Yii::app()->user->setFlash('warning', '<strong>Error cambiar el estatus de la requisición!</strong>');
				}
			}
			catch(Exception $e)
			{
				//echo '<pre>';print_r($e); echo "</pre>";
				Yii::app()->user->setFlash('warning', '<strong>Hubo un error al intentar enviar la requisición!</strong>');
				$transaction->rollBack();
			}
		}
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Proyecto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proyecto']))
		{
			$model->attributes=$_POST['Proyecto'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proyecto']))
		{
			$model->attributes=$_POST['Proyecto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		
		
		$dataProvider=new CActiveDataProvider('Proyecto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proyecto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proyecto']))
			$model->attributes=$_GET['Proyecto'];

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
		$model=Proyecto::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='proyecto-form')
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
	       	$cursor = Proyecto::model()->findAll($criteria);
			foreach ($cursor as $valor)	
				$result[]=Array('label' => $valor->nombre,  
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}

}
