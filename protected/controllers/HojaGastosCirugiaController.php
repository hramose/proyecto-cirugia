<?php

class HojaGastosCirugiaController extends Controller
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
				'actions'=>array('admin','delete','producto'),
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

	public function actionProducto()
	{
		$dataProvider=new CActiveDataProvider('Ventas');
		$this->layout = 'vacio';
		$this->render('producto',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{


		$model=new HojaGastosCirugia;
		$superTotal = 0;

		if (isset($_GET['idCita'])) {
				$idCita = $_GET['idCita'];
			}
			else
			{
				$idCita = null;
			}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojaGastosCirugia']))
		{
			$model->attributes=$_POST['HojaGastosCirugia'];
			$model->paciente_id = $_GET['idPaciente'];
			$model->cita_id = $idCita;
			$model->fecha_cirugia = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['HojaGastosCirugia']['fecha_cirugia']);
			$model->fecha = date("Y-m-d H:i:s");
			$model->personal_id = Yii::app()->user->usuarioId;

			if($model->save())
			{
				//Los detalles de la Compra
				for ($i=0; $i <= $_POST['variable']; $i++) {

			 		if (isset($_POST['producto_'.$i])) 
			 		{
			 			$datosCita = Citas::model()->findByPk($idCita);
			 			$detalleC = new HojaGastosCirugiaDetalle;
			 			$detalleC->hoja_gastos_cirugia_id = $model->id;
			 			$detalleC->producto_id = $_POST['elid_'.$i];
			 			$detalleC->cantidad = $_POST['cantidad_'.$i];
			 			$detalleC->save();

			 			//Agregar a relación de Hoja de gstos
			 			$elCosto = ProductoInventario::model()->findByPk($detalleC->producto_id);

			 			

			 			//Disminuir inventario
			 			//$elProducto = ProductoInventario::model()->findByPk($_POST['producto_'.$i]);
			 			$elProducto = InventarioPersonalDetalle::model()->find('id =' .$_POST['producto_'.$i]." and inventario_personal_id =".Yii::app()->user->usuarioId);
			 			$elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
			 			$elProducto->save();

			 			$elProductoDetalle = ProductoInventarioDetalle::model()->find('producto_inventario_id = ' .$elProducto->producto_id. ' and lote = "'.$_POST['lote_'.$i].'"');
			 			$elProductoDetalle->existencia = $elProductoDetalle->existencia - $_POST['cantidad_'.$i];
			 			if($elProductoDetalle->save())
			 			{
			 				$elProducto = ProductoInventario::model()->findByPk($elProductoDetalle->producto_inventario_id);
				 			$elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
				 			$elProducto->save();	
			 			}
			 			$superTotal = $superTotal + $elProducto->costo_iva;
			 		}
			 		
			 	}

			 	$relacion = new RelacionHojaGastos;
			 	$relacion->hoja_gastos_cirugia_id = $model->id;
	 			$relacion->paciente_id = $model->paciente_id;
	 			$relacion->n_identificacion = $datosCita->n_identificacion; 
	 			$relacion->hoja = "Hoja de Gastos Cirugia";
	 			$relacion->asistencial_id = $datosCita->personal_id;
	 			$relacion->cita_id = $datosCita->id;
	 			$relacion->linea_servicio_id = $datosCita->linea_servicio_id;
	 			$relacion->fecha = date("Y-m-d");
	 			$relacion->fecha_hora = date("Y-m-d H:i:s");
	 			$relacion->costo = $superTotal;
	 			$relacion->personal_id = Yii::app()->user->usuarioId;
	 			$relacion->save();

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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HojaGastosCirugia']))
		{
			$model->attributes=$_POST['HojaGastosCirugia'];
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
		$dataProvider=new CActiveDataProvider('HojaGastosCirugia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		// $invento = InventarioPersonalDetalle::model()->findAll();
		// foreach ($invento as $elInvento) 
		// {
		// 	if ($elInvento->lote == NULL) 
		// 	{
		// 		$actual = InventarioPersonalDetalle::model()->find("id = $elInvento->id");
		// 		$actual->lote = "---";
		// 		$actual->update();
		// 	}
		// }

		$model=new HojaGastosCirugia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HojaGastosCirugia']))
			$model->attributes=$_GET['HojaGastosCirugia'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return HojaGastosCirugia the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=HojaGastosCirugia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param HojaGastosCirugia $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hoja-gastos-cirugia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
