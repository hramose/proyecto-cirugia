<?php

class InventarioPersonalController extends Controller
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
				'actions'=>array('admin','delete', 'actualizarInventario'),
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
		$model=new InventarioPersonal;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		//La migración
		// $todosProductos = ProductoInventario::model()->findAll("cantidad > 0");
		// foreach ($todosProductos as $todos_productos)
		// {
		// 	$productoDetalle = new ProductoInventarioDetalle;
		// 	$productoDetalle->producto_inventario_id = $todos_productos->id;
		// 	$productoDetalle->lote = "---";
		// 	$productoDetalle->cantidad_compra = $todos_productos->cantidad;
		// 	$productoDetalle->existencia = $todos_productos->cantidad;
		// 	$productoDetalle->save();
		// }


		if(isset($_POST['InventarioPersonal']))
		{
			$model->attributes=$_POST['InventarioPersonal'];
			$model->comentario = $_POST['InventarioPersonal']['comentario'];
			if($model->save())
			{
				//Los detalles de la Compra
				for ($i=0; $i <= $_POST['variable']; $i++) {
			 		if (isset($_POST['producto_'.$i])) 
			 		{
			 			$detalleC = new InventarioPersonalDetalle;
			 			$detalleC->inventario_personal_id = $model->personal_id;
			 			$detalleC->producto_id = $_POST['producto_'.$i];
			 			$detalleC->cantidad = $_POST['cantidad_'.$i];
			 			$detalleC->lote = $_POST['lote_'.$i];
			 			$detalleC->save();

			 			//Reducir inventario general
			 			$elProducto = ProductoInventario::model()->findByPk($_POST['id_producto_'.$i]);
			 			$elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
			 			$elProducto->save();

			 			//Reducir inventario por lote
			 			$elProducto = ProductoInventarioDetalle::model()->findByPk($_POST['producto_'.$i]);
			 			$elProducto->existencia = $elProducto->existencia - $_POST['cantidad_'.$i];
			 			$elProducto->save();
			 		}
			 		}

				$this->redirect(array('view','id'=>$model->personal_id));
				
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

	public function actionProducto()
	{
		$dataProvider=new CActiveDataProvider('InventarioPersonal');
		$this->layout = 'vacio';
		$this->render('producto',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionActualizarInventario()
	{
		$model= InventarioPersonal::model()->findByPk($_GET['id']);

		//Los detalles de la Compra
		for ($i=0; $i <= $_POST['variable']; $i++) {
	 		if (isset($_POST['producto_'.$i])) 
	 		{	
	 			$idProducto = $_POST['id_producto_'.$i];
	 			$loteProducto = $_POST['lote_'.$i];
	 			$existencias = InventarioPersonalDetalle::model()->find("inventario_personal_id = $model->personal_id and producto_id = $idProducto and lote = '".$loteProducto."'");
	 			if ($existencias) 
	 			{
	 				$existencias->cantidad = $existencias->cantidad + $_POST['cantidad_'.$i];
	 				$existencias->update();
	 			}
	 			else
	 			{
	 				$detalleC = new InventarioPersonalDetalle;
		 			$detalleC->inventario_personal_id = $model->personal_id;
		 			$detalleC->producto_id = $_POST['id_producto_'.$i];
		 			$detalleC->cantidad = $_POST['cantidad_'.$i];
		 			$detalleC->lote = $_POST['lote_'.$i];
		 			$detalleC->save();	
	 			}

	 			
	 			//Reducir inventario general
	 			$elProducto = ProductoInventario::model()->findByPk($_POST['id_producto_'.$i]);
	 			$elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
	 			$elProducto->save();


	 			//Reducir inventario por lote
	 			$elProducto = ProductoInventarioDetalle::model()->findByPk($_POST['producto_'.$i]);
	 			$elProducto->existencia = $elProducto->existencia - $_POST['cantidad_'.$i];
	 			$elProducto->save();
	 		}
	 		}
	 	$elComentario = date("d-m-Y H:m:s")."<br>-------------------------<br>".$_POST['InventarioPersonal']['comentario']."<br><br>";

	 	$model->comentario = $elComentario.$model->comentario;
	 	$model->save();

		$this->redirect(array('view','id'=>$model->personal_id));
		

	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InventarioPersonal']))
		{
			$model->attributes=$_POST['InventarioPersonal'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->personal_id));
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
		$dataProvider=new CActiveDataProvider('InventarioPersonal');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}



	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InventarioPersonal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InventarioPersonal']))
			$model->attributes=$_GET['InventarioPersonal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InventarioPersonal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InventarioPersonal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InventarioPersonal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventario-personal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
