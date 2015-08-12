<?php

class HistorialPlanTratamientoController extends Controller
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
				'actions'=>array('create','update', 'guardarPlan'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new HistorialPlanTratamiento;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HistorialPlanTratamiento']))
		{			
			$model->attributes=$_POST['HistorialPlanTratamiento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionGuardarPlan()
	{
		$model=new HistorialPlanTratamiento;		

			if (isset($_GET['idCita'])) {
				$idCita = $_GET['idCita'];
			}
			else
			{
				$idCita = null;
			}

			$model->paciente_id = $_GET['idPaciente'];
			$model->cita_id = $idCita;
			$model->personal_id = Yii::app()->user->usuarioId;
			$model->observaciones = $_POST['observaciones'];
			$model->fecha = date("Y-m-d");
			
			if($model->save())
			{
			 	$eltotal = 0;
			 	for ($i=0; $i <= $_POST['variable']; $i++) {
			 		//$x = $i+1;
			 		//
			 		if (isset($_POST['lineas_'.$i])) 
			 		{
			 			$detalleP = new HistorialPlanTratamientoDetalle;
			 			$detalleP->historial_plan_tratamiento_id = $model->id;
			 			$detalleP->linea_servicio_id = $_POST['lineas_'.$i];
			 			$detalleP->observacion = $_POST['observaciones_'.$i];
			 			$detalleP->save();
			 		}			 		
				}
				$this->redirect(array('view','id'=>$model->id));
			}


		//}

		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
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

		if(isset($_POST['HistorialPlanTratamiento']))
		{
			$model->attributes=$_POST['HistorialPlanTratamiento'];
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
		$dataProvider=new CActiveDataProvider('HistorialPlanTratamiento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistorialPlanTratamiento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistorialPlanTratamiento']))
			$model->attributes=$_GET['HistorialPlanTratamiento'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HistorialPlanTratamiento the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HistorialPlanTratamiento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HistorialPlanTratamiento $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historial-plan-tratamiento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
