<?php

class PacienteResultadosLabController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','borrarResultados'),
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
		$model=new PacienteResultadosLab;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PacienteResultadosLab']))
		{
			$model->attributes=$_POST['PacienteResultadosLab'];
			$model->paciente_id = $_GET['idPaciente'];
			if (isset($_GET['idCita'])) 
			{
				$model->cita_id = $_GET['idCita'];
			}
			$model->personal_id = Yii::app()->user->usuarioId;
			$model->fecha = date("Y-m-d H:i:s");
			if($model->save())
			{
				$losarchivos = TempExamenes::model()->findAll();
				foreach($losarchivos as $los_archivos)
				{
					$losAdjuntos = new PacienteResultadosLabDetalle; //Tabla que queda
					$losAdjuntos->paciente_resultados_lab_id = $model->id;	
					$losAdjuntos->archivo = $los_archivos->archivo;
					$losAdjuntos->save();
				}
				TempExamenes::model()->deleteAll();
			}
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

		if(isset($_POST['PacienteResultadosLab']))
		{
			$model->attributes=$_POST['PacienteResultadosLab'];
			if($model->save())
			{
			$losarchivos = TempExamenes::model()->findAll();
			foreach($losarchivos as $los_archivos)
			{
				$losAdjuntos = new PacienteResultadosLabDetalle; //Tabla que queda
				$losAdjuntos->paciente_resultados_lab_id = $model->id;	
				$losAdjuntos->archivo = $los_archivos->archivo;
				$losAdjuntos->save();
			}
			TempExamenes::model()->deleteAll();
			}
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
		$dataProvider=new CActiveDataProvider('PacienteResultadosLab');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionBorrarResultados($id)
	{
		$elarchivo = PacienteResultadosLabDetalle::model()->findByPk($id);
		unlink("..".yii::app()->baseUrl."/adjuntos/".$elarchivo->archivo);
		$elarchivo->delete();

		$this->redirect(array('update','id'=>$elarchivo->paciente_resultados_lab_id,"idPaciente"=>$elarchivo->id, "idCita"=>$elarchivo->pacienteResultadosLab->cita_id));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PacienteResultadosLab('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PacienteResultadosLab']))
			$model->attributes=$_GET['PacienteResultadosLab'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PacienteResultadosLab the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PacienteResultadosLab::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PacienteResultadosLab $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='paciente-resultados-lab-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
