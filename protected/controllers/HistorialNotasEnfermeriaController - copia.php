<?php

class HistorialNotasEnfermeriaController extends Controller
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
				'actions'=>array('admin','delete', 'notas'),
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
		$model=new HistorialNotasEnfermeria;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HistorialNotasEnfermeria']))
		{
			$model->attributes=$_POST['HistorialNotasEnfermeria'];
			$model->paciente_id = $_GET['idPaciente'];
			$model->cita_id = $_GET['idCita'];
			$model->observaciones = $_POST['HistorialNotasEnfermeria']['observaciones'];
			$model->fecha = date("Y-m-d H:i:s");
			$model->personal_id = Yii::app()->user->usuarioId;

			if($model->save())
			{
				//Los detalles de la Compra
				for ($i=0; $i <= $_POST['variable']; $i++) {

			 		if (isset($_POST['nota_'.$i])) 
			 		{
			 			$detalleC = new HistorialNotasEnfermeriaDetalles;
			 			$detalleC->historial_notas_enfermeria_id = $model->id;
			 			$detalleC->fecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_'.$i]);
			 			$detalleC->hora = $_POST['hora_'.$i];
			 			$detalleC->nota = $_POST['nota_'.$i];
			 			$detalleC->save();

			 		}			 		
			 	}
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$model= HistorialNotasEnfermeria::model()->findByPk($_GET['id']);
		if(isset($_POST['HistorialNotasEnfermeria']))
		{
		$model= HistorialNotasEnfermeria::model()->findByPk($_GET['id']);
		$model->observaciones = $_POST['HistorialNotasEnfermeria']['observaciones'];

		if($model->save())
			{
				$detalleP = HistorialNotasEnfermeriaDetalles::model()->findAll("historial_notas_enfermeria_id = $model->id");
	 			foreach ($detalleP as $detalle_P) {
					$detalle_P->delete();					 		
	 			}
				//Los detalles de la Compra
				for ($i=0; $i <= $_POST['variable']; $i++) {

			 		if (isset($_POST['nota_'.$i])) 
			 		{
			 			$detalleC = new HistorialNotasEnfermeriaDetalles;
			 			$detalleC->historial_notas_enfermeria_id = $model->id;
			 			$detalleC->fecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_'.$i]);
			 			$detalleC->hora = $_POST['hora_'.$i];
			 			$detalleC->nota = $_POST['nota_'.$i];
			 			$detalleC->save();

			 		}			 		
			 	}
				$this->redirect(array('view','id'=>$model->id));
			}
		}




		// $model=$this->loadModel($id);

		// // Uncomment the following line if AJAX validation is needed
		// // $this->performAjaxValidation($model);

		// if(isset($_POST['HistorialNotasEnfermeria']))
		// {
		// 	$model->attributes=$_POST['HistorialNotasEnfermeria'];
		// 	if($model->save())
		// 		$this->redirect(array('view','id'=>$model->id));
		// }

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
		$dataProvider=new CActiveDataProvider('HistorialNotasEnfermeria');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionNotas()
	{
			$mPDF1 = Yii::app()->ePdf->HTML2PDF();
			$mPDF1->WriteHTML($this->renderPartial('notas', array(), true));
    		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('notas');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistorialNotasEnfermeria('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistorialNotasEnfermeria']))
			$model->attributes=$_GET['HistorialNotasEnfermeria'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HistorialNotasEnfermeria the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HistorialNotasEnfermeria::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HistorialNotasEnfermeria $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historial-notas-enfermeria-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
