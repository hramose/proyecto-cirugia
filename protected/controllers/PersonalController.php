<?php

class PersonalController extends Controller
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

	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
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
				'actions'=>array('index','view','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'exportar', 'pendientes'),
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

	public function actionPendientes()
	{
		//Aca cargaremos todos los modelos
		$citasHoy = Citas::model()->count("fecha_cita = '".date('Y-m-d')."' and estado = 'Programada' and personal_id = ".Yii::app()->user->usuarioId);
		$seguimientosHoy = SeguimientoComercial::model()->count("fecha_atencion = '".date('Y-m-d')."' and estado = 'Abierto' and responsable_id = ".Yii::app()->user->usuarioId);
		$citasVencidas = Citas::model()->count("estado = 'Vencida' and personal_id = ".Yii::app()->user->usuarioId);
		$seguimientosVencidos = SeguimientoComercial::model()->count("estado = 'Vencido' and responsable_id = ".Yii::app()->user->usuarioId);
		$tareas = PersonalTareas::model()->count("estado = 'Activa' and personal_id = ".Yii::app()->user->usuarioId);
		$tareasVencidas = PersonalTareas::model()->count("estado = 'Vencida' and personal_id = ".Yii::app()->user->usuarioId);

		$this->layout='main';
		$this->render('pendientes', array('citasHoy'=>$citasHoy, 
		'seguimientosHoy'=>$seguimientosHoy,
		'citasVencidas'=>$citasVencidas,
		'seguimientosVencidos'=>$seguimientosVencidos,
		'tareas'=>$tareas,
		'tareasVencidas'=>$tareasVencidas,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Personal;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Personal']))
		{
			$model->attributes=$_POST['Personal'];
			$model->agenda = $_POST['Personal']['agenda'];
			$model->fecha_nacimiento = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Personal']['fecha_nacimiento']);
			$model->expedicion = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Personal']['expedicion']);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionExportar()
	{
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['clave'] == $clave->super_usuario) 
		{
			if ($_POST['filtro'] == 1) 
			{
				$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
				$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

				$attribs = array();
				$criteria = new CDbCriteria(array('order'=>'id DESC'));
				$criteria->addBetweenCondition('fecha_sola', $laFechaDesde, $laFechaHasta);
				$rows = Personal::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = Personal::model()->findAll();
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'nombres',
	            'apellidos',
	            'idPerfil.nombre',
	            'activo',
	            'telefono',
	            'celular',
	            'agenda',
	            'cc',
	        ));
	    }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new Personal('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Personal']))
				$model->attributes=$_GET['Personal'];

			$this->render('admin',array(
				'model'=>$model,
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

		if(isset($_POST['Personal']))
		{
			$model->attributes=$_POST['Personal'];
			$model->agenda = $_POST['Personal']['agenda'];
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
		$dataProvider=new CActiveDataProvider('Personal');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personal']))
			$model->attributes=$_GET['Personal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Personal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Personal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Personal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
