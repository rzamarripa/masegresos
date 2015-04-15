<?php

class ContrareciboController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete',
									'imprimir','verfacturasproveedor','verpasivogeneral','formcheque','verpagadasproveedor',
									'Imprimirpasivogeneral','imprimirdetallefacturas','cancelarfactura',
									'facturaspendientes', 'imprimirfacturas','mostrarfacturaspendientes',
									'imprimirfacturaspendientes'),
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
		/*
echo '<pre>';print_r($_POST); echo "</pre>";
		exit;
*/
		if(isset($_POST["DetalleContrarecibo"]))
		{
			$model = DetalleContrarecibo::model()->find("id = " . $_POST["DetalleContrarecibo"]["id"]);
			if($_POST["DetalleContrarecibo"]["estatus_did"] == 1)
			{
				$model->estatus_did = 2;
				$model->cheque = $_POST["DetalleContrarecibo"]["cheque"];
			}
			else
			{
				$model->estatus_did = 1;
				$model->cheque = "";
			}
			$model->save();
			$detallePendiente = DetalleContrarecibo::model()->count("estatus_did = 1 && ordenCompra_did = " . $model->ordenCompra_did);
			if($detallePendiente == 0){
				$modelOrdenCompra = OrdenCompra::model()->find("id = " . $model->ordenCompra_did);
				$modelOrdenCompra->estatus_did = 3;
				$modelOrdenCompra->save();
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
		$model=new Contrarecibo;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Contrarecibo']))
		{
			//echo '<pre>';print_r($_POST); echo "</pre>";exit;
			try
			{
				$connection = Yii::app()->db;
				$transaction=$connection->beginTransaction();
			    $comandoContrarecibo = $connection->createCommand("INSERT INTO Contrarecibo
			    												(proveedor_did, fecha_f)
																VALUES (:proveedor_did, :fecha_f);");
				$comandoContrarecibo->bindValue(":proveedor_did",$_POST["Contrarecibo"]["proveedor_did"][0]["id"],PDO::PARAM_INT);
				$comandoContrarecibo->bindValue(":fecha_f",$_POST["Contrarecibo"]["fecha_f"],PDO::PARAM_STR);
				$comandoContrarecibo->execute();
				$proyectoId = NULL;
				if(isset($_GET["p"]))
					$proyectoId = $_GET["p"];

				$criteria = new CDbCriteria;
				$criteria->select='MAX(id) as id';
				$contrarecibo = Contrarecibo::model()->find($criteria);

				$ordenes = $_POST["Contrarecibo"]["ordenes"];
				//echo '<pre>';print_r($ordenes); echo "</pre>";
				//exit;
				foreach($ordenes as $orden)
				{
					if(isset($orden["facturas"]))
					{
						$facturas = $orden["facturas"];
						$ordenDB = OrdenCompra::model()->find("id = " . $orden["id"]);
						$comandoOrdenCompra = $connection->createCommand("UPDATE OrdenCompra SET estatus_did = 2 WHERE id = " . $orden["id"]);
						$comandoOrdenCompra->execute();
						foreach($facturas as $factura)
						{
							$comandoDetalleContrarecibo = $connection->createCommand("INSERT INTO DetalleContrarecibo
				    												(contrarecibo_did, ordenCompra_did, numeroOrdenCompra, fechaOrdenCompra_f,
				    												subtotal, iva, total, numeroFactura, fechaFactura_f, totalFactura, estatus_did, proyecto_aid) VALUES (:contrarecibo_did, :ordenCompra_did, :numeroOrdenCompra, :fechaOrdenCompra_f, :subtotal, :iva, :total, :numeroFactura, :fechaFactura_f, :totalFactura, :estatus_did, :proyecto_aid)");
				    		$comandoDetalleContrarecibo->bindValue(":contrarecibo_did",		$contrarecibo->id,				PDO::PARAM_INT);
							$comandoDetalleContrarecibo->bindValue(":ordenCompra_did",		$ordenDB->id,					PDO::PARAM_INT);
							$comandoDetalleContrarecibo->bindValue(":numeroOrdenCompra",	$ordenDB->numeroOrdenCompra,	PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":fechaOrdenCompra_f",	$ordenDB->fecha_f,				PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":subtotal",				$ordenDB->subtotal,				PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":iva",					$ordenDB->iva,					PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":total",				$ordenDB->total,				PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":numeroFactura",		$factura["numeroFactura"],		PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":fechaFactura_f",		$factura["fechaFactura_f"],		PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":totalFactura",			$factura["totalFactura"],		PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":estatus_did",			1,								PDO::PARAM_INT);
							$comandoDetalleContrarecibo->bindValue(":proyecto_aid",			$proyectoId,					PDO::PARAM_INT);
							$comandoDetalleContrarecibo->execute();
						}
					}
				}
				//$connection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha generado el contrarecibo: " . $contrarecibo->id . "', '" . Yii::app()->user->name . "')")->execute();
			    $transaction->commit();
			    $this->redirect(array("contrarecibo/imprimir/". $contrarecibo->id));
			}
			catch(Exception $e)
			{
				echo '<pre>';print_r($e); echo "</pre>";
			    $transaction->rollBack();
			    exit;
			}
		}

		$proveedores_model = Proveedor::model()->findAll();
		$proveedores = array();
		foreach ($proveedores_model as $p) {
			$proveedores[] = array(
				'id' => $p->id,
				'codigo' => $p->codigo,
				'nombre' => $p->nombre
			);
		}

		$this->addCss('contrarecibos.css');

		$this->render('create',array(
			'model'=>$model,
			'proveedores'=>$proveedores
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

		if(isset($_POST['Contrarecibo']))
		{
			try
			{
				//echo '<pre>'; print_r($_POST['Contrarecibo']); echo '</pre>'; exit;
				/*
					 Para Actualizar el contrarecibo

					 1.- Actualizar el encabezado
					 2.- Poner las órdenes de compra en 1
					 3.- Borrar el detalle del contrarecibo
					 4.- Insertar el detalle nuevo del contrarecibo
					 5.- Actualizar las órdenes de compra en 3
				*/
				$connection = Yii::app()->db;
				$transaction=$connection->beginTransaction();
			    $comandoContrarecibo = $connection->createCommand("UPDATE Contrarecibo SET
			    												fecha_f = :fecha_f
			    												WHERE id = :id");
				$comandoContrarecibo->bindValue(":fecha_f",$_POST["Contrarecibo"]["fecha_f"],PDO::PARAM_STR);
				$comandoContrarecibo->bindValue(":id",$model->id,PDO::PARAM_INT);
				$comandoContrarecibo->execute();

				$ordenes = $_POST["Contrarecibo"]["ordenes"];
				foreach($ordenes as $orden)
				{
					$comandoOrdenCompra = $connection->createCommand("UPDATE OrdenCompra SET
			    												estatus_did = 1 WHERE id = :id");
					$comandoOrdenCompra->bindValue(":id",$orden["id"],PDO::PARAM_INT);
					$comandoOrdenCompra->execute();
				}
				//Borrar el detalle del contrarecibo.
				$comandoDetalleContrarecibo = $connection->createCommand("DELETE FROM DetalleContrarecibo WHERE contrarecibo_did = :id");
				$comandoDetalleContrarecibo->bindValue(":id",$model->id,PDO::PARAM_INT);
				$comandoDetalleContrarecibo->execute();

				$ordenes = $_POST["Contrarecibo"]["ordenes"];
				//Insertar el detalle nuevo
				foreach($ordenes as $orden)
				{
					if(isset($orden["facturas"]))
					{
						$facturas = $orden["facturas"];
						$ordenDB = OrdenCompra::model()->find("id = " . $orden["id"]);
						$comandoOrdenCompra = $connection->createCommand("UPDATE OrdenCompra SET estatus_did = 2 WHERE id = " . $orden["id"]);
						$comandoOrdenCompra->execute();
						foreach($facturas as $factura)
						{
							$comandoDetalleContrarecibo = $connection->createCommand("INSERT INTO DetalleContrarecibo
				    												(contrarecibo_did, ordenCompra_did, numeroOrdenCompra, fechaOrdenCompra_f,
				    												subtotal, iva, total, numeroFactura, fechaFactura_f, totalFactura, estatus_did)
																	VALUES (:contrarecibo_did, :ordenCompra_did, :numeroOrdenCompra, :fechaOrdenCompra_f,
				    												:subtotal, :iva, :total, :numeroFactura, :fechaFactura_f, :totalFactura, :estatus_did)");
				    		$comandoDetalleContrarecibo->bindValue(":contrarecibo_did",			$model->id,						PDO::PARAM_INT);
							$comandoDetalleContrarecibo->bindValue(":ordenCompra_did",			$ordenDB->id,					PDO::PARAM_INT);
							$comandoDetalleContrarecibo->bindValue(":numeroOrdenCompra",		$ordenDB->numeroOrdenCompra,	PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":fechaOrdenCompra_f",		$ordenDB->fecha_f,				PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":subtotal",					$ordenDB->subtotal,				PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":iva",						$ordenDB->iva,					PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":total",					$ordenDB->total,				PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":numeroFactura",			$factura["numeroFactura"],		PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":fechaFactura_f",			$factura["fechaFactura_f"],		PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":totalFactura",				$factura["totalFactura"],		PDO::PARAM_STR);
							$comandoDetalleContrarecibo->bindValue(":estatus_did",				1,								PDO::PARAM_INT);
							$comandoDetalleContrarecibo->execute();
						}
					}
				}
				$connection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha actualizado el contrarecibo: " . $id . "', '" . Yii::app()->user->name . "')")->execute();
				$transaction->commit();
			    $this->redirect(array("contrarecibo/index"));
			}
			catch(Exception $e)
			{
				echo '<pre>';print_r($e); echo "</pre>";
			    $transaction->rollBack();
			    exit;
			}
		}

		$proveedores_model = Proveedor::model()->findAll();
		$proveedores = array();
		foreach ($proveedores_model as $p) {
			$proveedores[] = array(
				'id' => $p->id,
				'codigo' => $p->codigo,
				'nombre' => $p->nombre
			);
		}

		$detalle_model = DetalleContrarecibo::model()->findAll('contrarecibo_did = ' . $id);
		$detalle = array();
		foreach ($detalle_model as $d) {
			if (array_key_exists($d->ordenCompra_did, $detalle)) {
				$detalle[$d->ordenCompra_did]['facturas'][] = $d->factura_to_array();
			} else {
				$detalle[$d->ordenCompra_did] = $d->to_array();
			}
		}

		$ordenes_model = OrdenCompra::model()->findAll("proveedor_aid = {$model->proveedor_did} AND estatus_did=1 ORDER BY fecha_f ASC");
		foreach ($ordenes_model as $o) {
			$orden = $o->to_array();
			$orden['ordenCompra_did'] = $o->id;
			array_push($detalle, $orden);
		}

		$this->addCss('contrarecibos.css');

		$this->render('update',array(
			'model'=>$model,
			'proveedores' => $proveedores,
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
			$connection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha eliminado el contrarecibo: " . $id . "', '" . Yii::app()->user->name . "')")->execute();
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
			$dataProvider=new CActiveDataProvider('Contrarecibo');
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		*/
		$model=new Contrarecibo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contrarecibo']))
			$model->attributes=$_GET['Contrarecibo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contrarecibo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contrarecibo']))
			$model->attributes=$_GET['Contrarecibo'];

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
		$model=Contrarecibo::model()->findByPk($id);
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
		//print_r($model->attributes); exit;
		//print_r($_POST); exit;
		if(isset($_POST['ajax']) && $_POST['ajax']==='contrarecibo-form')
		{
			//echo CActiveForm::validate($model, null, false);
			//$model->attributes = $_POST['Contrarecibo'];
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
	       	$cursor = Contrarecibo::model()->findAll($criteria);
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
		$detalleContrarecibo = DetalleContrarecibo::model()->findAll("contrarecibo_did = " . $id);
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('imprimir', array('model'=> $this->loadModel($id),'detalleContrarecibo'=>$detalleContrarecibo),true),2);
		$mPDF1->Output();
	}

	public function actionVerfacturasproveedor(){
		$proveedores = Yii::app()->db->createCommand("Select distinct c.proveedor_did as id, p.nombre as proveedor from Contrarecibo c
																Inner join Proveedor as p on p.id = c.proveedor_did")->queryAll();
		if(isset($_POST["proveedor"])){
			$detalleFacturas = array();
			if(isset($_GET["tipo"]) && $_GET["tipo"] == "pendientes"){
				$detalleFacturas = $this->getPendientesPorProveedor($_POST["proveedor"]);
			} else if(isset($_GET["tipo"]) && $_GET["tipo"] == "pagadas"){
				$detalleFacturas = $this->getPagadasPorProveedor($_POST["proveedor"]);
			} else if(isset($_GET["tipo"]) && $_GET["tipo"] == "ambos"){
				$detalleFacturas = $this->getAmbasPorProveedor($_POST["proveedor"]);
			}

			$this->renderPartial("detallefacturas",array("facturas" => $detalleFacturas));

		} else{
			$this->render("verfacturasproveedor",array('proveedores' => $proveedores));
		}

	}



	public function actionImprimirdetallefacturas($id){
		$this->layout="pdf";
		$detalleFacturas = $this->getAmbasPorProveedor($id);
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('L');
		$mPDF1->WriteHTML($this->renderPartial("imprimirdetallefacturas",array("facturas" => $detalleFacturas),true),2);
		$mPDF1->Output();
		;
	}

	public function getPendientesPorProveedor($provId){
		$detalleFacturas = array();
		$facturas = Contrarecibo::model()->findAll("proveedor_did = " . $provId);
		foreach($facturas as $factura)
		{
			$detalleFactura = DetalleContrarecibo::model()->findAll("estatus_did = 1 && contrarecibo_did = " . $factura->id);
			foreach($detalleFactura as $detalle){
				$detalleFacturas[] = array("id" => $detalle->id,
													"numeroOrdenCompra" => $detalle->numeroOrdenCompra,
													"fechaOrdenCompra" => $detalle->fechaOrdenCompra_f,
													"subtotal" => $detalle->subtotal,
													"iva" => $detalle->iva,
													"total" => $detalle->total,
													"estatus" => $detalle->estatus->contrarecibo,
													"numeroFactura" => $detalle->numeroFactura,
													"fechaFactura" => $detalle->fechaFactura_f,
													"totalFactura" => $detalle->totalFactura,
													"proveedor" => $detalle->contrarecibo->proveedor_did,
													"proveedorNombre" => $detalle->contrarecibo->proveedor->nombre);
			}
		}
		return $detalleFacturas;
	}

	public function getPagadasPorProveedor($provId){
		$detalleFacturas = array();
		$facturas = Contrarecibo::model()->findAll("proveedor_did = " . $provId);
		foreach($facturas as $factura)
		{
			$detalleFactura = DetalleContrarecibo::model()->findAll("estatus_did = 2 && contrarecibo_did = " . $factura->id);
			foreach($detalleFactura as $detalle){
				$detalleFacturas[] = array("id" => $detalle->id,
													"numeroOrdenCompra" => $detalle->numeroOrdenCompra,
													"fechaOrdenCompra" => $detalle->fechaOrdenCompra_f,
													"subtotal" => $detalle->subtotal,
													"iva" => $detalle->iva,
													"total" => $detalle->total,
													"estatus" => $detalle->estatus->contrarecibo,
													"numeroFactura" => $detalle->numeroFactura,
													"fechaFactura" => $detalle->fechaFactura_f,
													"totalFactura" => $detalle->totalFactura,
													"proveedor" => $detalle->contrarecibo->proveedor_did,
													"proveedorNombre" => $detalle->contrarecibo->proveedor->nombre);
			}
		}
		return $detalleFacturas;
	}

	public function getAmbasPorProveedor($provId){
		$detalleFacturas = array();
		$facturas = Contrarecibo::model()->findAll("proveedor_did = " . $provId);
		foreach($facturas as $factura)
		{
			$detalleFactura = DetalleContrarecibo::model()->findAll("contrarecibo_did = " . $factura->id);
			foreach($detalleFactura as $detalle){
				$detalleFacturas[] = array("id" => $detalle->id,
													"numeroOrdenCompra" => $detalle->numeroOrdenCompra,
													"fechaOrdenCompra" => $detalle->fechaOrdenCompra_f,
													"subtotal" => $detalle->subtotal,
													"iva" => $detalle->iva,
													"total" => $detalle->total,
													"estatus" => $detalle->estatus->contrarecibo,
													"numeroFactura" => $detalle->numeroFactura,
													"fechaFactura" => $detalle->fechaFactura_f,
													"totalFactura" => $detalle->totalFactura,
													"proveedor" => $detalle->contrarecibo->proveedor_did,
													"proveedorNombre" => $detalle->contrarecibo->proveedor->nombre);
			}
		}
		return $detalleFacturas;
	}

	public function actionVerpasivogeneral(){
		$this->render("verpasivogeneral",array("facturas" => $this->cargarFacturas()));
	}

	public function actionImprimirpasivogeneral(){
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('L');
		$mPDF1->WriteHTML($this->renderPartial("impresionpasivogeneral",array("facturas" => $this->cargarFacturas()),true),2);
		$mPDF1->Output();

	}

	function cargarFacturas(){
		$detalleFactura = DetalleContrarecibo::model()->with("contrarecibo")->findAll(
							array("order"=>"contrarecibo.proveedor_did ASC", "condition"=>"estatus_did = 1"));
		if(count($detalleFactura)>0){
			foreach($detalleFactura as $detalle){
				$detalleFacturas[] = array("id" => $detalle->id,
													"proveedor" => $detalle->contrarecibo->proveedor->nombre,
													"numeroOrdenCompra" => $detalle->numeroOrdenCompra,
													"fechaOrdenCompra" => $detalle->fechaOrdenCompra_f,
													"subtotal" => $detalle->subtotal,
													"iva" => $detalle->iva,
													"total" => $detalle->total,
													"numeroFactura" => $detalle->numeroFactura,
													"fechaFactura" => $detalle->fechaFactura_f);
			}
			return $detalleFacturas;
		} else {
			;
		}


	}

	public function actionFormcheque($id)
	{
		$modelDetalleContrarecibo = DetalleContrarecibo::model()->find("id = " .$id);
		if(isset($_POST["noCheque"])){
			$modelDetalleContrarecibo->cheque = $_POST["noCheque"];
			$modelDetalleContrarecibo->estatus_did = 2;
			if($modelDetalleContrarecibo->save()){
				if($_GET["de"] == "general"){
					$this->redirect(array('verpasivogeneral',"facturas" => $this->cargarFacturas()));
				}
				else if($_GET["de"] == "prov"){
					$this->redirect(array('verfacturasproveedor'));
				}
			}
			else
				Yii::app()->user->setFlash('warning', '<strong>Hubo un problema, no se actualizó correctamente!</strong>');
		}else{
			$this->render('formcheque',array(
				'model'=>$modelDetalleContrarecibo,
			));
		}
	}

	public function actionCancelarfactura($id)
	{
		$model = DetalleCotizacion::model()->find("id = " . $id);
		Yii::app()->db->createCommand("delete from DetalleContrarecibo where id = " . $id)->execute();
		$this->redirect(array('verfacturasproveedor'));
	}

	public function actionFacturaspendientes(){
		$proveedores = Yii::app()->db->createCommand("Select distinct c.proveedor_did as id, p.nombre as proveedor from Contrarecibo c
																Inner join Proveedor as p on p.id = c.proveedor_did")->queryAll();
		$this->render('facturaspendientes',array('proveedores'=>$proveedores));
	}

	public function actionMostrarfacturaspendientes(){
		$facturaspendientes = Array();
		if(isset($_POST["proveedor"])){
			/*echo "<pre>"; print_r($facturaspendientes); echo "</pre>";
			exit; */
			$this->renderPartial('_facturaspendientes',array(
				'proveedorId'=>$_POST["proveedor"],
			));

		}
	}

	public function actionImprimirfacturaspendientes($id){

		$facturaspendientes = Array();
		if(isset($id)){
			/*echo "<pre>"; print_r($facturaspendientes); echo "</pre>";
			exit; */
			$this->layout="pdf";
			$mPDF1 = Yii::app()->ePdf->mpdf();
			$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
			$mPDF1->WriteHTML($stylesheet,1);
			$mPDF1->AddPage('P');
			$mPDF1->WriteHTML($this->renderPartial('imprimirfacturaspendientes',array(
				'proveedor'=>$id,
			),true),2);
			$mPDF1->Output();


		}
	}
}
