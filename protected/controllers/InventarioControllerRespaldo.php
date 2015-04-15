<?php

class InventarioController extends Controller
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
				'actions'=>array('autocompletesearch', 'pdf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete', 'imprimir','updateinventario', 'impresguardo', 'implistadoinv'),
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
		$model=new Inventario;

		// Uncomment the following line if AJAX validation is needed
		 //$this->performAjaxValidation($model);

		if(isset($_POST['Inventario']) && isset($_POST['detalle']))
		{
            $transaction=$model->dbConnection->beginTransaction();
            try{
				$model->attributes=$_POST['Inventario'];
                echo '<pre>';print_r($_POST); echo "</pre>";
				exit;
				
            }catch(Exception $e){
                $transaction->rollBack();
                echo '<pre>';print_r($e); echo "</pre>";
            }
		}
        
        $model->ejercicio = date("Y");
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

		if(isset($_POST['Inventario']))
		{
			$model->attributes=$_POST['Inventario'];
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
		$dataProvider=new CActiveDataProvider('Inventario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Inventario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inventario']))
			$model->attributes=$_GET['Inventario'];

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
		$model=Inventario::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventario-form')
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
	       	$cursor = Inventario::model()->findAll($criteria);
			foreach ($cursor as $valor)	
				$result[]=Array('label' => $valor->nombre,  
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}

	public function actionImprimir($id)
	{		
		$this->render('imprimir', array('id'=>$id));
	}
	
	public function actionUpdateinventario($id)
    {    	
    	if(isset($_POST["inventario"]))
    	{
	    	$uo = explode("-", $_POST["inventario"]);	    	

    		if($id=="1" || $id=="2" )
    		{
		    	$uo = explode("-", $_POST["inventario"]);	  	
		    	switch($id){
		    		case "1":
		    			$inventarios = Inventario::model()->findAll("unidadOrganizacional_aid = ".$uo[0]." order by id");
		    			break;
		    		case "2":
		    			$inventarios = Inventario::model()->findAll(array('order'=>'unidadOrganizacional_aid', 'condition'=>"unidadOrganizacional_aid = ".$uo[0]));
		    			break;
		    	}		    	
		    	if(count($inventarios) > 0){
		    		switch($id){
		    			case "1":
		    				$this->renderPartial('_resguardos', array('inventarios' => $inventarios, 'uo'=>$uo[0]));
		    				break;
		    			case "2":
		    				$this->renderPartial('_listadoinv', array('inventarios' => $inventarios, 'uo'=>$uo[0]));
		    				break;
		    		}
		    	}		    	
			    else
			    {
			    	echo '<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4>Mensaje:</h4>	
							No se encontraron resguardos para la UO: '. $uo[1] .' .
	   						</div>';
			    }
	    	}
    	}
    }

	public function actionImpresguardo()
	{ 
		/*$unidadOrg=unidadOrganizacional::model()->findByPk($_GET['uo']);
		$inventarios = Inventario::model()->findAll("unidadOrganizacional_aid = ".$_GET['uo']." order by id");
		$this->layout = "pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$mPDF1->WriteHTML($this->render('impresguardo', array('inventarios' => $inventarios, 'unidadOrg'=>$unidadOrg), true));
		$mPDF1->Output();*/

		$unidadOrg=unidadOrganizacional::model()->findByPk($_GET['uo']);
		$inventarios = Inventario::model()->findAll("unidadOrganizacional_aid = ".$_GET['uo']." order by id");
		$this->layout = "pdf";		
		$this->render('impresguardo', array('inventarios' => $inventarios, 'unidadOrg'=>$unidadOrg));
	}

	public function actionImplistadoinv()
	{ 
		$unidadOrg=unidadOrganizacional::model()->findByPk($_GET['uo']);
		$inventarios = Inventario::model()->findAll(array('order'=>'funcion_aid', 'condition'=>"unidadOrganizacional_aid = ".$_GET['uo']));
		$this->layout = "pdf";		
		$this->render('implistadoinv', array('inventarios' => $inventarios, 'unidadOrg'=>$unidadOrg));
	}

	public function actionPdf()
	{ 
		$this->render('pdf');
	}
}
