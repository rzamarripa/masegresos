<?php

class OrdenCompraController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','Porproveedoryuo', 'getByProveedor',
					'imprimir','dashboard','adminalmacen','cambiarestatus','imprimirA','imprimirB',
					'imprimirC','ImprimirExistencia','ImprimirSalidas','ImprimirPendientes','Impexistencia',
					'Impsalida','Imppendiente', 'impordenes','imprimirPantalla','cancelar','recuperar','impexistenciageneral',
					'seguimientorapido','limpiarseguimientorapido','imprimirpornumeroordencompra',
					'mercanciaalmacen'),
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

		if(isset($_POST["RecibioUO"]) && isset($_POST["RecibioAlm"]))
		{
			//echo '<pre> Entro opcion entrada UO </pre>';

			//$this->cambiarEstatus($id, 2, $_POST["Recibio"]);
			$recibio = $_POST["RecibioUO"];
			$recibioAlm = $_POST["RecibioAlm"];

			$model = OrdenCompra::model()->find("id = " . $id);
			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			//Bitacora entrada
			$modelBitacoraEntrada = new BitacoraAlmacenes;

			$modelBitacoraEntrada->usuario_did = $usuarioActual->id;
			$modelBitacoraEntrada->ordenCompra_did = $model->id;
			$modelBitacoraEntrada->requisicion_did = $model->requisicion_did;
			$modelBitacoraEntrada->recibioUO = $model->unidadOrganizacional_aid;
			$modelBitacoraEntrada->nombreRecibioUO = $recibio;
			$modelBitacoraEntrada->nombreRecibioAlmacen = $recibioAlm;
			$modelBitacoraEntrada->estatus_did = 1;
			//Orden de compra
			$model->estatusAlmacen_did = 3;
			$model->fechaRecepcion_f = date("Y-m-d");
			$model->fechaSalida_f = date("Y-m-d");

			//Bitacora Salida
			$modelBitacoraSalida = new BitacoraAlmacenes;

			$modelBitacoraSalida->usuario_did = $usuarioActual->id;
			$modelBitacoraSalida->ordenCompra_did = $model->id;
			$modelBitacoraSalida->requisicion_did = $model->requisicion_did;
			$modelBitacoraSalida->recibioUO = $model->unidadOrganizacional_aid;
			$modelBitacoraSalida->nombreRecibioUO = $recibio;
			$modelBitacoraSalida->nombreRecibioAlmacen = $recibioAlm;
			$modelBitacoraSalida->estatus_did = 2;

			// Inserto el seguimiento

			date_default_timezone_set('America/Mazatlan');
			$fechaAlmacen = date('Y-m-d h:i:s a', time());
			$conection = Yii::app()->db;
			$comandoSeguimiento = $conection->createCommand("UPDATE Seguimiento SET fechaEntradaAlmacen_f = :fechaEntradaAlmacen, fechaSalidaAlmacen_f = :fechaSalidaAlmacen, usuarioEntradaAlmacen = :usuarioEntradaAlmacen, usuarioSalidaAlmacen = :usuarioSalidaAlmacen, estatus_did = 6 WHERE requisicion_aid = " . $model->requisicion_did);

			$comandoSeguimiento->bindValue(":fechaEntradaAlmacen", $fechaAlmacen, PDO::PARAM_STR);
			$comandoSeguimiento->bindValue(":fechaSalidaAlmacen", $fechaAlmacen, PDO::PARAM_STR);
			$comandoSeguimiento->bindValue(":usuarioEntradaAlmacen", $recibioAlm, PDO::PARAM_STR);
			$comandoSeguimiento->bindValue(":usuarioSalidaAlmacen", $recibioAlm, PDO::PARAM_STR);
			$comandoSeguimiento->execute();

			if($model->save() && $modelBitacoraEntrada->save() && $modelBitacoraSalida->save()){
				$this->redirect(array('adminalmacen','alm'=>$_GET["alm"]));
			}
			//echo '<pre> Entro a ActionView</pre>';
			//echo '<pre>'; print_r($recibio); echo '</pre>';
			//echo '<pre>'; print_r($modelBitacora->attributes); echo '</pre>';
			//echo '<pre>'; print_r($model->attributes); echo '</pre>';

		} else if (isset($_POST["RecibioAlm2"])){


				//Entrada de Almacen
				//$estatus = $_GET["estatus"];
				$model = OrdenCompra::model()->find("id = " . $id);
				$modelBitacora = new BitacoraAlmacenes;
				$usuarioActual = Usuario::model()->obtenerUsuarioActual();

				$recibio = $_POST["RecibioAlm2"];
				$model->fechaRecepcion_f = date("Y-m-d");
				$model->comentarioAlmacenista = null;
				$modelBitacora->usuario_did = $usuarioActual->id;
				$modelBitacora->ordenCompra_did = $model->id;
				$modelBitacora->recibioUO = 1;
				$modelBitacora->nombreRecibioUO = ' ';
				$modelBitacora->estatus_did = 1;
				$modelBitacora->requisicion_did = $model->requisicion_did;
				$modelBitacora->nombreRecibioAlmacen = $recibio;
				//echo '<pre>'; print_r($modelBitacora->attributes); echo '</pre>';
				//echo '<pre>'; print_r($model->attributes); echo '</pre>';
				//$model->estatus_did = $estatus;
				$model->estatusAlmacen_did = 2;
				// Inserto el seguimiento

				date_default_timezone_set('America/Mazatlan');
				$fechaEntradaAlmacen = date('Y-m-d h:i:s a', time());
				$conection = Yii::app()->db;
				$comandoSeguimiento = $conection->createCommand("UPDATE Seguimiento SET fechaEntradaAlmacen_f = :fechaEntradaAlmacen, usuarioEntradaAlmacen = :usuarioEntradaAlmacen, estatus_did = 5 WHERE requisicion_aid = " . $model->requisicion_did);

				$comandoSeguimiento->bindValue(":fechaEntradaAlmacen", $fechaEntradaAlmacen, PDO::PARAM_STR);
				$comandoSeguimiento->bindValue(":usuarioEntradaAlmacen", $_POST["RecibioAlm2"], PDO::PARAM_STR);
				$comandoSeguimiento->execute();
				if($model->save() && $modelBitacora->save()){
					$this->redirect(array('adminalmacen','alm'=>$_GET["alm"]));
				}

		} else if (isset($_POST["SalidaAlm"])){
				//Salida de Almacen

				$model = OrdenCompra::model()->find("id = " . $id);
				$modelBitacora = new BitacoraAlmacenes;
				$usuarioActual = Usuario::model()->obtenerUsuarioActual();

				$recibio = $_POST["SalidaAlm"];
				$model->fechaSalida_f = date("Y-m-d");
				$modelBitacora->usuario_did = $usuarioActual->id;
				$modelBitacora->ordenCompra_did = $model->id;
				$modelBitacora->recibioUO = 2;
				$modelBitacora->nombreRecibioUO = ' ';
				$modelBitacora->estatus_did = 2;
				$model->fechaSalida_f = date("Y-m-d");
				$modelBitacora->requisicion_did = $model->requisicion_did;
				$modelBitacora->nombreRecibioAlmacen = $recibio;
				$model->estatusAlmacen_did = 3;
				// Inserto el seguimiento

				date_default_timezone_set('America/Mazatlan');
				$fechaEntradaAlmacen = date('Y-m-d h:i:s a', time());
				$conection = Yii::app()->db;
				$comandoSeguimiento = $conection->createCommand("UPDATE Seguimiento SET fechaSalidaAlmacen_f = :fechaSalidaAlmacen, usuarioSalidaAlmacen = :usuarioSalidaAlmacen, estatus_did = 6 WHERE requisicion_aid = " . $model->requisicion_did);

				$comandoSeguimiento->bindValue(":fechaSalidaAlmacen", $fechaEntradaAlmacen, PDO::PARAM_STR);
				$comandoSeguimiento->bindValue(":usuarioSalidaAlmacen", $_POST["SalidaAlm"], PDO::PARAM_STR);
				$comandoSeguimiento->execute();
				if($model->save() && $modelBitacora->save()){
					$this->redirect(array('adminalmacen','alm'=>$_GET["alm"]));
				}


		} else if(isset($_POST["OrdenCompra"]) && isset($_POST["OrdenCompra"]["comentarioAlmacenista"])){
			$model = OrdenCompra::model()->find("id = " . $id);
			$model->comentarioAlmacenista = $_POST["OrdenCompra"]["comentarioAlmacenista"];

			if($model->save()){
				$this->redirect(array('adminalmacen','alm'=>$_GET["alm"]));
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
		$model=new OrdenCompra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrdenCompra']))
		{
			$model->attributes=$_POST['OrdenCompra'];
			$model->estatusAlmacen_did = 1;
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

		if(isset($_POST['OrdenCompra']))
		{
			$model->attributes=$_POST['OrdenCompra'];
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
		$dataProvider=new CActiveDataProvider('OrdenCompra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OrdenCompra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrdenCompra']))
			$model->attributes=$_GET['OrdenCompra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminalmacen()
	{
		$model = new OrdenCompra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrdenCompra']))
			$model->attributes=$_GET['OrdenCompra'];
		$this->render('almacenista',array(
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
		$model=OrdenCompra::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='orden-compra-form')
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
	       	$cursor = OrdenCompra::model()->findAll($criteria);
			foreach ($cursor as $valor)
				$result[]=Array('label' => $valor->nombre,
				                'value' => $valor->nombre,
				                'id' => $valor->id, );
	    }
	    echo json_encode($result);
	    Yii::app()->end();
	}

	public function actionGetByProveedor() {
		$proveedor_id = $_GET['proveedor_id'];
		$ordenes_model = OrdenCompra::model()->findAll("proveedor_aid = $proveedor_id AND estatus_did=1 ORDER BY fecha_f ASC");
		$result = array();
		foreach ($ordenes_model as $o) {
			$result[] = $o->to_array();
		}
		echo json_encode($result);
		Yii::app()->end();
	}

	public function actionImprimir($id)
	{
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('imprimir', array('model'=> $this->loadModel($id)),true),2);
		$mPDF1->Output();
	}

	public function actionImprimirPantalla($id)
	{
		$this->layout = "pdf";
		$this->render('imprimir',array(
			'model'=>$this->loadModel($id),
		));
	}

  public function actionDashboard($proveedorId){
        $ordenesPendientes = OrdenCompra::model()->findAll("estatus_did = 1 && proveedor_aid = " . $proveedorId);
        $ordenesPagadas = OrdenCompra::model()->findAll("estatus_did = 3 && proveedor_aid = " . $proveedorId);
        $ordenesAgendadas = OrdenCompra::model()->findAll("estatus_did = 2 && proveedor_aid = " . $proveedorId);

        $this->render('dashboard',array('ordenesPendientes'=>$ordenesPendientes
                                        ,'ordenesPagadas'=>$ordenesPagadas
                                        ,'ordenesAgendadas'=>$ordenesAgendadas));
  }

  public function renderButtons($data, $row) {
	   $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'',
		    'buttonType' => "link",
		    'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'mini', // null, 'large', 'small' or 'mini'
		    'icon'=>'eye-open',
		    'url' =>array('ordenCompra/view','id'=>$data->id, 'alm' => $_GET["alm"]),
		));
	}

	public function comentarioAlmacenista($data, $row) {
	   if(isset($data->comentarioAlmacenista))
	   	echo "<i class='icon icon-comment'></i>";
	   else
	   	echo "";
	}

	public function actionCambiarestatus($id)
	{
		try{
			$estatus = $_GET["estatus"];
			$model = OrdenCompra::model()->find("id = " . $id);
			$modelBitacora = new BitacoraAlmacenes;
			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			/*
			if($estatus == 2)	//Entrada Almacen
			{
				$recibio = $_GET["recibioUO"];
				$model->fechaRecepcion_f = date("Y-m-d");
				$model->comentarioAlmacenista = null;
				$modelBitacora->usuario_did = $usuarioActual->id;
				$modelBitacora->ordenCompra_did = $model->id;
				$modelBitacora->recibioUO = $recibio;
				$modelBitacora->nombreRecibioUO = ' ';
				$modelBitacora->estatus_did = 1;
				$modelBitacora->requisicion_did = $model->requisicion_did;
				//$modelBitacora->nombreRecibioAlmacen = $model->requisicion_did;
				//echo '<pre>'; print_r($modelBitacora->attributes); echo '</pre>';
				//echo '<pre>'; print_r($model->attributes); echo '</pre>';
				//$model->estatus_did = $estatus;
				$model->estatusAlmacen_did = $estatus;
			} else if ($estatus == 3){	//Salida Almacen
				$recibio = $_GET["recibio"];
				$model->fechaSalida_f = date("Y-m-d");
				$modelBitacora->usuario_did = $usuarioActual->id;
				$modelBitacora->ordenCompra_did = $model->id;
				$modelBitacora->recibioUO = $recibio;
				$modelBitacora->nombreRecibioUO = ' ';
				$modelBitacora->estatus_did = 2;
				$model->fechaSalida_f = date("Y-m-d");
				$modelBitacora->requisicion_did = $model->requisicion_did;
				$model->estatusAlmacen_did = $estatus;*/
			//} else
			if($estatus == 4 && $model->estatusAlmacen_did == 2){ //Cancelar la recepción
				$model->fechaCancelacionRecepcion_f = date("Y-m-d");
				$model->estatusAlmacen_did = 1;
				$modelBitacora->usuario_did = $usuarioActual->id;
				$modelBitacora->ordenCompra_did = $model->id;
				$modelBitacora->recibioUO = 0;
				$modelBitacora->requisicion_did = $model->requisicion_did;
				$modelBitacora->nombreRecibioUO = ' ';
				$modelBitacora->estatus_did = 2;
			}

			if($model->save() && $modelBitacora->save()){
				$this->redirect(array('adminalmacen','alm'=>$_GET["alm"]));
			}
		}
		catch(Exception $e)
		{
			echo $e;
		}
		//if($_GET["estatus"] == 1)
		//	$this->cambiarEstatus($id, $_GET["estatus"], "");
    }

	public function actionimprimirA()
	{
		$this->render('imprimirA');
	}
    public function actionimprimirB()
	{
		$this->render('imprimirB');
	}
	public function actionimprimirC()
	{
		$usuarioActual = Usuario::model()->obtenerUsuarioActual();
		$almacenUsuario = $usuarioActual->almacen_aid;
		$pendientes = Yii::app()->db->createCommand('select oc.numeroOrdenCompra, uo.nombre, oc.FechaRecepcion_f as fecha from ordenCompra oc inner join unidadorganizacional uo on uo.id = oc.unidadorganizacional_aid Where estatusAlmacen_did = 2 And almacen_aid = '. $almacenUsuario)->queryAll();

		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('imppendiente', array('pendientes' => $pendientes),true),2);
		$mPDF1->Output();


		//$this->render('imprimirC');
	}

	public function actionImprimirExistencia()
	{
		if(isset($_POST["almacen"])){
			$fechaInicio = $_POST["inicio"];
			$fechaFin = $_POST["fin"];

			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			$almacenUsuario = $usuarioActual->almacen_aid;
			if(!empty($_POST["almacen"])){

				$uo = explode("-", $_POST["almacen"]);
				$sql = 'select a.codigo, a.nombre, sum(doc.cantidad) as cantidad
							from ordenCompra oc
							inner join detalleOrdenCompra doc on oc.id = doc.ordenCompra_did
							inner join articulo a on a.id = doc.articulo_aid
							Where oc.unidadOrganizacional_aid = ' . $uo[0] . '
							And oc.estatusAlmacen_did = 2
							And almacen_aid = ' . $almacenUsuario . '
							And fechaRecepcion_f >= "' . $fechaInicio .'" And fechaRecepcion_f <= "'. $fechaFin .'"
							group by a.codigo, a.nombre';
			}else{


				$sql = 'select a.codigo, a.nombre, sum(doc.cantidad) as cantidad
							from ordenCompra oc
							inner join detalleOrdenCompra doc on oc.id = doc.ordenCompra_did
							inner join articulo a on a.id = doc.articulo_aid
							where oc.estatusAlmacen_did = 2
							And almacen_aid = ' . $almacenUsuario . '
							And fechaRecepcion_f >= "' . $fechaInicio .'" And fechaRecepcion_f <= "'. $fechaFin .'"
							group by a.codigo, a.nombre';
			}


			$existencias = Yii::app()->db->createCommand($sql)->queryAll();
			if(!empty($_POST["almacen"])){
				if (count($existencias) > 0){
					$this->renderPartial('_existencia', array('existencias' => $existencias,'uo'=>$uo[0],'fi'=>$fechaInicio,'ff'=>$fechaFin));
				}
				else{
					echo '<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<h4>Mensaje:</h4>
								No se encontraron artículos en existencias para la UO: '. $uo[1] .' .
		   						</div>';
				}
			}else{
				if (count($existencias) > 0){
					$this->renderPartial('_existencia', array('existencias' => $existencias, 'fi'=>$fechaInicio,'ff'=>$fechaFin));
				}
				else{
					echo '<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<h4>Mensaje:</h4>
								No se encontraron artículos en existencias para todas las UO
		   						</div>';
				}
			}
		}
	}

	public function actionImpexistencia()
	{
		$uo=($_GET['uo']);
		$fechaInicio=($_GET['fi']);
		$fechaFin=($_GET['ff']);
		$usuarioActual = Usuario::model()->obtenerUsuarioActual();
		$almacenUsuario = $usuarioActual->almacen_aid;
		$existencias = Yii::app()->db->createCommand('select a.codigo, a.nombre, sum(doc.cantidad) as cantidad
							from ordenCompra oc
							inner join detalleOrdenCompra doc on oc.id = doc.ordenCompra_did
							inner join articulo a on a.id = doc.articulo_aid
							Where oc.unidadOrganizacional_aid = ' . $uo . '
							And oc.estatusAlmacen_did = 2
							And almacen_aid = ' . $almacenUsuario . '
							And fechaRecepcion_f >= "' . $fechaInicio .'" And fechaRecepcion_f <= "'. $fechaFin .'"
							group by a.codigo, a.nombre')->queryAll();
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('impexistencia', array('existencias' => $existencias,'uo'=>$uo),true),2);
		$mPDF1->Output();
	}

	public function actionImpexistenciageneral()
	{
		$fechaInicio=($_GET['fi']);
		$fechaFin=($_GET['ff']);
		$usuarioActual = Usuario::model()->obtenerUsuarioActual();
		$almacenUsuario = $usuarioActual->almacen_aid;
		$existencias = Yii::app()->db->createCommand('select a.codigo, a.nombre, sum(doc.cantidad) as cantidad
							from ordenCompra oc
							inner join detalleOrdenCompra doc on oc.id = doc.ordenCompra_did
							inner join articulo a on a.id = doc.articulo_aid
							where oc.estatusAlmacen_did = 2
							And almacen_aid = ' . $almacenUsuario . '
							And fechaRecepcion_f >= "' . $fechaInicio .'" And fechaRecepcion_f <= "'. $fechaFin .'"
							group by a.codigo, a.nombre')->queryAll();

		$this->layout = "pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('impexistenciageneral', array('existencias' => $existencias),true),2);
		$mPDF1->Output();
	}

	public function actionimprimirsalidas()
	{
		if(isset($_POST["almacen"])){

			$fechaInicio = $_POST["inicio"];
			$fechaFin = $_POST["fin"];
			$uo = explode("-", $_POST["almacen"]);
			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			$almacenUsuario = $usuarioActual->almacen_aid;

			$salidas = Yii::app()->db->createCommand('select a.codigo, a.nombre, sum(doc.cantidad) as cantidad
							from ordenCompra oc
							inner join detalleOrdenCompra doc on oc.id = doc.ordenCompra_did
							inner join articulo a on a.id = doc.articulo_aid
							Where oc.unidadOrganizacional_aid = ' . $uo[0] . '
							And oc.estatusAlmacen_did = 3
							And almacen_aid = ' . $almacenUsuario . '
							And fechasalida_f >= "' . $fechaInicio .'" And fechasalida_f <= "'. $fechaFin .'"
							group by a.codigo, a.nombre')->queryAll();

			if (count($salidas) > 0){
				$this->renderPartial('_salida', array('salidas' => $salidas,'uo'=>$uo[0],'fi'=>$fechaInicio,'ff'=>$fechaFin));
			}
			else{
				echo '<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4>Mensaje:</h4>
							No se encontraron artículos de salida para la UO: '. $uo[1] .' .
	   				</div>';
			}
		}
	}

	public function actionImpSalida()
	{
		$uo=$_GET['uo'];
		$fechaInicio=$_GET['fi'];
		$fechaFin=$_GET['ff'];
		$objuo = UnidadOrganizacional::model()->find("id = " . $uo);
		$usuarioActual = Usuario::model()->obtenerUsuarioActual();
		$almacenUsuario = $usuarioActual->almacen_aid;
		$salidas = Yii::app()->db->createCommand('select a.codigo, a.nombre, sum(doc.cantidad) as cantidad
							from ordenCompra oc
							inner join detalleOrdenCompra doc on oc.id = doc.ordenCompra_did
							inner join articulo a on a.id = doc.articulo_aid
							Where oc.unidadOrganizacional_aid = ' . $uo . '
							And oc.estatusAlmacen_did = 3
							And almacen_aid = ' . $almacenUsuario . '
							And fechaSalida_f >= "' . $fechaInicio .'" And fechaSalida_f <= "'. $fechaFin .'"
							group by a.codigo, a.nombre')->queryAll();

		$this->layout="pdf";


		$this->render('impsalida', array('salidas' => $salidas, 'uo'=>$uo,'nomuo'=>$objuo->nombre));

	}

	public function actionImpOrdenes($provId,$uoId,$fechaInicio,$fechaFin)
	{	
		$ordenesCompra = OrdenCompra::model()->findAll(array("condition"=>"proveedor_aid = " . $provId . 
																		" and unidadOrganizacional_aid = " . $uoId . 
																		" and fecha_f>= '" . $fechaInicio . "'" .
																		" and fecha_f<= '" . $fechaFin . "'"));
		$this->layout = "pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('impordenes', array('ordenesCompra' => $ordenesCompra),true),2);
		$mPDF1->Output();
	}

	public function cambiarEstatus($id, $estatus, $recibio){
		$model = OrdenCompra::model()->find("id = " . $id);
		$modelBitacora = new BitacoraAlmacenes;
		if($estatus == 2)
		{
			$usuarioActual = Usuario::model()->obtenerUsuarioActual();
			$model->fechaRecepcion_f = date("Y-m-d");
			$modelBitacora->usuario_did = $usuarioActual->id;
			$modelBitacora->ordenCompra_did = $model->id;
			$modelBitacora->recibioUO = $estatus;
			$modelBitacora->nombreRecibioUO = $recibio;
			$modelBitacora->estatus_did = 2;
		} else if($estatus == 1 && $model->estatus_did == 2){
			//$model->fechaCancelacionRecepcion_f = date("Y-m-d");
		}
	//$model->estatus_did = $estatus;
	//if($model->save() && $modelBitacora->save()){
	//if($modelBitacora->save()){
		$this->redirect(array('adminalmacen'));
	//}
	}

	public function actionCancelar($id)
	{
		$existeEnContrarecibo = DetalleContrarecibo::model()->exists("ordenCompra_did = " . $id);
		if($existeEnContrarecibo){
			Yii::app()->db->createCommand("update DetalleContrarecibo set estatus_did = 4 where ordenCompra_did = " . $id)->execute();
		}
		$model = $this->loadModel($id);
		$model->estatus_did = 4;
		if($model->save())
			$this->redirect(array('index'));
	}

	public function actionRecuperar($id)
	{
		$model = $this->loadModel($id);

		$existeEnContrarecibo = DetalleContrarecibo::model()->exists("ordenCompra_did = " . $id);
		if($existeEnContrarecibo){
			Yii::app()->db->createCommand("update DetalleContrarecibo set estatus_did = 2 where ordenCompra_did = " . $id)->execute();
			$model->estatus_did = 2;
		}else{
			$model->estatus_did = 1;
		}

		if($model->save())
			$this->redirect(array('view','id'=>$id));
	}

	public function actionSeguimientorapido()
	{

		$model = OrdenCompra::model()->find("numeroOrdenCompra= '" . $_POST["ordenCompra"]. "'");
		/* echo "<pre>"; print_r($model->attributes); echo "</pre>"; */

		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha visto el seguimiento rápido de la orden de compra: " .
																			$model->numeroOrdenCompra . "', '"  .
																			Yii::app()->user->name . "')")->execute();
		$detalleOrdenCompra = DetalleOrdenCompra::model()->findAll('ordenCompra_did = ' . $model->id);
		/* foreach($detalleOrdenCompra as $detalle){
			echo "<pre>"; print_r($detalle->attributes); echo "</pre>";
		}
		exit; */
		$this->renderPartial('view',array(
			'model'=>$model,
			'detalleOrdenCompra' => $detalleOrdenCompra,
		));
	}

	public function actionLimpiarseguimientorapido()
	{
		echo "";
		exit;
	}

	public function actionImprimirpornumeroordencompra()
	{
			echo "hola";
		echo "<pre>"; print_r($_POST); echo "</pre>";
		exit;
		$model = OrdenCompra::model()->find("numeroOrdenCompra= '" . $_POST["ordenCompra"]. "'");
		$this->layout="pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.themes.bootstrap.css') . '/print.css');
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->AddPage('P');
		$mPDF1->WriteHTML($this->renderPartial('imprimir', array('model'=> $model),true),2);
		$mPDF1->Output();
	}

	public function actionMercanciaalmacen(){
		$ordenes = OrdenCompra::model()->findAll("estatusAlmacen_did = " . 2);

		$this->render("mercanciaalmacen",array("ordenes"=>$ordenes));
	}

	public function actionPorproveedoryuo(){
		$proveedores = Yii::app()->db->createCommand("Select distinct oc.proveedor_aid as id, p.nombre as proveedor from OrdenCompra oc
																Inner join Proveedor as p on p.id = oc.proveedor_aid")->queryAll();
		$uos = Yii::app()->db->createCommand("Select distinct oc.unidadOrganizacional_aid as id, uo.nombre as nombre from OrdenCompra oc
																Inner join UnidadOrganizacional as uo on uo.id = oc.unidadOrganizacional_aid")->queryAll();
		//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		if(isset($_POST["proveedor"])){
			$ordenesCompra = array();
			if(isset($_GET["tipo"]) && $_GET["tipo"] == "Buscar"){
				$ordenesCompra = $this->getOrdenesProvuo($_POST["proveedor"],$_POST["uo"],$_POST["fechaInicio"],$_POST["fechaFin"]);
			}

			$this->renderPartial("_ordenesCompra",array("ordenesCompra" => $ordenesCompra,"provId"=>$_POST["proveedor"],"uoId"=>$_POST["uo"],"fechaInicio"=>$_POST["fechaInicio"],"fechaFin"=>$_POST["fechaFin"]));

		} else{
			$this->render("Porproveedoryuo",array('proveedores' => $proveedores,'uos' => $uos));
		}
	}

	public function getOrdenesProvuo($provId,$uoId,$fechaInicio,$fechaFin){
		$detalleOrdenesCompra = array();
		$ordenesCompra = OrdenCompra::model()->findAll(array("condition"=>"proveedor_aid = " . $provId . 
																		" and unidadOrganizacional_aid = " . $uoId . 
																		" and fecha_f>= '" . $fechaInicio . "'" .
																		" and fecha_f<= '" . $fechaFin . "'"));
		/*
		foreach($ordenesCompra as $ordenCompra)
		{
			$detalle = DetalleOrdenCompra::model()->findAll("ordenCompra_did = " . $ordenCompra->id);
			$detalleOrdenesCompra[] = array("id" => $detalle->id,
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
		*/
		return $ordenesCompra;
	}
}
