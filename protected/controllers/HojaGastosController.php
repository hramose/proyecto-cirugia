<?php

class HojaGastosController extends Controller
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
				'actions'=>array('create','update', 'producto'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'hoja'),
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
		$model=new HojaGastos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojaGastos']))
		{
			$datosCita = Citas::model()->findByPk($_GET['idCita']);
			$model->attributes=$_POST['HojaGastos'];
			$model->cita_id = $datosCita->id;
			$model->paciente_id = $datosCita->paciente_id;
			$model->observaciones = $_POST['HojaGastos']['observaciones'];
			$model->fecha = date("Y-m-d H:i:s");
			$model->personal_id = Yii::app()->user->usuarioId;
			if($model->save())
				//Los detalles de la Hoja de Gastos
				for ($i=0; $i <= $_POST['variable']; $i++) 
				{
			 		if (isset($_POST['producto_'.$i])) 
			 		{
			 			$detalleC = new HojaGastosDetalle;
			 			$detalleC->hoja_gastos_id = $model->id;
			 			$detalleC->producto_id = $_POST['producto_'.$i];
			 			$detalleC->cantidad = $_POST['cantidad_'.$i];
			 			$detalleC->save();

			 			//Agregar a relación de Hoja de gstos
			 			$elCosto = ProductoInventario::model()->findByPk($_POST['producto_'.$i]);

			 			$relacion = new RelacionHojaGastos;
			 			$relacion->paciente_id = $model->paciente_id;
			 			$relacion->n_identificacion = $datosCita->n_identificacion; 
			 			$relacion->hoja = "Hoja de Gastos";
			 			$relacion->asistencial_id = $datosCita->personal_id;
			 			$relacion->cita_id = $datosCita->id;
			 			$relacion->linea_servicio_id = $datosCita->linea_servicio_id;
			 			$relacion->fecha = date("Y-m-d");
			 			$relacion->fecha_hora = date("Y-m-d H:i:s");
			 			$relacion->costo = $elCosto->costo_iva;
			 			$relacion->personal_id = Yii::app()->user->usuarioId;
			 			$relacion->save();

			 			//Reducir inventario
			 			// $elProducto = ProductoInventario::model()->findByPk($_POST['producto_'.$i]);
			 			// $elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
			 			// $elProducto->save();

			 			$elProducto = InventarioPersonalDetalle::model()->find('producto_id =' .$_POST['producto_'.$i]." and inventario_personal_id =".Yii::app()->user->usuarioId);
			 			$elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
			 			$elProducto->save();
			 		}			 		
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

		if(isset($_POST['HojaGastos']))
		{
			$model->attributes=$_POST['HojaGastos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionHoja()
	{
			$mPDF1 = Yii::app()->ePdf->HTML2PDF();
			$mPDF1->WriteHTML($this->renderPartial('hoja', array(), true));
    		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('hoja');
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
		$dataProvider=new CActiveDataProvider('HojaGastos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

		public function actionProducto()
	{
		$dataProvider=new CActiveDataProvider('HojaGastos');
		$this->layout = 'vacio';
		$this->render('producto',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HojaGastos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HojaGastos']))
			$model->attributes=$_GET['HojaGastos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HojaGastos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HojaGastos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HojaGastos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hoja-gastos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
