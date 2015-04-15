<?php

class PaqueterequisicionesdetalleController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','cambiarestatus'),
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
		$model=new Paqueterequisicionesdetalle;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Paqueterequisicionesdetalle']))
		{
			$model->attributes=$_POST['Paqueterequisicionesdetalle'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Paqueterequisicionesdetalle']))
		{
			$model->attributes=$_POST['Paqueterequisicionesdetalle'];
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
		try{
			$detalle = $this->loadModel($id);
			
			$requisicion = Requisicion::model()->find("id = " . $detalle->requisicion_did);
			$requisicion->enpaquete = 0;
			$requisicion->save();
			$paquete = $detalle->paqueteRequisicion_did;
			$detalle->delete();
				$this->redirect(array('paqueterequisiciones/view', 'id'=>$paquete));
		}catch(Exception $e){
			echo $e->getMessage();
		}
			
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Paqueterequisicionesdetalle');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Paqueterequisicionesdetalle('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paqueterequisicionesdetalle']))
			$model->attributes=$_GET['Paqueterequisicionesdetalle'];

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
		$model=Paqueterequisicionesdetalle::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paqueterequisicionesdetalle-form')
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
	       	$cursor = Paqueterequisicionesdetalle::model()->findAll($criteria);
			foreach ($cursor as $valor)	
				$result[]=Array('label' => $valor->nombre,  
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}
	
	public function actionCambiarestatus($id)
	{
		$model = $this->loadModel($id);		
		$model->estatus_did = $_GET['estatus'];
		// Verifico si es la última
		$detalle = PaqueteRequisicionesDetalle::model()->findAll("estatus_did = 1 && paqueteRequisicion_did = " . $model->paqueteRequisicion_did);

		if(count($detalle)==1){
			$paquete = PaqueteRequisiciones::model()->find("id = " . $model->paqueteRequisicion_did);
			$paquete->estatus_did = 3;
			$paquete->update();
		}else if(count($detalle)== 0){
			$paquete = PaqueteRequisiciones::model()->find("id = " . $model->paqueteRequisicion_did);
			$paquete->estatus_did = 2;
			$paquete->update();
		}
		if($model->save())
			    $this->redirect(array('paqueterequisiciones/view','id'=>$model->paqueteRequisicion_did));
  }

}
