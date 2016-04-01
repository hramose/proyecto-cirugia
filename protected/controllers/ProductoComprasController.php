<?php

class ProductoComprasController extends Controller
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
				'actions'=>array('create','update', 'producto', 'retenciones', 'imprimirCompra', 'exportar'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'producto', 'productoReferencia', 'retenciones', 'cxp', 'cxpp', 'pago', 'exportarCompras', 'exportarCxp', 'anular'),
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
		$model=new ProductoCompras;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ProductoCompras']))
		{
			//Buscar Proveedor
			$elProveedor = ProductoProveedor::model()->findByPk($_POST['ProductoCompras']['producto_proveedor_id']);

			$model->attributes=$_POST['ProductoCompras'];
			$model->nit = $elProveedor->doc_nit;
			$model->fecha = date("Y-m-d H:i:s");
			$model->fecha_sola = date("Y-m-d");
			$model->estado = "Activo";
			if($_POST['ProductoCompras']['forma_pago'] == "Crédito")
			{
				$model->saldo = $_POST['ProductoCompras']['total_compra'];
			}
			$model->personal_id = Yii::app()->user->usuarioId;
			if($model->save())
			{
				//Los detalles de la Compra
				for ($i=0; $i <= $_POST['variable']; $i++) {

			 		if (isset($_POST['producto_'.$i])) 
			 		{
			 			$detalleC = new ProductoCompraDetalle;
			 			$detalleC->producto_compra_id = $model->id;
			 			$detalleC->producto_id = $_POST['producto_'.$i];
			 			$detalleC->cantidad = $_POST['cantidad_'.$i];
			 			$detalleC->lote = $_POST['lote_'.$i];
			 			if($_POST['vence_'.$i] == "")
			 			{
							$detalleC->fecha_vencimiento = "0000-00-00";
			 			}
			 			else
			 			{
			 				$detalleC->fecha_vencimiento = Yii::app()->dateformatter->format("yyyy-MM-dd", $_POST['vence_'.$i]);
			 			}
			 			$detalleC->valor = $_POST['valor_'.$i];
			 			$detalleC->iva = $_POST['iva_'.$i];
			 			$detalleC->total = $_POST['total_'.$i];
			 			$detalleC->save();

			 			//Aumentar inventario
			 			$elProducto = ProductoInventario::model()->findByPk($_POST['producto_'.$i]);
			 			$elProducto->cantidad = $elProducto->cantidad + $_POST['cantidad_'.$i];
			 			$elProducto->costo_iva = $_POST['valor_'.$i];
			 			if ($elProducto->save()) 
			 			{
			 				//Guardar detalle del inventario //Lotes
			 				$elProductoD = new ProductoInventarioDetalle;
			 				$elProductoD->producto_inventario_id = $_POST['producto_'.$i];
			 				$elProductoD->lote = $_POST['lote_'.$i];
			 				$elProductoD->cantidad_compra = $_POST['cantidad_'.$i];
			 				$elProductoD->existencia = $_POST['cantidad_'.$i];
			 				$elProductoD->compra_id = $model->id;
			 				$elProductoD->save();
			 			}
			 			
			 			

			 		}			 		
			 	}


				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->layout='main';
		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionAnular()
	{
		$laclave = Configuraciones::model()->findByPk(1);
		$id = $_GET['idCompra'];
		if ($_POST['clave'] == $laclave->super_usuario) //Es super usuario
			{
				$laCompra = ProductoCompras::model()->findByPk($id);
				$laCompra->comentario_anulado = $_POST['observaciones'];
				$laCompra->total_compra = $laCompra->total_compra * -1;
				$laCompra->estado = "Anulada";
				if ($laCompra->update()) 
				{

					$compraDetalle = ProductoCompraDetalle::model()->findAll("producto_compra_id = ".$laCompra->id);
					foreach ($compraDetalle as $compra_detalle) {
						$InventarioProducto = ProductoInventario::model()->findByPk($compra_detalle->producto_id);
						$InventarioProducto->cantidad = $InventarioProducto->cantidad - $compra_detalle->cantidad;
						$InventarioProducto->update();
					}

					Yii::app()->user->setFlash('success',"Se ha realizado con éxito la anulación");
					$this->redirect(array('view','id'=>$id));
				}
				
			}
			else
			{
				Yii::app()->user->setFlash('error',"Usted no esta autorizado para realizar esta anulación");
				$this->redirect(array('view','id'=>$id));
			}
	}

	public function actionPago()
	{
		$model=new PagosCxp;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['pago']))
		{
			//$model->attributes=$_POST['ProductoCompras'];
			$model->producto_compra_id = $_GET['idCompra'];
			$model->pago = $_POST['pago'];
			$model->comentario = $_POST['comentario'];
			$model->fecha = date("Y-m-d H:i:s");
			$model->personal_id = Yii::app()->user->usuarioId;

			if($model->save())
				$laCompra = ProductoCompras::model()->findByPk($model->producto_compra_id);
				//$laCompra->saldo = $_POST['resto'];
				$laCompra->saveAttributes(array('saldo'=>$_POST['resto']));
				$laCompra->save();
				//los estados???
				$this->redirect(array('view','id'=>$model->producto_compra_id));
		}

		$this->redirect(array('view','id'=>$_GET['idCompra']));
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

		if(isset($_POST['ProductoCompras']))
		{
			$model->attributes=$_POST['ProductoCompras'];
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
		$dataProvider=new CActiveDataProvider('ProductoCompras');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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
				$rows = ProductoCompras::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = ProductoCompras::model()->findAll();
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'productoProveedor.nombre::Proveedor',
	            'nit',
	            'factura_n',
	            'forma_pago',
	            'total_compra',
	            'fecha',
	            'personal.nombreCompleto',
	        ));
           }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new ProductoCompras('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['ProductoCompras']))
				$model->attributes=$_GET['ProductoCompras'];

			$this->render('admin',array(
				'model'=>$model,
			));
		}
	}

	public function actionProducto()
	{
		$dataProvider=new CActiveDataProvider('ProductoCompras');
		$this->layout = 'vacio';
		$this->render('producto',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionProductoReferencia()
	{
		$dataProvider=new CActiveDataProvider('ProductoCompras');
		$this->layout = 'vacio';
		$this->render('productoReferencia',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionRetenciones()
	{
		$dataProvider=new CActiveDataProvider('ProductoCompras');
		$this->layout = 'vacio';
		$this->render('retenciones',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionImprimirCompra()
	{
				$mPDF1 = Yii::app()->ePdf->HTML2PDF();
				$mPDF1->WriteHTML($this->renderPartial('compra', array(), true));
        		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('compra');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProductoCompras('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductoCompras']))
			$model->attributes=$_GET['ProductoCompras'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCxp()
	{
		$model=new ProductoCompras('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductoCompras']))
		{
			$model->attributes=$_GET['ProductoCompras'];
			$model->estado = "Activo";
		}

		$this->layout = 'main';

		$lasCompras = ProductoCompras::model()->count();

		if ($lasCompras == 0) {
			$this->render('vacio',array(
			'model'=>$model,
			));
		}
		else
		{
			$this->render('cxp',array(
			'model'=>$model,
			));	
		}
	}
	public function actionCxpp()
	{
		$model=new ProductoCompras('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductoCompras']))
			$model->attributes=$_GET['ProductoCompras'];
			$model->estado = "Pagada";

		$this->layout = 'main';
		$this->render('cxpp',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProductoCompras the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProductoCompras::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProductoCompras $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='producto-compras-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExportarCompras()
	{
		$lafecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$_GET['lafecha']);
		$elpersonal = $_GET['elpersonal'];
	    // Load data
	    $model = Citas::model()->findAll("fecha_cita='$lafecha' and personal_id = $elpersonal");
	 
	    // Export it
	    $this->toExcel($model,
	    	array(
            'paciente.nombreCompleto::Paciente',
            'paciente.celular::Celular',
            'personal.nombreCompleto::Personal',
            'lineaServicio.nombre::Linea de Servicio', // Note the custom header
            'fecha_cita',
            'horaInicio.hora::Hora de inicio',
            'horaFin.hora::Hora Fin',
            'comentario',
        ));
	}

	public function actionExportarCxp()
	{
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['clave'] == $clave->super_usuario) 
		{
		if ($_POST['filtro'] == 1) 
		{
			$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd H:i:s",$_POST['fecha_desde']);
			$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd H:i:s",$_POST['fecha_hasta']);

			$attribs = array('estado'=>'Activo');
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
			$criteria->addBetweenCondition('fecha', $laFechaDesde, $laFechaHasta);
			$rows = ProductoCompras::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			$rows = ProductoCompras::model()->findAll("estado = 'Activo'");
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::Orden N°',
            'productoProveedor.nombre::Proveedor',
            'factura_n::Factura', // Note the custom header
            'total_compra',
            'forma_pago',
            'credito_dias',
            'credito_fecha',
            'saldo',
            //array( 'name' => 'fecha', 'type' => 'datetime' ),
            'estado',
        ));
           }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new ProductoCompras('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['ProductoCompras']))
			{
				$model->attributes=$_GET['ProductoCompras'];
				$model->estado = "Activo";
			}

			$this->layout = 'main';

			$lasCompras = ProductoCompras::model()->count();

			if ($lasCompras == 0) {
				$this->render('vacio',array(
				'model'=>$model,
				));
			}
			else
			{
				$this->render('cxp',array(
				'model'=>$model,
				));	
			}
		}


	}

}
