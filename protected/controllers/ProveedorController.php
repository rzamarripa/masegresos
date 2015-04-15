<?php

class ProveedorController extends Controller
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
				'actions'=>array('autocompletesearch', 'autocompletesearchInventario'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete','dashboard','cambiarestatus','mostrardocumentos','pasivoporproveedor','getproveedores'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users'
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
		$model=new Proveedor;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];

            if($model->validate()){
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
            }
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

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
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
		/*
$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];
		$this->render('index',array(
			'model'=>$model,
		));
*/
		$dataProvider=new CActiveDataProvider('Proveedor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];

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
		$model=Proveedor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='proveedor-form')
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
			$criteria->select=array('id', 'codigo', "CONCAT_WS(' ',nombre) as nombre");
			$criteria->condition="lower(CONCAT_WS(' ',nombre)) like lower(:nombre) OR codigo like :nombre";
			$criteria->params=array(':nombre'=>$q);
			$criteria->limit='10';
	       	$cursor = Proveedor::model()->findAll($criteria);
			foreach ($cursor as $valor)
				$result[]=Array('label' => $valor->nombre,
				                'value' => $valor->nombre,
				                'id' => $valor->id,
				                'codigo' => $valor->codigo );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}



	public function actionAutocompletesearchInventario()
	{
	    $q = "%". $_GET['term'] ."%";
	 	$result = array();
	    if (!empty($q))
	    {
			$criteria=new CDbCriteria;
			$criteria->select=array('id', 'codigo', "CONCAT_WS('- ',codigo,nombre) as nombre");
			$criteria->condition="lower(CONCAT_WS('- ',codigo,nombre)) like lower(:nombre) OR codigo like :nombre";
			$criteria->params=array(':nombre'=>$q);
			$criteria->limit='10';
	       	$cursor = Proveedor::model()->findAll($criteria);
			foreach ($cursor as $valor)
				$result[]=Array('label' => $valor->nombre,
				                'value' => $valor->nombre,
				                'id' => $valor->id,
				                'codigo' => $valor->codigo );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}


    public function actionDashboard($proveedorId) {
        //$requisicionesProveedor = ProveedoresPorRequisicion::model()->findAll('proveedor_aid=:pid && estatus_did!=6',array(':pid'=>$proveedorId));
        //$cotizacionesProveedor = Cotizacion::model()->findAll("proveedor_aid = " . $proveedorId);
        //$requisicionesEliminadas = ProveedoresPorRequisicion::model()->findAll('proveedor_aid=:pid && estatus_did=6',array(':pid'=>$proveedorId));

        $cotizacionesPendientes = ProveedoresPorRequisicion::model()->findAll('proveedor_aid=:pid && estatus_did=2',array(':pid'=>$proveedorId));
        $cotizacionesCotizadas = Cotizacion::model()->findAll('proveedor_aid=:pid && estatus_did=3',array(':pid'=>$proveedorId));
        $cotizacionesAceptadas = Cotizacion::model()->findAll('proveedor_aid=:pid && estatus_did=4',array(':pid'=>$proveedorId));
        $cotizacionesEliminadas = ProveedoresPorRequisicion::model()->findAll('proveedor_aid=:pid && estatus_did=6',array(':pid'=>$proveedorId));

        $this->render('dashboard',array('cotizacionesPendientes'=>$cotizacionesPendientes
                                        ,'cotizacionesCotizadas'=>$cotizacionesCotizadas
                                        ,'cotizacionesAceptadas'=>$cotizacionesAceptadas
                                        ,'cotizacionesEliminadas'=>$cotizacionesEliminadas));
    }

    public function actionCambiarestatus($id){
        $model = ProveedoresPorRequisicion::model()->find('requisicion_aid=:rId && proveedor_aid=:pId',array('rId'=>$id,'pId'=>$_GET['proveedorId']));
        $model->estatus_did = $_GET['estatus'];

		if($model->save())
			    $this->redirect(array('dashboard', "proveedorId" => $_GET['proveedorId']));
    }



    public function actionMostrardocumentos($id){
        $cotizaciones = Cotizacion::model()->findAll('proveedor_aid=' . $id);
        $ordenesCompra = OrdenCompra::model()->findAll('proveedor_aid=' . $id);
        $contrarecibo = Contrarecibo::model()->findAll('proveedor_did = ' . $id);

        if(isset($cotizaciones) && isset($ordenesCompra) && isset($contrarecibo))
        {
            $modelCotizacion=new Cotizacion('search');
		    $modelCotizacion->unsetAttributes();  // clear any default values
		    if(isset($_GET['Cotizacion']))
			    $modelCotizacion->attributes=$_GET['Cotizacion'];

            $modelOrdenCompra=new OrdenCompra('search');
		    $modelOrdenCompra->unsetAttributes();  // clear any default values
		    if(isset($_GET['OrdenCompra']))
			    $modelOrdenCompra->attributes=$_GET['OrdenCompra'];

		    $modelContrarecibo=new Contrarecibo('search');
		    $modelContrarecibo->unsetAttributes();  // clear any default values
		    if(isset($_GET['Contrarecibo']))
			    $modelContrarecibo->attributes=$_GET['Contrarecibo'];

            $this->render('documentosPorProveedor',array(
			    'modelCotizacion'=>$modelCotizacion,
                'modelOrdenCompra'=>$modelOrdenCompra,
                'modelContrarecibo'=>$modelContrarecibo,
                'cotizaciones'=>$cotizaciones,
                'ordenesCompra'=>$ordenesCompra,
                'contrarecibo'=>$contrarecibo,
                'id'=>$id,
		    ));
        }
    }

    public function actionPasivoporproveedor()
	{
		$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];

		$this->render('pasivoporproveedor',array(
			'model'=>$model,
		));
	}
}