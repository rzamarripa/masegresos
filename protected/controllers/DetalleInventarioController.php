<?php

class DetalleInventarioController extends Controller
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
		$model=new DetalleInventario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DetalleInventario']))
		{
			$model->attributes=$_POST['DetalleInventario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		//Guardo las Articulos en caché para que se cargue más rápido
		$sqlArticulo = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Articulo ORDER BY nombre ASC';
		$dependencyArticulo = new CDbCacheDependency('SELECT MAX(id) FROM Articulo');
		$articulos = Yii::app()->db->cache(3600*24, $dependencyArticulo)->createCommand($sqlArticulo)->queryAll();
		
		//Guardo las Marca en caché para que se cargue más rápido
		$sqlMarca = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Marca ORDER BY nombre ASC';
		$dependencyMarca = new CDbCacheDependency('SELECT MAX(id) FROM Marca');
		$marcas = Yii::app()->db->cache(3600*24, $dependencyMarca)->createCommand($sqlMarca)->queryAll();
		
		//Guardo las UOs en caché para que se cargue más rápido
		$sql = 'SELECT id, CONCAT(codigo, " - ", nombre) AS nombre FROM UnidadOrganizacional ORDER BY nombre ASC';
		$dependency = new CDbCacheDependency('SELECT MAX(id) FROM UnidadOrganizacional');
		$uos = Yii::app()->db->cache(3600*24, $dependency)->createCommand($sql)->queryAll();
		
		//Guardo las Funciones en caché para que se cargue más rápido
		$sqlFuncion = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Funcion ORDER BY nombre ASC';
		$dependencyFuncion = new CDbCacheDependency('SELECT MAX(id) FROM Funcion');
		$funciones = Yii::app()->db->cache(3600*24, $dependencyFuncion)->createCommand($sqlFuncion)->queryAll();

		$this->render('create',array(
			'model'=>$model,
			'articulos'=>$articulos,
			'marcas'=>$marcas,
			'uos'=>$uos,
			'funciones'=>$funciones,
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

		if(isset($_POST['DetalleInventario']))
		{
			$model->attributes=$_POST['DetalleInventario'];
			if($model->save()){
				Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha actualizado el inventario " . $model->id . "', '" . Yii::app()->user->name . "')")->execute();
				Yii::app()->user->setFlash('success', '<strong>El inventario se ha actualizado correctamente!</strong>');
				$this->redirect(array('view','id'=>$model->id));
			}				
		}

		//Guardo las Articulos en caché para que se cargue más rápido
		$sqlArticulo = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Articulo ORDER BY nombre ASC';
		$dependencyArticulo = new CDbCacheDependency('SELECT MAX(id) FROM Articulo');
		$articulos = Yii::app()->db->cache(3600*24, $dependencyArticulo)->createCommand($sqlArticulo)->queryAll();
		
		//Guardo las Marca en caché para que se cargue más rápido
		$sqlMarca = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Marca ORDER BY nombre ASC';
		$dependencyMarca = new CDbCacheDependency('SELECT MAX(id) FROM Marca');
		$marcas = Yii::app()->db->cache(3600*24, $dependencyMarca)->createCommand($sqlMarca)->queryAll();
		
		//Guardo las UOs en caché para que se cargue más rápido
		$sql = 'SELECT id, CONCAT(codigo, " - ", nombre) AS nombre FROM UnidadOrganizacional ORDER BY nombre ASC';
		$dependency = new CDbCacheDependency('SELECT MAX(id) FROM UnidadOrganizacional');
		$uos = Yii::app()->db->cache(3600*24, $dependency)->createCommand($sql)->queryAll();
		
		//Guardo las Funciones en caché para que se cargue más rápido
		$sqlFuncion = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Funcion ORDER BY nombre ASC';
		$dependencyFuncion = new CDbCacheDependency('SELECT MAX(id) FROM Funcion');
		$funciones = Yii::app()->db->cache(3600*24, $dependencyFuncion)->createCommand($sqlFuncion)->queryAll();
		
		$this->render('update',array(
			'model'=>$model,
			'articulos'=>$articulos,
			'marcas'=>$marcas,
			'uos'=>$uos,
			'funciones'=>$funciones,
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
		$dataProvider=new CActiveDataProvider('DetalleInventario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DetalleInventario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DetalleInventario']))
			$model->attributes=$_GET['DetalleInventario'];

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
		$model=DetalleInventario::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='detalle-inventario-form')
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
	       	$cursor = DetalleInventario::model()->findAll($criteria);
			foreach ($cursor as $valor)	
				$result[]=Array('label' => $valor->nombre,  
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}
	

}
