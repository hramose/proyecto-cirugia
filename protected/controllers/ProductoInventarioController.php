<?php

class ProductoInventarioController extends Controller
{

	 public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }
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
				'actions'=>array('create','update', 'exportar'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
			if (Yii::app()->request->isAjaxRequest) 
	  {
	    $this->renderPartial('view', array(
	                                   'model'=>$this->loadModel($id),
	                                   'asDialog'=>!empty($_GET['asDialog']),
	                                 ),
	                          false,true);
	     Yii::app()->end();
	   }
	 else
	    $this->render('view', array(
	       'model'=>$this->loadModel($id),
	     ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ProductoInventario;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['ProductoInventario']))
		{
			$model->attributes=$_POST['ProductoInventario'];
			$model->personal_id = 1;
			$model->estado = "Activo";
			$model->fecha = date("Y-m-d H:i:s");
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

		if(isset($_POST['ProductoInventario']))
		{
			$model->attributes=$_POST['ProductoInventario'];
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
		$dataProvider=new CActiveDataProvider('ProductoInventario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionExportar()
	{
		if ($_POST['filtro'] == 1) 
		{
			$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd H:i:s",$_POST['fecha_desde']);
			$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd H:i:s",$_POST['fecha_hasta']);

			if ($_GET["tipo"] == 0) {
				$attribs = array('estado'=>'Activo');
			}
			
			if ($_GET["tipo"] == 1) {
				$attribs = array('estado'=>'Activo', 'tipo_inventario' => 'Productos');
			}
			
			if ($_GET["tipo"] == 2) {
				$attribs = array('estado'=>'Activo', 'tipo_inventario' => 'Insumos');
			}
			
			if ($_GET["tipo"] == 3) {
				$attribs = array('estado'=>'Activo', 'tipo_inventario' => 'Consumibles');
			}

			if ($_GET["tipo"] == 4) {
				$attribs = array('estado'=>'Inactivo');
			}

			
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
			$criteria->addBetweenCondition('fecha', $laFechaDesde, $laFechaHasta);
			$rows = ProductoInventario::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			if ($_GET["tipo"] == 0) {
				$rows = ProductoInventario::model()->findAll("estado = 'Activo'");
			}
			
			if ($_GET["tipo"] == 1) {
				$rows = ProductoInventario::model()->findAll("estado = 'Activo' and tipo_inventario = 'Productos'");
			}
			
			if ($_GET["tipo"] == 2) {
				$rows = ProductoInventario::model()->findAll("estado = 'Activo' and tipo_inventario = 'Insumos'");
			}
			
			if ($_GET["tipo"] == 3) {
				$rows = ProductoInventario::model()->findAll("estado = 'Activo' and tipo_inventario = 'Consumibles'");
			}

			if ($_GET["tipo"] == 4) {
				$rows = ProductoInventario::model()->findAll("estado = 'Inactivo'");
			}
			
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::ID',
            'producto_referencia::Referencia',
            'lote',
            'productoProveedor.nombre::Proveedor',
            'costo_iva',
            'precio_publico',
            'iva',
            'fecha_vencimiento',
            'productoPresentacion.presentacion',
            'productoUnidadMedida.medida',
            'cantidad::Existencia',
            'stock_minimo',
            'productoCategoria.categoria',
            'tipo_inventario',
            //array( 'name' => 'fecha', 'type' => 'datetime' ),
            'estado',
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$elfiltro = "";
		if(isset($_GET['tipo']))
		{
			$elfiltro = trim($_GET['tipo']);
		}

		//echo $elfiltro;			
			
		$model=new ProductoInventario('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductoInventario']))
			$model->attributes=$_GET['ProductoInventario'];

			switch($elfiltro)
			{
				case 1;
					$model->tipo_inventario = "Productos";
					$losProductos = ProductoInventario::model()->count("tipo_inventario = 'Productos'");
					break;
					
				case 2;
					$model->tipo_inventario = "Insumos";
					$losProductos = ProductoInventario::model()->count("tipo_inventario = 'Insumos'");
					break;

				case 3;
					$model->tipo_inventario = "Consumibles";
					$losProductos = ProductoInventario::model()->count("tipo_inventario = 'Consumibles'");
					break;

				case 4;
					$model->estado = "Inactivo";
					$losProductos = ProductoInventario::model()->count("estado = 'Inactivo'");
					break;
				
				default;
					$losProductos = ProductoInventario::model()->count();
					break;
			}

			
			if ($losProductos == 0) {
			$this->render('vacio',array(
			'model'=>$model,
			));
		}
		else
		{
			$this->render('admin',array(
			'model'=>$model,
			));	
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProductoInventario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProductoInventario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProductoInventario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='producto-inventario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
