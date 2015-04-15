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
				'actions'=>array('autocompletesearch'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions

				'actions'=>array('index','view','create','update','admin','delete', 'imprimir', 'imprimirBaja'
								,'updateinventario', 'impresguardo', 'implistadoinv', 'imprimirListado'
								,'imprimiretiqueta', 'bajainventario', 'bajanormal', 'bajalote','reubicacion'
								,'espacios','detallebajainventario', 'imprimirListadoBaja','detalleReubicacion','impResguardoBaja'
								,'getproveedores','getunidadesorganizacional','getfondos','getarticulos',
								'getmarcas'),
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
		$modelDetalle = new DetalleInventario;
		$this->performAjaxValidation($model);

		$this->addCss('requisiciones.css');
		$configuraciones=configuraciones::model()->findByPk(1);
		if(isset($_POST['Inventario']))
		{

			if(!Inventario::model()->exists('numeroDocumento = '.$_POST['Inventario']['numeroDocumento'])){
				try
				{
					/*
						echo '<pre>';print_r($_POST["Inventario"]); echo "</pre>";
						echo '<pre>';print_r($_POST["detalle"]); echo "</pre>";
						exit;
					*/
					$usuarioActual = Usuario::model()->obtenerUsuarioActual();
					$inventario = $_POST['Inventario'];
					$conection = Yii::app()->db;
					$transaction = $conection->beginTransaction();
						$comandoInventario = $conection->createCommand("INSERT INTO Inventario
						(origen_did, tipoDocumento_did, salidaResguardo,
						numeroDocumento, proveedor_aid, unidadOrganizacional_aid, fondo_aid, ejercicio, fechaAdquisicion_f, autorizo, fechaCaptura_f, usuarioAlta_did, estatus_did)
						VALUES (:origen_did, :tipoDocumento_did, :salidaResguardo,
						:numeroDocumento, :proveedor_aid, :unidadOrganizacional_aid, :fondo_aid, :ejercicio, :fechaAdquisicion_f, :autorizo, :fechaCaptura_f, :usuarioAlta_did, :estatus_did)");
					$criteria = new CDbCriteria;
					$criteria->select='MAX(salidaResguardo) as salidaResguardo';
					$salidaResguardo = Inventario::model()->find($criteria);
					$salidaRes = $salidaResguardo["salidaResguardo"];
					$salidaRes++;
					$comandoInventario->bindValue(":origen_did", $inventario['origen_did'],PDO::PARAM_INT);
					$comandoInventario->bindValue(":tipoDocumento_did",$inventario['tipoDocumento_did'],PDO::PARAM_INT);
					$comandoInventario->bindValue(":salidaResguardo",$salidaRes,PDO::PARAM_INT);
					$comandoInventario->bindValue(":numeroDocumento",$inventario['numeroDocumento'],PDO::PARAM_STR);
					$comandoInventario->bindValue(":proveedor_aid",$inventario['proveedor_aid'],PDO::PARAM_INT);
					$comandoInventario->bindValue(":unidadOrganizacional_aid",$inventario['unidadOrganizacional_aid'],PDO::PARAM_INT);
					$comandoInventario->bindValue(":fondo_aid",$inventario['fondo_aid'],PDO::PARAM_INT);
					$comandoInventario->bindValue(":ejercicio",$inventario['ejercicio'],PDO::PARAM_STR);
					$comandoInventario->bindValue(":fechaAdquisicion_f",$inventario['fechaAdquisicion_f'],PDO::PARAM_STR);
					$comandoInventario->bindValue(":autorizo","C. Norma Alicia Aguilar Navarro",PDO::PARAM_STR);
					$comandoInventario->bindValue(":fechaCaptura_f",date("Y-m-d"),PDO::PARAM_STR);
					$comandoInventario->bindValue(":usuarioAlta_did",$usuarioActual->id,PDO::PARAM_INT);
					$comandoInventario->bindValue(":estatus_did",1,PDO::PARAM_INT);
					if($comandoInventario->execute())
					{
						$criteria = new CDbCriteria;
						$criteria->select='MAX(id) as id';
							$inventarioId = Inventario::model()->find($criteria);
						$criteria = new CDbCriteria;
						$criteria->select='MAX(lote) as lote';
						$lote = DetalleInventario::model()->find($criteria);
						$maxLote = $lote["lote"];
						$maxLote++;
						$detalleInventario = $_POST['detalle'];

						foreach($detalleInventario as $detalle)
						{
							if($detalle["tipo"] == "Multiple"){
								for($i = 0; $i< $detalle["cantidad"]; $i++){
									$comandoDetalle = $conection->createCommand("INSERT INTO DetalleInventario
									(articulo_aid, funcion_aid, marca_aid, modelo, serie, costoAdquisicion,
									observaciones, cantidad, lote, cantidadPorLote, tipoCaptura, inventario_did, estatus_did, cantidadPorLoteAct, iva, totalCostoAdquisicion, porcentajeIva, unidadOrganizacional_did)
									VALUES(:articulo_aid, :funcion_aid, :marca_aid, :modelo, :serie,
									:costoAdquisicion, :observaciones, :cantidad, :lote, :cantidadPorLote, :tipoCaptura, :inventario_did, :estatus_did, :cantidadPorLoteAct, :iva, :totalCostoAdquisicion, :porcentajeIva, :unidadOrganizacional_did)");
									$comandoDetalle->bindValue(":articulo_aid",$detalle['articulo_aid'],PDO::PARAM_INT);
									$comandoDetalle->bindValue(":funcion_aid",$detalle['espacio_aid'],PDO::PARAM_INT);
									$comandoDetalle->bindValue(":marca_aid",$detalle['marca_aid'],PDO::PARAM_INT);
									$comandoDetalle->bindValue(":modelo",$detalle['modelo'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":serie", $detalle['serie'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":costoAdquisicion",$detalle['costoAdquisicion'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":observaciones",$detalle['observaciones'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":cantidad",1,PDO::PARAM_INT);
									$comandoDetalle->bindValue(":lote",0,PDO::PARAM_INT);
									$comandoDetalle->bindValue(":cantidadPorLote",$detalle['cantidadPorLote'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":tipoCaptura",$detalle['tipo'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":inventario_did", $inventarioId->id ,PDO::PARAM_INT);
									$comandoDetalle->bindValue(":estatus_did", 1 ,PDO::PARAM_INT);
									$comandoDetalle->bindValue(":cantidadPorLoteAct",$detalle['cantidadPorLote'],PDO::PARAM_INT);
									$comandoDetalle->bindValue(":iva",$detalle['iva'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":totalCostoAdquisicion",$detalle['totalCostoAdquisicion'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":porcentajeIva",$detalle['porcentajeIva'],PDO::PARAM_STR);
									$comandoDetalle->bindValue(":unidadOrganizacional_did",$detalle['uo_did'],PDO::PARAM_INT);
									$comandoDetalle->execute();
								}
							} else {
								$comandoDetalle = $conection->createCommand("INSERT INTO DetalleInventario
									(articulo_aid, funcion_aid, marca_aid, modelo, serie, costoAdquisicion,
									observaciones, cantidad, lote, cantidadPorLote, tipoCaptura, inventario_did, estatus_did, cantidadPorLoteAct, iva, totalCostoAdquisicion, porcentajeIva, unidadOrganizacional_did)
									VALUES(:articulo_aid, :funcion_aid, :marca_aid, :modelo, :serie,
									:costoAdquisicion, :observaciones, :cantidad, :lote, :cantidadPorLote, :tipoCaptura, :inventario_did, :estatus_did, :cantidadPorLoteAct, :iva, :totalCostoAdquisicion, :porcentajeIva, :unidadOrganizacional_did)");
								$comandoDetalle->bindValue(":articulo_aid",$detalle['articulo_aid'],PDO::PARAM_INT);
								$comandoDetalle->bindValue(":funcion_aid",$detalle['espacio_aid'],PDO::PARAM_INT);
								$comandoDetalle->bindValue(":marca_aid",$detalle['marca_aid'],PDO::PARAM_INT);
								$comandoDetalle->bindValue(":modelo",$detalle['modelo'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":serie", $detalle['serie'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":costoAdquisicion",$detalle['costoAdquisicion'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":observaciones",$detalle['observaciones'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":cantidad",1,PDO::PARAM_INT);
								if($detalle["tipo"] == "Lote")
									$comandoDetalle->bindValue(":lote",$maxLote,PDO::PARAM_INT);
								else
									$comandoDetalle->bindValue(":lote",0,PDO::PARAM_INT);
								$comandoDetalle->bindValue(":cantidadPorLote",$detalle['cantidadPorLote'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":tipoCaptura",$detalle['tipo'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":inventario_did", $inventarioId->id ,PDO::PARAM_INT);
								$comandoDetalle->bindValue(":estatus_did", 1 ,PDO::PARAM_INT);
								$comandoDetalle->bindValue(":cantidadPorLoteAct",$detalle['cantidadPorLote'],PDO::PARAM_INT);
								$comandoDetalle->bindValue(":iva",$detalle['iva'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":totalCostoAdquisicion",$detalle['totalCostoAdquisicion'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":porcentajeIva",$detalle['porcentajeIva'],PDO::PARAM_STR);
								$comandoDetalle->bindValue(":unidadOrganizacional_did",$detalle['uo_did'],PDO::PARAM_INT);
								$comandoDetalle->execute();
							}
						}
					}
					$conection->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha registrado un inventario', '" . Yii::app()->user->name . "')")->execute();
					$transaction->commit();
					$this->redirect(array('inventario/index'));
				} catch(Exception $e) {
					$transaction->rollBack();
					echo '<pre>';print_r($e); echo "</pre>";
				}
			} else {
				Yii::app()->user->setFlash('warning', '<strong>Ese número de documento ya ha sido capturado, por favor verifique su información</strong>');

				$this->render('create',array(
					'model'=>$model,
					'modelDetalle' => $modelDetalle,
					'configuraciones' => $configuraciones,
					'uos' => $uos,
					'funciones'=>$funciones,
					'fondos' => $fondos,
					'articulos' => $articulos,
					'marcas' => $marcas,
					'proveedores' => $proveedores,
				));
			}
		} else {

			//Guardo las UOs en caché para que se cargue más rápido
			$sql = 'SELECT id, CONCAT(codigo, " - ", nombre) AS nombre FROM UnidadOrganizacional ORDER BY nombre ASC';
			$dependency = new CDbCacheDependency('SELECT MAX(id) FROM UnidadOrganizacional');
			$uos = Yii::app()->db->cache(3600*24, $dependency)->createCommand($sql)->queryAll();

			//Guardo las Funciones en caché para que se cargue más rápido
			$sqlFuncion = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Funcion ORDER BY nombre ASC';
			$dependencyFuncion = new CDbCacheDependency('SELECT MAX(id) FROM Funcion');
			$funciones = Yii::app()->db->cache(3600*24, $dependencyFuncion)->createCommand($sqlFuncion)->queryAll();

			//Guardo las Fondos en caché para que se cargue más rápido
			$sqlFondo = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Fondo ORDER BY nombre ASC';
			$dependencyFondo = new CDbCacheDependency('SELECT MAX(id) FROM Fondo');
			$fondos = Yii::app()->db->cache(3600*24, $dependencyFondo)->createCommand($sqlFondo)->queryAll();

			//Guardo las Articulos en caché para que se cargue más rápido
			$sqlArticulo = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Articulo ORDER BY nombre ASC';
			$dependencyArticulo = new CDbCacheDependency('SELECT MAX(id) FROM Articulo');
			$articulos = Yii::app()->db->cache(3600*24, $dependencyArticulo)->createCommand($sqlArticulo)->queryAll();

			//Guardo las Marca en caché para que se cargue más rápido
			$sqlMarca = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Marca ORDER BY nombre ASC';
			$dependencyMarca = new CDbCacheDependency('SELECT MAX(id) FROM Marca');
			$marcas = Yii::app()->db->cache(3600*24, $dependencyMarca)->createCommand($sqlMarca)->queryAll();

			//Guardo las Proveedores en caché para que se cargue más rápido
			$sqlProveedor = 'SELECT id, CONCAT(id, " - ", nombre) AS nombre FROM Proveedor ORDER BY nombre ASC';
			$dependencyProveedor = new CDbCacheDependency('SELECT MAX(id) FROM Proveedor');
			$proveedores = Yii::app()->db->cache(3600*24, $dependencyProveedor)->createCommand($sqlProveedor)->queryAll();

			$this->render('create',array(
				'model'=>$model,
				'modelDetalle' => $modelDetalle,
				'configuraciones' => $configuraciones,
				'uos' => $uos,
				'funciones'=>$funciones,
				'fondos' => $fondos,
				'articulos' => $articulos,
				'marcas' => $marcas,
				'proveedores' => $proveedores,
			));
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

		if(isset($_POST['Inventario']))
		{
			$model->attributes=$_POST['Inventario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        $modelDetalle = DetalleInventario::model()->findAll("inventario_did = ".$model->id);

		$this->render('update',array(
			'model'=>$model,
            'modelDetalle'=>$modelDetalle
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

	public function actionListarEstados($term)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "LOWER(nombre) like LOWER(:term)";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 10;
		$data = Empleado::model()->findAll($criteria);
		$arr = array();
			foreach ($data as $item) {
			$arr[] = array(
				'label' => $item->nombre.' '.$item->apellido,
				'value' => $item->nombre.' '.$item->apellido,
				'id' => $item->codigo,
			);
			}
		echo CJSON::encode($arr);
	Yii::app()->end();
	}


	public function actionImprimir()
	{
		$model=new Inventario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inventario']))
			$model->attributes=$_GET['Inventario'];

		$this->render('imprimir',array(
			'model'=>$model,
		));

	}

	public function actionImprimirBaja()
	{
		$model=new SalidaResguardo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SalidaResguardo']))
			$model->attributes=$_GET['SalidaResguardo'];

		$this->render('imprimirbaja',array(
			'model'=>$model,
		));

	}

	public function actionImpresguardo()
	{
		/*$unidadOrg=unidadOrganizacional::model()->findByPk($_GET['uo']);
		$inventarios = Inventario::model()->findAll("unidadOrganizacional_aid = ".$_GET['uo']." order by id");
		$this->layout = "pdf";
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$mPDF1->WriteHTML($this->render('impresguardo', array('inventarios' => $inventarios, 'unidadOrg'=>$unidadOrg), true));
		$mPDF1->Output();*/

		$inventario = Inventario::model()->find("salidaResguardo = ".$_GET["salidaRes"]);
		$detalleInventarios = DetalleInventario::model()->findAll("inventario_did= :i && estatus_did = 1", array(":i" =>$inventario->id));
		$unidadOrg=unidadOrganizacional::model()->find("id= ".$inventario->unidadOrganizacional_aid);

		$this->layout = "pdf";
		$this->render('impresguardo', array('inventario' => $inventario, 'unidadOrg'=>$unidadOrg, 'detalleInventarios'=>$detalleInventarios));
	}

	public function actionImplistadoinv()
	{
		$unidadOrg=unidadOrganizacional::model()->findByPk($_GET['uo']);
		if($_GET["tipoReporte"] == 1)
		{
			//$inventarios = Inventario::model()->findAll("unidadOrganizacional_aid = " . $_GET['uo'] . " and estatus_did = 1");
			$inventarios = DetalleInventario::model()->findAll('estatus_did = 1 AND unidadOrganizacional_did ='.$_GET['uo']);

			$position = 0;
			foreach ($inventarios as $dinventario) {
				//$detalleInventario = DetalleInventario::model()->findAll("inventario_did = :i && estatus_did = 1 && unidadOrganizacional_did = :uo", array(":i"=>$inventario->id, ":uo"=>$inventario->unidadOrganizacional_aid));
				//foreach ($detalleInventario as $detalleInv) {
					$detalle["funcion_aid"] = $dinventario->funcion_aid;
					$detalle["funcion_nombre"] = $dinventario->funcion->nombre;
					$detalle["id"] = $dinventario->id;
					$detalle["fechaAdquisicion_f"] = $dinventario->inventario->fechaAdquisicion_f;
					$detalle["lote"] = $dinventario->lote;
					$detalle["cantidadPorLoteAct"] = $dinventario->cantidadPorLoteAct;
					$detalle["nombre"] = $dinventario->articulo->nombre;
					$detalle["serie"] = $dinventario->serie;
					$detalle["modelo"] = $dinventario->modelo;
					$datosInventario[$position] = $detalle;
					$position++;
				//}
			}

		}else
		{
			$inventarios = SalidaResguardo::model()->findAll("unidadOrganizacional_did = " . $_GET['uo']);

			$position = 0;
			foreach ($inventarios as $inventario) {
				$detalleInventario = DetalleInventario::model()->findAll("bajaResguardo = ".$inventario->id . " and estatus_did = 2 and tipoCaptura <> 'Lote'");
				foreach ($detalleInventario as $detalleInv) {
					$detalle["funcion_aid"] = $detalleInv->funcion_aid;
					$detalle["funcion_nombre"] = $detalleInv->funcion->nombre;
					$detalle["id"] = $detalleInv->id;
					$detalle["fechaAdquisicion_f"] = $inventario->fechaBaja_f;
					$detalle["lote"] = $detalleInv->lote;
					$detalle["cantidadPorLoteAct"] = $detalleInv->cantidadPorLoteAct;
					$detalle["nombre"] = $detalleInv->articulo->nombre;
					$detalle["serie"] = $detalleInv->serie;
					$detalle["modelo"] = $detalleInv->modelo;
					$datosInventario[$position] = $detalle;
					$position++;
				}

				$detalleInventarioLote = DetalleBajaLote::model()->findAll("bajaResguardo = ".$inventario->id);
				foreach ($detalleInventarioLote as $detalleInv) {
					$detalle["funcion_aid"] = $detalleInv->detalleinventario->funcion_aid;
					$detalle["funcion_nombre"] = $detalleInv->detalleinventario->funcion->nombre;
					$detalle["id"] = $detalleInv->detalleinventario->id;
					$detalle["fechaAdquisicion_f"] = $inventario->fechaBaja_f;
					$detalle["lote"] = $detalleInv->detalleinventario->lote;
					$detalle["cantidadPorLoteAct"] = $detalleInv->cantidadBaja;
					$detalle["nombre"] = $detalleInv->detalleinventario->articulo->nombre;
					$detalle["serie"] = $detalleInv->detalleinventario->serie;
					$detalle["modelo"] = $detalleInv->detalleinventario->modelo;
					$datosInventario[$position] = $detalle;
					$position++;
				}
			}
		}

		foreach ($datosInventario as $key => $row) {
			$funcion[$key] = $row["funcion_aid"];
			$numInventario[$key] = $row["id"];
		}

		array_multisort($funcion, SORT_ASC, $numInventario, SORT_ASC, $datosInventario);


		$this->layout = "pdf";
		if($_GET["tipoReporte"] == 1)
		{
			$this->render('implistadoinv', array('inventarios' => $datosInventario, 'unidadOrg'=>$unidadOrg));
		}
		else
		{
			$this->render('implistadoinvbajasuo', array('inventarios' => $datosInventario, 'unidadOrg'=>$unidadOrg));
		}
	}

	public function actionImprimirListado()
	{
		$this->render('imprimirListado');
	}

	public function actionImprimirListadoBaja()
	{
		$this->render('imprimirListadoBaja');
	}

	public function actionUpdateinventario()
    {
    	if(isset($_POST["inventario"]))
    	{
	    	$uo = explode("-", $_POST["inventario"]);


   			if($_POST["tipoReporte"] == 1)
   			{
   				//$inventarios = Inventario::model()->findAll(array('order'=>'salidaResguardo', 'condition'=>"unidadOrganizacional_aid = ".$uo[0]));
   				$inventarios = DetalleInventario::model()->findAll('estatus_did = 1 AND unidadOrganizacional_did ='.$uo[0]);
   			}else{
   				$inventarios = SalidaResguardo::model()->findAll(array('order'=>'id', 'condition'=>"unidadOrganizacional_did = ".$uo[0]));
   			}


	    	if(count($inventarios) > 0){
	    		if($_POST["tipoReporte"] == 1)
	    		{
   					$this->renderPartial('_listadoinv', array('detalleInventario' => $inventarios, 'uo'=>$uo[0], 'tipoReporte'=>$_POST["tipoReporte"]));
   				}else{
   					$this->renderPartial('_listadoinvBaja', array('inventarios' => $inventarios, 'uo'=>$uo[0], 'tipoReporte'=>$_POST["tipoReporte"]));
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
/*
    public function actionBajaInventario()
	{

		$model=new Inventario;
		$modelDetalle = new DetalleInventario;
		$this->performAjaxValidation($model);
		if(isset($_POST['final'])){
			print_r($_POST);
			exit();
			$this->performAjaxValidation($modelDetalle);
			$this->bajamultiple($_POST);
		}
		if(isset($_POST['yt1'])){
			$this->performAjaxValidation($modelDetalle);
			$this->bajalote($_POST);
		}
		if(isset($_POST['Inventario']))
		{
			if($_POST['Inventario']['salidaResguardo'] != '')
			{
				$id = $_POST['Inventario']['salidaResguardo'];
				$inventario = Inventario::model()->find('salidaResguardo = '.$id);
				$inventariosNormales = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"inventario_did = ".$inventario->id." AND tipoCaptura = 'Normal' AND estatus_did = 1"));
				$inventariosMultiples = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"inventario_did = ".$inventario->id." AND tipoCaptura = 'Multiple' AND estatus_did = 1"));
				$inventariosLotes = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"inventario_did = ".$inventario->id." AND tipoCaptura = 'Lote' AND estatus_did = 1"));
				$this->renderPartial('_formBaja',array(
					'inventario'=>$inventario, 'inventariosNormales'=>$inventariosNormales, 'inventariosMultiples'=>$inventariosMultiples, 'inventariosLotes'=>$inventariosLotes, 'modelDetalle'=>$modelDetalle,
				));
			}
			else
			{
		    	echo '<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4>Mensaje:</h4>
						Proporcione una Salida Resguardo.
   						</div>';
		    }
		}
		else
		{
			$this->render('bajaInventario',array(
				'model'=>$model,
			));
		}
	}
*/
	public function actionBajanormal($id)
	{

		$model= DetalleInventario::model()->findByPk($id);
 		$model->estatus_did = 2;
 		if($model->update()){
   			$inventariosNormales = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"inventario_did = ".$model->inventario_did." AND tipoCaptura = 'Normal' AND estatus_did = 1"));
   			$this->redirect(array('inventario/bajainventario'));
   			//$this->renderPartial("_inventarioNormal",array('inventariosNormales'=>$inventariosNormales));
   			//echo $inventariosNormales;
  		}
  		else{
  			echo "error";
  		}
  	}

  	public function bajamultiple($datos)
	{
		try
		{
			$conection = Yii::app()->db;
			$comandoInventario = $conection->createCommand("UPDATE DetalleInventario SET estatus_did = :estatus
			 WHERE id BETWEEN :inicio AND :final AND inventario_did = :inventario AND tipoCaptura = :tipo");
			$comandoInventario->bindValue(":estatus", 2,PDO::PARAM_INT);
			$comandoInventario->bindValue(":inicio", $datos["inicio"],PDO::PARAM_INT);
			$comandoInventario->bindValue(":final", $datos["final"],PDO::PARAM_INT);
			$comandoInventario->bindValue(":inventario", $datos["inventario"],PDO::PARAM_INT);
			$comandoInventario->bindValue(":tipo", "Multiple",PDO::PARAM_STR);
			$comandoInventario->execute();

			$this->redirect(array('inventario/bajainventario'));
		}
		catch(Exception $e)
		{
			//$transaction->rollBack();
			echo '<pre>';print_r($e); echo "</pre>";
		}
  	}

  	public function bajalote($datos)
  	{
  		$modelo = DetalleInventario::model();
  		$transaccion = $modelo->dbConnection->beginTransaction();
  		try
		{
			foreach($datos as $key => $val) {
				if($key != 'yt1'){
					$registro = $modelo->findByPk($key);
					if($registro->cantidadPorLoteAct <= $val)
					{
						$registro->cantidadPorLoteAct = 0;
						$registro->estatus_did = 2;
					}
					else
					{
						$registro->cantidadPorLoteAct = $registro->cantidadPorLoteAct - $val;
					}
					$registro->update();
				}
			}
			$transaccion->commit();
			$this->redirect(array('inventario/bajainventario'));
		}
		catch(Exception $e)
		{
			$transaccion->rollBack();
			echo '<pre>';print_r($e); echo "</pre>";
		}
  	}

    public function actionImprimiretiqueta(){
        $this->render("imprimiretiqueta");
    }

    public function actionReubicacion(){
	$modelDetail = new DetalleInventario;

		if(isset($_POST['DetalleInventario']['id']) && empty($_POST['DetalleInventario']['unidadOrganizacional_did'])) {

            $resultadoId = 0;
            $resultadoSerie = 0;
            if($_POST['DetalleInventario']['tipoBusqueda'] == 'bInventario'){
          		$resultadoId = DetalleInventario::model()->exists('id ='.$_POST['DetalleInventario']['id']);
            } else if($_POST['DetalleInventario']['tipoBusqueda'] == 'bSerie'){
    			$resultadoSerie = DetalleInventario::model()->exists('serie ='.$_POST['DetalleInventario']['serie']);
            }

            if($resultadoId){
             	$modelDetail = DetalleInventario::model()->find('id ='.$_POST['DetalleInventario']['id']);
            } else if($resultadoSerie){
             	$modelDetail = DetalleInventario::model()->find('serie ='.$_POST['DetalleInventario']['serie']);
            }

            if(isset($modelDetail->id)){
	            if($modelDetail->estatus_did == 2 && $modelDetail->motivo_did != 1){
					Yii::app()->user->setFlash('warning', '<strong>El detalle de inventario no se encuentra en baja provisional, verifique su información</strong>');

					$this->render('reubicacion',array(
			            'modelDetail'=>$modelDetail,
				    ));
	            } else {
	            	$this->render("detalleReubicacion",array(
    					'modelDetail'=>$modelDetail
					));
	        	}
        	} else {
        		if($_POST['DetalleInventario']['tipoBusqueda'] == 'bInventario'){
					Yii::app()->user->setFlash('warning', '<strong>El número inventario no existe, verifique su información.</strong>');
				} else if($_POST['DetalleInventario']['tipoBusqueda'] == 'bSerie'){
					Yii::app()->user->setFlash('warning', '<strong>El número de serie no existe, verifique su información.</strong>');
				}

				$this->render('reubicacion',array(
		            'modelDetail'=>$modelDetail,
			    ));
        	}
		} else if(isset($_POST['DetalleInventario']['unidadOrganizacional_did'])){ //se actualiza la información del bien.
			$modelDetail = DetalleInventario::model()->find('id ='.$_POST['DetalleInventario']['id']);

            if(!empty($_POST['DetalleInventario']['funcion_aid'])){
            	$modelDetail->funcion_aid = $_POST['DetalleInventario']['funcion_aid'];
        	} else {
        		$modelDetail->funcion_aid = 1; //sin asignar espacio
        	}

            $modelDetail->unidadOrganizacional_did = $_POST['DetalleInventario']['unidadOrganizacional_did'];
            $modelDetail->estatus_did = 1; //el bien se pone en estatus de activo.
            $modelDetail->motivo_did = null; //se quita el motivo de baja que haya tenido registrado.

            if($modelDetail->update()){
            	Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha reubicado el inventario " . $modelDetail->id . "', '" . Yii::app()->user->name . "')")->execute();
            	Yii::app()->user->setFlash('success', '<strong>El bien se ha reubicado</strong>');
            	$modelDetail = new DetalleInventario;
            	$this->render('reubicacion',array(
		            'modelDetail'=>$modelDetail,
			    ));
            }
		}else{
			$this->render('reubicacion',array(
	            'modelDetail'=>$modelDetail,
		    ));
		}
    }

    public function actionDetalleReubicacion(){

    	$model = Inventario::model();
        $modelDetail = DetalleInventario::model();

    	$this->render("detalleReubicacion",array(
    		'model'=>$model,
            'modelDetail'=>$modelDetail
        ));
    }

    public function actionEspacios(){

        $funciones = CHtml::listData(Funcion::model()->findAllbySql(
                                                    'SELECT
	                                                    F.id
	                                                    ,F.nombre
                                                    FROM Funcion as F
                                                    INNER JOIN Espacio as E
	                                                    ON F.id = E.funcion_did
                                                    INNER JOIN UnidadOrganizacional AS U
	                                                    ON E.uO_did = U.codigo
                                                    WHERE U.id ='. $_POST['DetalleInventario']["unidadOrganizacional_did"] .'
                                                    ORDER BY nombre ASC'
                                                    ), 'id', 'nombre');

        foreach($funciones as $valor=>$nombre) {
           echo CHtml::tag('option', array('value'=>$valor),CHtml::encode($nombre),true);
        }
    }


	public function actionBajainventario()
	{

		if(isset($_POST['detalle'])){

			$autorizo = $_POST["autorizo_did"];

			$fechaDeBaja = date("Y-m-d");

			try
			{
				//$modelo = DetalleInventario::model();
	  			//$transaccion = $modelo->dbConnection->beginTransaction();

	  			$conexion = Yii::app()->db;
				$transaction = $conexion->beginTransaction();
				$comandoSalidaResguardo = $conexion->createCommand("INSERT INTO salidaResguardo
					(autorizo_did, fechaBaja_f, unidadOrganizacional_did)
					VALUES (:autorizo_did, :fechaBaja_f, :unidadOrganizacional)");
				$comandoSalidaResguardo->bindValue(":autorizo_did", $autorizo,PDO::PARAM_INT);
				$comandoSalidaResguardo->bindValue(":fechaBaja_f", $fechaDeBaja,PDO::PARAM_STR);
				$comandoSalidaResguardo->bindValue(":unidadOrganizacional", $_POST["uo_did"],PDO::PARAM_INT);
				$comandoSalidaResguardo->execute();

				$criteria = new CDbCriteria;
				$criteria->select='MAX(id) as id';
				$salidaResguardoId = SalidaResguardo::model()->find($criteria);
				foreach ($_POST['detalle'] as $registroBaja) {
					if($registroBaja['lote'] > 0)
					{

						$comandoInventarioBajaLote = $conexion->createCommand("INSERT INTO detalleBajaLote
						(detalleInventario_did, cantidadBaja, bajaResguardo, motivo_did)
						VALUES (:detalleInventario_did, :cantidadBaja, :bajaResguardo, :motivo_did)");
						$comandoInventarioBajaLote->bindValue(":detalleInventario_did", $registroBaja['id'],PDO::PARAM_INT);
						$comandoInventarioBajaLote->bindValue(":bajaResguardo", $salidaResguardoId->id,PDO::PARAM_INT);
						$comandoInventarioBajaLote->bindValue(":motivo_did", $registroBaja['motivoBaja'],PDO::PARAM_INT);
						$comandoInventarioBajaLote->bindValue(":cantidadBaja", $registroBaja['cantidadLoteBaja'],PDO::PARAM_INT);
						$comandoInventarioBajaLote->execute();


						if($registroBaja['cantLote'] <= $registroBaja['cantidadLoteBaja'])
						{

							$comandoDetalleInventario = $conexion->createCommand("UPDATE detalleInventario
							SET bajaResguardo = :bajaResguardo, cantidadPorLoteAct = 0, motivo_did = :motivo_did, estatus_did = 2
							WHERE id = :id ");
							$comandoDetalleInventario->bindValue(":bajaResguardo", $salidaResguardoId->id,PDO::PARAM_INT);
							$comandoDetalleInventario->bindValue(":motivo_did", $registroBaja['motivoBaja'],PDO::PARAM_INT);
							$comandoDetalleInventario->bindValue(":id", $registroBaja['id'],PDO::PARAM_INT);
							$comandoDetalleInventario->execute();

						}
						else
						{
							$comandoDetalleInventario = $conexion->createCommand("UPDATE detalleInventario
							SET bajaResguardo = :bajaResguardo, cantidadPorLoteAct = :cantidadPorLoteAct
							WHERE id = :id ");
							$comandoDetalleInventario->bindValue(":bajaResguardo", $salidaResguardoId->id,PDO::PARAM_INT);
							$comandoDetalleInventario->bindValue(":cantidadPorLoteAct", $registroBaja['cantLote'] - $registroBaja['cantidadLoteBaja'],PDO::PARAM_INT);
							$comandoDetalleInventario->bindValue(":id", $registroBaja['id'],PDO::PARAM_INT);
							$comandoDetalleInventario->execute();

						}

					}
					else
					{
						$comandoDetalleInventario = $conexion->createCommand("UPDATE detalleInventario
						SET bajaResguardo = :bajaResguardo, motivo_did = :motivo_did, estatus_did = 2
						WHERE id = :id ");
						$comandoDetalleInventario->bindValue(":bajaResguardo", $salidaResguardoId->id,PDO::PARAM_INT);
						$comandoDetalleInventario->bindValue(":motivo_did", $registroBaja['motivoBaja'],PDO::PARAM_INT);
						$comandoDetalleInventario->bindValue(":id", $registroBaja['id'],PDO::PARAM_INT);
						$comandoDetalleInventario->execute();
					}


				}
				$transaction->commit();
				//$transactionLote->commit();
			}
			catch(Exception $e)
			{
				$transaction->rollBack();
				//$transactionLote->rollBack();
				echo '<pre>';print_r($e); echo "</pre>";
			}
			$this->redirect(array('inventario/impresguardobaja/'.$salidaResguardoId->id));
		}

		$this->render("bajainventario",array());

	}

	public function actionDetallebajainventario(){

		try
		{
			if($_POST["busqueda"] == 1)
			{
				$inventarios = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"id >= ".$_POST["invInicio"]." AND id <= ".$_POST["invFin"]." AND unidadOrganizacional_did = ".$_POST["uo"]." AND estatus_did=1"));
			}
			else
			{
				$inventarios = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"id = ".$_POST["invInicio"]." AND unidadOrganizacional_did = ".$_POST["uo"]." AND estatus_did=1"));
			}

			$resultado = array();
			if(count($inventarios) > 0 )
			{
				$position = 0;
				foreach ($inventarios as $inventario) {
					$detalle["id"] = $inventario->id;
					$detalle["lote"] = $inventario->lote;
					$detalle["cantidadLote"] = $inventario->cantidadPorLoteAct;
					$detalle["nombre"] = $inventario->articulo->nombre;
					$detalle["uo"] = $inventario->inventario->unidadOrganizacional->nombre;
					$datosInventario[$position] = $detalle;
					$position++;
				}

				$resultado["estatus"] = 1;
				$resultado["datos"] = $datosInventario;
			}
			else
			{
				$resultado["estatus"] = 0;
				$resultado["datos"] = "";
			}

			echo json_encode($resultado);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}

	}

	public function actionImpResguardoBaja($id){

		$salidaResguardo = SalidaResguardo::model()->findByPk($id);
		$inventarios = DetalleInventario::model()->findAll(array('order'=>'id', 'condition'=>"bajaResguardo = ".$id." AND tipoCaptura <> 'LOTE'"));
		$inventariosLote = DetalleBajaLote::model()->findAll(array('order'=>'id', 'condition'=>"bajaResguardo = ".$id.""));

		$position = 0;
		$totalCosto = 0;
		foreach ($inventarios as $inventario) {
				$detalle = array();
				$detalle["id"] = $inventario->id;
				$detalle["fec_adq"] = $inventario->inventario->fechaAdquisicion_f;
				$detalle["articulo"] = $inventario->articulo->nombre;
				$detalle["funcion"] = $inventario->funcion->nombre;
				$detalle["serie"] = $inventario->serie;
				$detalle["tipoBaja"] = $inventario->motivoBaja->nombre;
				$detalle["fec_baja"] = $salidaResguardo->fechaBaja_f;
				$detalle["fondo"] = $inventario->inventario->fondo->codigo;
				$detalle["cant_lote"] = "";
				$detalle["costo"] = number_format($inventario->totalCostoAdquisicion, 2);
				$detalle["uo"] = $inventario->unidadOrganizacional_did;

				$totalCosto = $totalCosto + $inventario->totalCostoAdquisicion;

				$datosInventario[$position] = $detalle;
				$position++;

		}

		foreach ($inventariosLote as $inventarioLote) {
				$detalle = array();
				$detalle["id"] = $inventarioLote->detalleInventario_did;
				$detalle["fec_adq"] = $inventarioLote->detalleinventario->inventario->fechaAdquisicion_f;
				$detalle["articulo"] = $inventarioLote->detalleinventario->articulo->nombre;
				$detalle["funcion"] = $inventarioLote->detalleinventario->funcion->nombre;
				$detalle["serie"] = $inventarioLote->detalleinventario->serie;
				$detalle["tipoBaja"] = $inventarioLote->motivoBaja->nombre;
				$detalle["fec_baja"] = $salidaResguardo->fechaBaja_f;
				$detalle["fondo"] = $inventarioLote->detalleinventario->inventario->fondo->codigo;
				$detalle["cant_lote"] = $inventarioLote->cantidadBaja;

				$totalCostoLote = ($inventarioLote->detalleinventario->totalCostoAdquisicion/$inventarioLote->detalleinventario->cantidadPorLote) * $inventarioLote->cantidadBaja;
				$detalle["costo"] = number_format($totalCostoLote, 2);
				$detalle["uo"] = $inventarioLote->detalleinventario->unidadOrganizacional_did;

				$totalCosto = $totalCosto + $totalCostoLote;

				$datosInventario[$position] = $detalle;
				$position++;

		}

		$uo = $salidaResguardo->unidadOrganizacional->codigo."  ".$salidaResguardo->unidadOrganizacional->nombre;

		$this->layout = "pdf";
		$this->render('implistadoinvbaja', array('inventarios' => $datosInventario, 'unidadOrg'=>$uo, 'resBaja'=>$id, 'totalCosto'=> number_format($totalCosto,2)));
	}

	public function actionGetproveedores(){
	  $elementos = Proveedor::model()->findAllbySql(
	                                              'SELECT
	                                              	P.id as id,
	                                                CONCAT(P.id,"-",P.nombre) AS nombre
	                                              FROM Proveedor as P
	                                              WHERE nombre LIKE CONCAT("%","' . $_GET['q'] . '","%")
	                                              ORDER BY nombre ASC'
	                                              );
	  $data=array();
	  foreach($elementos as $elem){
	      $data[]=array("id"=>$elem->id,
	      							"nombre"=>$elem->nombre);
	  }
	  $this->layout='empty';
	  echo json_encode($data);
  }

  public function actionGetunidadesorganizacional(){
	  $elementos = UnidadOrganizacional::model()->findAllbySql(
	                                              'SELECT
	                                              	P.id as id,
	                                                CONCAT(P.id,"-",P.nombre) AS nombre
	                                              FROM UnidadOrganizacional as P
	                                              WHERE nombre LIKE CONCAT("%","' . $_GET['q'] . '","%")
	                                              ORDER BY nombre ASC'
	                                              );
	  $data=array();
	  foreach($elementos as $elem){
	      $data[]=array("id"=>$elem->id,
	      							"nombre"=>$elem->nombre);
	  }
	  $this->layout='empty';
	  echo json_encode($data);
  }

  public function actionGetfondos(){
	  $elementos = Fondo::model()->findAllbySql(
	                                              'SELECT
	                                              	P.id as id,
	                                                CONCAT(P.id,"-",P.nombre) AS nombre
	                                              FROM Fondo as P
	                                              WHERE nombre LIKE CONCAT("%","' . $_GET['q'] . '","%")
	                                              ORDER BY nombre ASC'
	                                              );
	  $data=array();
	  foreach($elementos as $elem){
	      $data[]=array("id"=>$elem->id,
	      							"nombre"=>$elem->nombre);
	  }
	  $this->layout='empty';
	  echo json_encode($data);
  }

  public function actionGetarticulos(){
	  $elementos = Articulo::model()->findAllbySql(
	                                              'SELECT
	                                              	P.id as id,
	                                                CONCAT(P.id,"-",P.nombre) AS nombre
	                                              FROM Articulo as P
	                                              WHERE nombre LIKE CONCAT("%","' . $_GET['q'] . '","%")
	                                              ORDER BY nombre ASC'
	                                              );
	  $data=array();
	  foreach($elementos as $elem){
	      $data[]=array("id"=>$elem->id,
	      							"nombre"=>$elem->nombre);
	  }
	  $this->layout='empty';
	  echo json_encode($data);
  }

  public function actionGetmarcas(){
	  $elementos = Marca::model()->findAllbySql(
	                                              'SELECT
	                                              	P.id as id,
	                                                CONCAT(P.id,"-",P.nombre) AS nombre
	                                              FROM Marca as P
	                                              WHERE nombre LIKE CONCAT("%","' . $_GET['q'] . '","%")
	                                              ORDER BY nombre ASC'
	                                              );
	  $data=array();
	  foreach($elementos as $elem){
	      $data[]=array("id"=>$elem->id,
	      							"nombre"=>$elem->nombre);
	  }
	  $this->layout='empty';
	  echo json_encode($data);
  }
}
