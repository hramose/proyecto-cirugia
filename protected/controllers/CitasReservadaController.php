<?php

class CitasReservadaController extends Controller
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
				'actions'=>array('admin','delete','verReserva'),
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

	public function actionVerReserva($id)
	{
		$laReserva = CitasReservadaDetalle::model()->findByPk($id);
		$laCitaReservada = CitasReservada::model()->findByPk($laReserva->cita_reservada_id);
		//$this->redirect(array('view','id'=>$laReserva->cita_reservada_id));
		$this->render('view',array(
			'model'=>$laCitaReservada,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CitasReservada;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['CitasReservada']))
		{
			$model->attributes=$_POST['CitasReservada'];
			//Proceder a crear y guardar cita
			//Solo 1 dia
			if($_POST['opciones'] == "Horas")
			{
				//Verificar si hay cita entre el periodo


				$lacita = new Citas("otra");
				$lacita->fecha_cita 	= Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['CitasReservada']['fecha_inicio']);
				$lacita->hora_fin 		= $_POST['CitasReservada']['hora_fin'];
				$lacita->hora_fin_mostrar = $_POST['CitasReservada']['hora_fin'];
				$lacita->hora_inicio 	= $_POST['CitasReservada']['hora_inicio'];
				$lacita->linea_servicio_id = 26;
				$lacita->estado = "Reservado";
				$lacita->correo = "No";
				$lacita->comentario = "Bloqueo de agenda";
				$lacita->personal_id = $_POST['CitasReservada']['personal_id'];
				$lacita->fecha_creacion = date("Y-m-d");
				$lacita->fecha_hora_creacion = date("Y-m-d H:i:s");
				$lacita->usuario_id = Yii::app()->user->usuarioId;



				if ($lacita->save()) 
				{
					$model->scenario = 'horas';
					$model->personal_id = $lacita->personal_id;
					$model->cita_id = $lacita->id;
					$model->hora_inicio = $lacita->hora_inicio;
					$model->hora_fin = $lacita->hora_fin_mostrar;
					$model->fecha_inicio = $lacita->fecha_cita;
					$model->motivo = $_POST['CitasReservada']['motivo'];
					$model->observacion = $_POST['CitasReservada']['observacion'];
					$model->usuario_id = Yii::app()->user->usuarioId;
					$model->fecha_creado = date("Y-m-d H:i:s");
					$model->estado = "Activa";
					
					if ($model->save()) 
					{
						$lacitadetalle = new CitasReservadaDetalle;
						$lacitadetalle->cita_reservada_id = $model->id;
						$lacitadetalle->cita_id = $model->cita_id;
						$lacitadetalle->estado = 'Activa';
						$lacitadetalle->save();

						$this->redirect(array('view','id'=>$model->id));
					}
				}
				else
				{
					Yii::app()->user->setFlash('error',"Noooooooooo lo hizo");
					$this->render('create',array(
						'model'=>$model,
					));		
				}
			}

			if($_POST['opciones'] == "Dias")
			{
				//Determinar el numero de dias
				$datetime1 = date_create($_POST['CitasReservada']['fecha_inicio']);
				$datetime2 = date_create($_POST['CitasReservada']['fecha_fin']);
				$interval = date_diff($datetime1, $datetime2);
				$ndias = $interval->format('%a')  + 1;

					$model = new CitasReservada("dias");
					$model->scenario = 'dias';
					$model->personal_id = $_POST['CitasReservada']['personal_id'];
					$model->hora_inicio = 1;
					$model->hora_fin = 169;
					$model->fecha_inicio = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['CitasReservada']['fecha_inicio']);
					$model->fecha_fin = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['CitasReservada']['fecha_fin']);
					$model->motivo = $_POST['CitasReservada']['motivo'];
					$model->observacion = $_POST['CitasReservada']['observacion'];
					$model->usuario_id = Yii::app()->user->usuarioId;
					$model->fecha_creado = date("Y-m-d H:i:s");
					$model->estado = "Activa";
					if ($model->save()) 
					{
						$lafecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['CitasReservada']['fecha_inicio']);
						
						for ($i=0; $i < $ndias; $i++) 
						{ 
							$lacita = new Citas("otra");
							$lacita->fecha_cita 	= $lafecha;
							$lacita->hora_fin 		= 169;
							$lacita->hora_fin_mostrar = 169;
							$lacita->hora_inicio 	= 1;
							$lacita->linea_servicio_id = 26;
							$lacita->estado = "Reservado";
							$lacita->correo = "No";
							$lacita->comentario = "Bloqueo de agenda";
							$lacita->personal_id = $_POST['CitasReservada']['personal_id'];
							$lacita->fecha_creacion = date("Y-m-d");
							$lacita->fecha_hora_creacion = date("Y-m-d H:i:s");
							$lacita->usuario_id = Yii::app()->user->usuarioId;
							$lacita->save();

							$lafecha = strtotime ('+1 day', strtotime(date($lafecha)));
							$lafecha = date('Y-m-d', $lafecha); 
							
							//Guarda en Citas Reservada Detalle
							$lacitadetalle = new CitasReservadaDetalle;
							$lacitadetalle->cita_reservada_id = $model->id;
							$lacitadetalle->cita_id = $lacita->id;
							$lacitadetalle->estado = 'Activa';
							$lacitadetalle->save();
						}
						
						$this->redirect(array('view','id'=>$model->id));
					
					}

				

			}

			

			// if($model->save())
			//  	$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['CitasReservada']))
		{
			$model->attributes=$_POST['CitasReservada'];
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
		$dataProvider=new CActiveDataProvider('CitasReservada');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CitasReservada('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CitasReservada']))
			$model->attributes=$_GET['CitasReservada'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CitasReservada the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CitasReservada::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CitasReservada $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='citas-reservada-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
