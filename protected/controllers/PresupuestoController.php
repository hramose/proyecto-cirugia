<?php

class PresupuestoController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','precio','guardarPresupuesto','actualizarPresupuesto'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'presupuesto', 'exportar'),
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
		$model=new Presupuesto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Presupuesto']))
		{
			$model->attributes=$_POST['Presupuesto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionExportar()
	{
		if ($_POST['filtro'] == 1) 
		{
			$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
			$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

			$attribs = array();
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
			$criteria->addBetweenCondition('fecha', $laFechaDesde, $laFechaHasta);
			$rows = Presupuesto::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			$rows = Presupuesto::model()->findAll();
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::ID',
            'paciente.nombreCompleto',
            'paciente.n_identificacion::Cedula',
            'estado',
            'fecha',
            'total',            
            'vendedor.nombreCompleto::Vendido Por',
        ));
	}

	public function actionGuardarPresupuesto()
	{
		$model=new Presupuesto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Presupuesto']))
		// {
			//$model->attributes=$_POST['Presupuesto'];
			

			 $model->paciente_id = $_GET['idPaciente'];
			 $model->estado = "Presupuestado";
			 $model->fecha = date("Y-m-d");
			 $model->vendedor_id = $_POST['vendedor_id'];
			 $model->observaciones = $_POST['observaciones'];
			 $model->usuario_id = Yii::app()->user->usuarioId;

			
			 if($model->save())
			 {
			 	$eltotal = 0;
			 	for ($i=0; $i <= $_POST['variable']; $i++) {
			 		//$x = $i+1;
			 		//
			 		if (isset($_POST['linea_'.$i])) 
			 		{
			 			$detalleP = new PresupuestoDetalle;
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

			 		$paraTotal = Presupuesto::model()->findByPk($model->id);
			 		$paraTotal->total = $eltotal;
			 		$paraTotal->save();
			 		
			 	}
			 	$this->redirect(array('view','id'=>$model->id));
			 }


		//}

		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
	}

	public function actionActualizarPresupuesto()
	{
		$model= Presupuesto::model()->findByPk($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Presupuesto']))
		// {
			//$model->attributes=$_POST['Presupuesto'];
			

			 $model->fecha = date("Y-m-d");
			 $model->observaciones = $_POST['observaciones'];
			 $model->vendedor_id = $_POST['vendedor_id'];
			 $model->usuario_id = Yii::app()->user->usuarioId;


			
			 if($model->save())
			 {
			 	$detalleP = PresupuestoDetalle::model()->findAll("presupuesto_id = $model->id");
	 			foreach ($detalleP as $detalle_P) {
					$detalle_P->delete();					 		
	 			}

			 	$eltotal = 0;
			 	for ($i=0; $i <= $_POST['variable']; $i++) {
			 		//$x = $i+1;
			 		//
			 		if (isset($_POST['linea_'.$i])) 
			 		{
				 		
				 			$detalleP = new PresupuestoDetalle;
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

		//$model = Presupuesto::model()->findByPk($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Presupuesto']))
		{
			$model->attributes=$_POST['Presupuesto'];
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

	public function actionPresupuesto()
	{
			$mPDF1 = Yii::app()->ePdf->HTML2PDF('P', '');
			$mPDF1->WriteHTML($this->renderPartial('presupuesto', array(), true));
    		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('presupuesto');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Presupuesto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Presupuesto('search');
		$model->unsetAttributes();  // clear any default values
		$this->layout='main';
		if(isset($_GET['Presupuesto']))
			$model->attributes=$_GET['Presupuesto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Presupuesto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Presupuesto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionPrecio()
	{
		$dataProvider=new CActiveDataProvider('Presupuesto');
		$this->layout = 'vacio';
		$this->render('precio',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param Presupuesto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='presupuesto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
