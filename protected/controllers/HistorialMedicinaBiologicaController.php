<?php

class HistorialMedicinaBiologicaController extends Controller
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
				'actions'=>array('create','update','guardarMedicina'),
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
		$model=new HistorialMedicinaBiologica;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HistorialMedicinaBiologica']))
		{
			$model->attributes=$_POST['HistorialMedicinaBiologica'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionGuardarMedicina()
	{

		if (isset($_GET['idCita'])) {
				$idCita = $_GET['idCita'];
			}
			else
			{
				$idCita = null;
			}

		if ($idCita == 0) {
			$idCita = null;
		}

		$idMedicina = $_GET['idMedicina'];
		if ($idMedicina > 0) {
			$losCiclos = new HistorialMedicinaBiologicaDetalle;
			$criteria=new CDbCriteria;
			$criteria->select='max(ciclo) AS ciclo';
			$criteria->condition = "historial_medicina_biologica_id = $idMedicina";
			$row = $losCiclos->model()->find($criteria);
			$elid = $row['ciclo']+1;
			//$elid = $row['ciclo'];
		}
		else
		{
			$elid = 1;
		}
		
		
		// print_r($elid);
		// die;
		
		if ($elid == 1) {
			$model=new HistorialMedicinaBiologica;		
			$model->paciente_id = $_GET['idPaciente'];
			$model->personal_id = Yii::app()->user->usuarioId;
			$model->cita_id = $idCita;
			// $model->observaciones = $_POST['observaciones'];
 		
			$model->fecha = date("Y-m-d");
			
			 if($model->save())
			 {
			 	$eltotal = 0;
			 	for ($i=0; $i <= $_POST['variable']; $i++) {

			 		//
			 		if (isset($_POST['medicamento_'.$i])) 
			 		{
			 			$eltotal = $eltotal+1;
			 			$detalleP = new HistorialMedicinaBiologicaDetalle;
			 			$detalleP->historial_medicina_biologica_id = $model->id;
			 			$detalleP->ciclo = $elid;
			 			$detalleP->sesion = $eltotal;
			 			$detalleP->medicamentos_biologicos_id = $_POST['medicamento_'.$i];
			 			$detalleP->save();
			 		}			 		
			 	}
			 	$this->redirect(array('view','id'=>$model->id));
			}		
		}
		else
		{
			$eltotal = 0;
		 	for ($i=0; $i <= $_POST['variable']; $i++) {

		 		//
		 		if (isset($_POST['medicamento_'.$i])) 
		 		{
		 			$eltotal = $eltotal+1;
		 			$detalleP = new HistorialMedicinaBiologicaDetalle;
		 			$detalleP->historial_medicina_biologica_id = $idMedicina;
		 			$detalleP->ciclo = $elid;
		 			$detalleP->sesion = $eltotal;
		 			$detalleP->medicamentos_biologicos_id = $_POST['medicamento_'.$i];
		 			$detalleP->save();
		 		}			 		
		 	}
		 	$this->redirect(array('view','id'=>$idMedicina));
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

		if(isset($_POST['HistorialMedicinaBiologica']))
		{
			$model->attributes=$_POST['HistorialMedicinaBiologica'];
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
		$dataProvider=new CActiveDataProvider('HistorialMedicinaBiologica');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistorialMedicinaBiologica('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistorialMedicinaBiologica']))
			$model->attributes=$_GET['HistorialMedicinaBiologica'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HistorialMedicinaBiologica the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HistorialMedicinaBiologica::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HistorialMedicinaBiologica $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historial-medicina-biologica-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
