<?php

class SiteController extends Controller
{
	public $layout='//layouts/main';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	 public function actionDashboard($id)
	 {
		 $this->render("dashboard",array('id'=>$id));
	 }
	 
	public function actionIndex()
	{
		$usuarioActual = Usuario::model()->find('usuario=:x',array(':x'=>Yii::app()->user->name));
		
		if(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Director'){ //Norma
			$model=new Proveedor('search');
			$model->unsetAttributes();
			if(isset($_GET['Proveedor']))
				$model->attributes=$_GET['Proveedor'];
			$this->render('director',array(
				'model'=>$model,
			));
		}	
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Asistente1'){ //Mayra		
			$this->render('asistente1');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Asistente2'){ //Nelly
			$this->render('asistente2');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'OrdenCompra'){ //Tonny
			$this->render('ordencompra');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Contrarecibo'){ //Cualquier Proveedor
			$this->render('contrarecibo');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Pasivo'){ //Almacenista
			$this->render('pasivo');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Almacen'){ //Inventario
			$this->render('almacen');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Inventario'){ //Inventario
			$this->render('inventario');
		}
		elseif(isset($usuarioActual) && $usuarioActual->tipoUsuario->nombre == 'Proveedor'){ //Jessica
			$this->render('proveedor',array('usuarioActual'=>$usuarioActual, 'proveedorId'=>Proveedor::model()->obtenerProveedorActual()->id));
		}
		else{
			$this->render('index');
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				$this->redirect(array('contactoenviado'));
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	
	public function actionContactoenviado()
	{
		$this->render('contactoenviado');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			$model->password = md5($model['password']);
			
			Yii::app($model->username . ' se ha logueado','info','application.*');
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha iniciado sesión', '" . $model->username . "')")->execute();
				$this->redirect(Yii::app()->user->returnUrl);
			}
			else
			{
				$model->password = "";
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model)); 
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->db->createCommand("insert into Actividad (mensaje, usuario) Values ('Ha cerrado sesión', '" . Yii::app()->user->name . "')")->execute();
		Yii::app()->user->logout();
		if(isset($_GET["id"])){			
			Yii::app()->session->open();
			Yii::app()->user->setFlash('success', '<strong>Su inicio de sesión fue cambiada, por favor inicie sesión nuevamente.!</strong>',false);
		}
		
		$this->redirect(Yii::app()->homeUrl);
	}
}