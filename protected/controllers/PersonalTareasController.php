<?php

class PersonalTareasController extends Controller
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
				'actions'=>array('admin','delete', 'comentario', 'cierre'),
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

	public function actionComentario($id)
	{
		//Agregar Comentario

		$elComentario = date("d-m-Y H:m:s")."<br>-------------------------<br>".$_POST['PersonalTareas']['comentarios_responsable']."<br><br>";

		$laTarea = PersonalTareas::model()->findByPk($id);
		$laTarea->comentarios_responsable = $elComentario.$laTarea->comentarios_responsable;
		$laTarea->comentario_cierre = $_POST['PersonalTareas']['comentarios_responsable'];
		$laTarea->update();
		if ($laTarea->update()) 
		{
			$this->redirect(array('view','id'=>$laTarea->id));
		}
	}

	public function actionCierre($id)
	{
		//Agregar Comentario
		$laTarea = PersonalTareas::model()->findByPk($id);
		$laTarea->comentario_cierre = $_POST['PersonalTareas']['comentario_cierre'];
		$laTarea->estado = "Completada";
		$laTarea->fecha_cierre = date("Y-m-d H:i:s");
		$laTarea->update();
		if ($laTarea->update()) 
		{
			$this->redirect(array('view','id'=>$laTarea->id));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PersonalTareas;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['PersonalTareas']))
		{
			//$fechaCumplir = Yii::app()->dateformatter->format("yyyy-MM-dd", $_POST['PersonalTareas']['fecha_cumplir']);
			$model->attributes=$_POST['PersonalTareas'];
			if ($_POST['PersonalTareas']['fecha_cumplir'] == "") 
			{
				$model->fecha_cumplir = NULL;
			}
			else
			{
				$model->fecha_cumplir = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['PersonalTareas']['fecha_cumplir']);	
			}

			
			$model->fecha = date("Y-m-d H:i:s");
			//$model->fecha_cumplir = $fechaCumplir;
			$model->usuario_id = Yii::app()->user->usuarioId;
			$model->estado = "Activa";
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

		if(isset($_POST['PersonalTareas']))
		{
			$model->attributes=$_POST['PersonalTareas'];
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
		$dataProvider=new CActiveDataProvider('PersonalTareas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PersonalTareas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['filtro']))
		{
			if ($_GET['filtro'] == 1) {
				$model->estado = "Activa";
			}

			if ($_GET['filtro'] == 2) {
				$model->estado = "Vencida";
			}
		}

		if(isset($_GET['usuario']))
		{
			$model->personal_id = Yii::app()->user->usuarioId;
		}

		if(isset($_GET['personalId']))
		{
			$model->personal_id = $_GET['personalId'];
		}
		if(isset($_GET['PersonalTareas']))
			$model->attributes=$_GET['PersonalTareas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PersonalTareas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PersonalTareas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PersonalTareas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personal-tareas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
