<?php

class HistorialLaboratorioController extends Controller
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
				'actions'=>array('create','update', 'guardarLaboratorio', 'actualizarLaboratorio'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','laboratorio'),
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
		$model=new HistorialLaboratorio;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HistorialLaboratorio']))
		{
			$model->attributes=$_POST['HistorialLaboratorio'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionGuardarLaboratorio()
	{

		if (isset($_GET['idCita'])) {
				$idCita = $_GET['idCita'];
			}
			else
			{
				$idCita = null;
			}

		$model=new HistorialLaboratorio;		

			 $model->paciente_id = $_GET['idPaciente'];
			 $model->cita_id = $idCita;
			 $model->personal_id = Yii::app()->user->usuarioId;
			 $model->comentarios = $_POST['comentarios'];
			 $model->fecha = date("Y-m-d");
			
			 if($model->save())
			 {
			 	$eltotal = 0;
			 	for ($i=0; $i <= $_POST['variable']; $i++) {
			 		//$x = $i+1;
			 		//
			 		if (isset($_POST['laboratorio_'.$i])) 
			 		{
			 			$detalleP = new HistorialLaboratorioDetalle;
			 			$detalleP->historial_laboratorio_id = $model->id;
			 			$detalleP->laboratorio_id = $_POST['laboratorio_'.$i];
			 			$detalleP->examen = $_POST['examen_'.$i];
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


	public function actionActualizarLaboratorio()
	{
		$model= Contratos::model()->findByPk($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Presupuesto']))
		// {
			//$model->attributes=$_POST['Presupuesto'];
			

			 $model->fecha = date("Y-m-d");
			 $model->observaciones = $_POST['observaciones'];
			 $model->usuario_id = $_POST['vendedor'];

			
			 if($model->save())
			 {
			 	$detalleP = ContratoDetalle::model()->findAll("contrato_id = $model->id");
	 			foreach ($detalleP as $detalle_P) {
					$detalle_P->delete();					 		
	 			}

			 	$eltotal = 0;
			 	for ($i=0; $i <= $_POST['variable']; $i++) {
			 		//$x = $i+1;
			 		//
			 		if (isset($_POST['linea_'.$i])) 
			 		{
				 		
				 			$detalleP = new ContratoDetalle;
				 			$detalleP->presupuesto_id = $model->id;
				 			$detalleP->linea_servicio_id = $_POST['linea_'.$i];
				 			$detalleP->cantidad = $_POST['cantidad_'.$i];
				 			$detalleP->vu = $_POST['vu_'.$i];
				 			$detalleP->desc = $_POST['desc_'.$i];
				 			$detalleP->vu_desc = $_POST['vu_desc_'.$i];
				 			$detalleP->vt_sin_desc = $_POST['vt_sin_desc_'.$i];
				 			$detalleP->vt_con_desc = $_POST['vt_con_desc_'.$i];
				 			$detalleP->total = $_POST['total_'.$i];
				 			$eltotal = $eltotal + $_POST['total_'.$i];
				 			$detalleP->save();
				 		}
			 		}

			 		$paraTotal = Presupuesto::model()->findByPk($model->id);
			 		$paraTotal->total = $eltotal;
			 		$paraTotal->save();
			 		
			 	}
			 	$this->redirect(array('view','id'=>$model->id));
			 


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

		if(isset($_POST['HistorialLaboratorio']))
		{
			$model->attributes=$_POST['HistorialLaboratorio'];
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
		$dataProvider=new CActiveDataProvider('HistorialLaboratorio');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistorialLaboratorio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistorialLaboratorio']))
			$model->attributes=$_GET['HistorialLaboratorio'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HistorialLaboratorio the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HistorialLaboratorio::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionLaboratorio()
	{
			$mPDF1 = Yii::app()->ePdf->HTML2PDF();
			$mPDF1->WriteHTML($this->renderPartial('laboratorio', array(), true));
    		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('laboratorio');
	}

	/**
	 * Performs the AJAX validation.
	 * @param HistorialLaboratorio $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historial-laboratorio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
