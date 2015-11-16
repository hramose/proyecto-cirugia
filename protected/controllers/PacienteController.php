<?php

class PacienteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	 public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }

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
				'actions'=>array('index','view', 'depositoCaja', 'depositoPaciente'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'upload', 'cajas', 'ingresoCajaPaciente'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'upload', 'exportar'),
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

	public function actionDepositoCaja($idContrato)
	{
		$todoContrato = Contratos::model()->findByPk($idContrato);
		$this->render('depositoCaja',array(
			'model'=>$todoContrato,
		));
	}

	public function actionIngresoCajaPaciente($idOrigen)
	{
		//Buscar Paciente Origen
		$pacienteOrigen = Paciente::model()->findByPk($idOrigen);

		//Ingreso a Caja de Paciente
		$pacienteDestino = Paciente::model()->findByPk($_POST['paciente']);
		$pacienteDestino->saldo = $pacienteDestino->saldo + $_POST['valor'];
		if($pacienteDestino->update())
		{
			//Registro en caja
			$movimientoDeposito = new PacienteMovimientos;
			$movimientoDeposito->paciente_id	= $pacienteDestino->id;
			$movimientoDeposito->valor 			= $_POST['valor'];
			$movimientoDeposito->tipo			= "Ingreso";
			$movimientoDeposito->sub_tipo 		= "Tranferencia de Paciente";
			$movimientoDeposito->descripcion	= "El Paciente No. ".$pacienteOrigen->id." Nombre: ".$pacienteOrigen->nombreCompleto.". Realizo un traslado de su caja a este paciente";
			$movimientoDeposito->usuario_id		= Yii::app()->user->usuarioId;
			$movimientoDeposito->fecha 			= date("Y-m-d H:i:s");
			$movimientoDeposito->save();

			//Retiro a Caja de Paciente
			$pacienteOrigen->saldo = $pacienteOrigen->saldo - $_POST['valor'];
			$pacienteOrigen->update();
		}

		$this->render('view',array(
			'model'=>$pacienteDestino,
		));
	}

	public function actionDepositoPaciente($idPaciente)
	{
		$todoPaciente = Paciente::model()->findByPk($idPaciente);
		$this->render('depositoPaciente',array(
			'model'=>$todoPaciente,
		));
	}

	public function actionView($id)
	{
		if (isset($_POST['SeguimientoComercial'])) 
		{
			$model=new SeguimientoComercial;
			
			$model->fecha_accion = 		Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['SeguimientoComercial']['fecha_accion']);
			$model->tema_id = 			$_POST['SeguimientoComercial']['tema_id'];
			$model->responsable_id = 	$_POST['SeguimientoComercial']['responsable_id'];
			$model->observaciones = 	$_POST['SeguimientoComercial']['observaciones'];
			$model->paciente_id = 		$_POST['SeguimientoComercial']['paciente_id'];
			$model->id_personal = 		Yii::app()->user->usuarioId;
			$model->fecha_registro =	date("Y-m-d");
			$model->tipo = "Paciente";
			//Fecha de registro
			$model->estado = 		"Abierto";

			$model->save();
				
				//Redireccionar
			Yii::app()->user->setFlash('success',"Se creo el Seguimiento Comercial.");
				$this->render('view',array(
					'model'=>$this->loadModel($id),
				));
			
		}
		else
		{


		if(isset($_POST['PacienteSucesos']))
		{
			$model=new PacienteSucesos;
			$model->attributes=$_POST['PacienteSucesos'];
			$model->suceso = $_POST['PacienteSucesos']['suceso'];
			$model->fecha = date("Y-m-d H:i:s");
			$model->usuario_id = Yii::app()->user->usuarioId;
			$model->save();
			//Redireccionar
			Yii::app()->user->setFlash('success',"Se Registro el Suceso.");
				$this->render('view',array(
					'model'=>$this->loadModel($id),
				));
		}
		else
		{
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));	
		}

		
	}
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Paciente;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Paciente']))
		{
			$model->attributes=$_POST['Paciente'];
			if ($_POST['Paciente']['fecha_nacimiento'] == "") 
			{
				$model->fecha_nacimiento = date("Y-m-d");
			}
			else
			{
				$model->fecha_nacimiento = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Paciente']['fecha_nacimiento']);	
			}
			$model->observaciones = $_POST['Paciente']['observaciones'];
			$model->fecha_registro = date("Y-m-d");
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Paciente']))
		{
			$model->attributes=$_POST['Paciente'];
			$model->observaciones = $_POST['Paciente']['observaciones'];
			$model->fecha_nacimiento = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Paciente']['fecha_nacimiento']);
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

	public function actionExportar()
	{
		if ($_POST['filtro'] == 1) 
		{
			$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
			$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

			$attribs = array();
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
			$criteria->addBetweenCondition('fecha_registro', $laFechaDesde, $laFechaHasta);
			$rows = Paciente::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			$rows = paciente::model()->findAll();
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::ID',
            'nombreCompleto',
            'n_identificacion::Cedula',
            'email',
            'telefono1',
            'celular',
            'ciudad',
            'fecha_nacimiento',
        ));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Paciente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Paciente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paciente']))
			$model->attributes=$_GET['Paciente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCajas()
	{
		$model=new Paciente('searchCaja');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paciente']))
			$model->attributes=$_GET['Paciente'];

		$this->render('cajas',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Paciente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Paciente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Paciente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='paciente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
