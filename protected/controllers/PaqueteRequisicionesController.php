<?php

class PaqueteRequisicionesController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','agregarrequisiciones','cambiarestatus','imprimir','imprimirrelacion'),
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
		$detalle = Paqueterequisicionesdetalle::model()->findAll("paqueterequisicion_did = " .$id);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'detalle'=>$detalle,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Paqueterequisiciones;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PaqueteRequisiciones']))
		{
			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			$model->attributes=$_POST['PaqueteRequisiciones'];
			$model->estatus_did = 1;
			$model->usuario_did = $usuarioActual->id;
			if($model->save())
				$this->redirect(array('agregarrequisiciones','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionAgregarrequisiciones($id){
		$paquete = PaqueteRequisiciones::model()->find("id = ".  $_GET["id"]);
		if(isset($_POST["Requisiciones"])){
			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			if($paquete->enviadoa== 0){				
				foreach($_POST["Requisiciones"] as $requisicion){
					$requisicion = Requisicion::model()->find("numeroRequisicion = " . $requisicion);
					$requisicion->enpaquete = 1;
					$requisicion->save();
					$modelDetalle = new paqueterequisicionesdetalle;
					$modelDetalle->paqueteRequisicion_did = $id;
					$modelDetalle->requisicion_did = $requisicion->id;
					$modelDetalle->usuario_did = $usuarioActual->id;
					$modelDetalle->estatus_did = 1;
					$modelDetalle->enviadoa = 0;
					
						
					$modelDetalle->save();
				}
				$this->redirect(array('view','id'=>$id));
			}else if($paquete->enviadoa==1){
				foreach($_POST["Requisiciones"] as $requisicion){
					$requisicion = Requisicion::model()->find("numeroRequisicion = " . $requisicion);
					$detallePaquete = PaqueteRequisicionesDetalle::model()->find("requisicion_did = " . $requisicion->id);
					$detallePaquete->estatus_did = 3;
					$detallePaquete->save();
					
					$modelDetalle = new paqueterequisicionesdetalle;
					$modelDetalle->paqueteRequisicion_did = $id;
					$modelDetalle->requisicion_did = $requisicion->id;
					$modelDetalle->usuario_did = $usuarioActual->id;
					$modelDetalle->estatus_did = 4;
					$modelDetalle->enviadoa = 1;
					$modelDetalle->save();
				}
			}
		}
		
		
		// Enviadoa pagos = 1 y enviadoa almacen = 0
		if($paquete->enviadoa == 0){
			$requisiciones = Requisicion::model()->findAll("enpaquete = 0 and estatus_did = 4");
			$this->render("agregarreq",array("paquete"=>$paquete, "requisiciones"=>$requisiciones));
		}else if($paquete->enviadoa == 1){
			$detallePaquetes = PaqueteRequisicionesDetalle::model()->findAll("estatus_did = 2");
			$this->render("agregarreqpagos",array("paquete"=>$paquete, "detallePaquetes"=>$detallePaquetes));			
		}
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

		if(isset($_POST['PaqueteRequisiciones']))
		{
			$model->attributes=$_POST['PaqueteRequisiciones'];
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
		$detalle = PaqueteRequisicionesDetalle::model()->findAll("paqueteRequisicion_did = " . $id);
		foreach($detalle as $d){
			$requisicion = Requisicion::model()->findByPK($d->requisicion_did);
			$requisicion->enpaquete = 0;
			$requisicion->save();
		}
		Yii::app()->db->createCommand("Delete From paqueterequisicionesdetalle where paqueteRequisicion_did = ".  $id)->execute();
		Yii::app()->db->createCommand("Delete From paqueterequisiciones where id = " . $id)->execute();
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PaqueteRequisiciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Paqueterequisiciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PaqueteRequisiciones']))
			$model->attributes=$_GET['PaqueteRequisiciones'];

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
		$model=Paqueterequisiciones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paqueterequisiciones-form')
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
	       	$cursor = Paqueterequisiciones::model()->findAll($criteria);
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

		if($model->save()){
			if($model->estatus_did == 2){
				Yii::app()->user->setFlash('success', '<strong>Se envió el paquete ' . $model->nombre . ' a Almacén!</strong>');
			}else if($model->estatus_did == 3){
				Yii::app()->db->createCommand("update paqueterequisicionesdetalle set estatus_did = 2 where paqueteRequisicion_did = " . $model->id)->execute();
				Yii::app()->user->setFlash('success', '<strong>Se devolvió el paquete ' . $model->nombre . ' a Compras!</strong>');
				$this->redirect(array('paqueterequisiciones/admin'));
			}else if($model->estatus_did == 4){
				Yii::app()->db->createCommand("update paqueterequisicionesdetalle set estatus_did = 3 where paqueteRequisicion_did = " . $model->id)->execute();
				Yii::app()->user->setFlash('success', '<strong>Se cerró el paquete ' . $model->nombre . '!</strong>');
			}

			$this->redirect(array('index'));
		}

  }
  public function actionImprimir($id){
  	$detallePaquete = PaqueteRequisicionesDetalle::model()->findAll('paqueteRequisicion_did = ' . $id);
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		foreach($detallePaquete as $detalle){
			$requisicion = Requisicion::model()->find("id = " . $detalle->requisicion_did);
			$detalleRequisicion = DetalleRequisicion::model()->findAll('requisicion_did = ' . $requisicion->id);
			$mPDF1->AddPage('L');
			$mPDF1->WriteHTML($this->renderPartial('imprimirreq', array('model'=> $requisicion,'detalleRequisicion' => $detalleRequisicion),true),2);
		}

		$mPDF1->Output();
	}

	public function actionImprimirrelacion($id){
		$requisicion = PaqueteRequisiciones::model()->find("id = " . $id);
  	$detallePaquete = PaqueteRequisicionesDetalle::model()->findAll('paqueteRequisicion_did = ' . $id);
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('L');
		$mPDF1->WriteHTML($this->renderPartial('imprimirrelacion', array('model'=> $requisicion,'detallePaquete' => $detallePaquete),true),2);

		$mPDF1->Output();
	}

}
