<?php

class SeguimientoComercialController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'cerrar'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'vencidos', 'vencidosDetalle'),
				'users'=>array('@'),
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

	public function actionVencidos()
	{
		//$elPersonal = Citas::model()->count("estado = 'Vencida' group by personal_id");
		//$elPersonal = Personal::model()->findAll("agenda = 'SI'");

		//Verificar Seguimientos Vencidos
		$vencidos = SeguimientoComercial::model()->findAll("fecha_accion < '".date('Y-m-d')."' and estado ='Abierto'");
		foreach ($vencidos as $los_vencidos) 
		{
			$los_vencidos->estado = "Vencido";
			$los_vencidos->save();
		}

		$this->render('vencidos');
	}

	public function actionView($id)
	{
		$model=new SeguimientoComercialDetalle;
		$this->performAjaxValidation($model);

		if(isset($_POST['SeguimientoComercialDetalle']))
		{
			$model->attributes=$_POST['SeguimientoComercialDetalle'];
			$model->seguimiento_comercial_id = $_GET['id'];
			$model->fecha_seguimiento = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['SeguimientoComercialDetalle']['fecha_seguimiento']);
			$model->fecha_registro = date("Y-m-d");
			$model->id_personal = Yii::app()->user->usuarioId;

			if($model->save())
				//Actualizar fecha de acción en seguimiento comercial
				$seguimientoActual = SeguimientoComercial::model()->findByPk($model->seguimiento_comercial_id);
				if ($seguimientoActual->estado == "Vencido") {
					$seguimientoActual->estado = "Abierto";
					$seguimientoActual->id_personal = Yii::app()->user->usuarioId;
					$seguimientoActual->responsable_id = $_POST['SeguimientoComercialDetalle']['responsable_id'];
				}
				else
				{
					$seguimientoActual->id_personal = $model->id_personal;
					$seguimientoActual->responsable_id = $model->responsable_id;
				}
				$seguimientoActual->ultimo_seguimiento = $model->seguimiento;			
				$seguimientoActual->fecha_accion = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['SeguimientoComercialDetalle']['fecha_seguimiento']);
				$seguimientoActual->save();
				
				$this->redirect(array('view','id'=>$model->seguimiento_comercial_id));
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
		$model=new SeguimientoComercial;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SeguimientoComercial']))
		{
			$model->attributes=$_POST['SeguimientoComercial'];
			$model->personal_creador_id = $_POST['SeguimientoComercial']['id_personal'];

			//Cedula
			$lacedula = Paciente::model()->findByPk($_POST['SeguimientoComercial']['paciente_id']);
			$model->paciente_documento = $lacedula->n_identificacion;
			
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

		if(isset($_POST['SeguimientoComercial']))
		{
			$model->attributes=$_POST['SeguimientoComercial'];
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SeguimientoComercial');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		//Verificar Seguimientos Vencidos
		$vencidos = SeguimientoComercial::model()->findAll("fecha_accion < '".date('Y-m-d')."' and estado ='Abierto'");
		foreach ($vencidos as $los_vencidos) 
		{
			$los_vencidos->estado = "Vencido";
			$los_vencidos->save();
		}


		$model=new SeguimientoComercial('search');
		

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SeguimientoComercial']))
			$model->attributes=$_GET['SeguimientoComercial'];
			
			if(isset($_GET['filtro']))
			{
				if ($_GET['filtro'] == 1) {
					$model->estado = "Abierto";
				}
				if ($_GET['filtro'] == 2) {
					$model->estado = "Cerrado";
				}	
				if ($_GET['filtro'] == 3) {
					$model->estado = "Vencido";
				}
			}

			if (isset($_GET['usuario'])) 
			{
				$model->fecha_accion = date("d-m-Y");
				//$model->estado = "Abierto";
				$model->responsable_id = Yii::app()->user->usuarioId;
			}

			if (isset($_GET['vencidos'])) 
			{
				$model->responsable_id = Yii::app()->user->usuarioId;
			}

		$this->layout='main';
		$this->render('admin',array(
			
			'model'=>$model,
		));
	}

	public function actionVencidosDetalle()
	{

		

		$model=new SeguimientoComercial('search');
		

		$model->unsetAttributes();  // clear any default values
		$model->responsable_id = $_GET['idPersonal'];
		$model->estado = "Vencido";
		$this->layout='main';
		$this->render('vencidosDetalle',array(
			
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SeguimientoComercial the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SeguimientoComercial::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SeguimientoComercial $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seguimiento-comercial-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCerrar()
	{
		
		$id = $_GET['idSeguimiento'];
		$model=SeguimientoComercial::model()->findByPk($_GET['idSeguimiento']);
		if (isset($_POST['SeguimientoComercial'])) 
		{
			$model->estado = "Cerrado";
			//$seguimientoActual->$_POST['SeguimientoComercial']['comentario_estado'];
			$model->comentario_estado = $_POST['SeguimientoComercial']['comentario_estado'];
			$model->save();
		}	
		$this->render('view',array(
			'model'=>$this->loadModel($model->id),
		));
	}
}
