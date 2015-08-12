<?php

class VentasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */

	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }


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
				'actions'=>array('create','update', 'imprimirVentas', 'exportar'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','producto', 'envioCorreoVenta'),
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


	public function actionExportar()
	{
		if ($_POST['filtro'] == 1) 
		{
			$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
			$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);
			
			$attribs = array('estado'=>'Activo');
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
			$criteria->addBetweenCondition('fecha', $laFechaDesde, $laFechaHasta);
			$rows = Ventas::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			$rows = Ventas::model()->findAll("estado = 'Activo'");
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::ID',
            'paciente.nombreCompleto::Paciente',
            'descripcion',
            'forma_pago',
            'sub_total',
            'total_iva',
            'descuento',
            'descuento_valor::Valor con Descuento',
            'descuento_total::Total de Descuento',
            'total_venta::Total de Venta',
            'personal0.nombreCompleto::Realizado por',
            'fecha::Fecha',
        ));
	}



	public function actionCreate()
	{
		$model=new Ventas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ventas']))
		{
			//Datos de Paciente
			$elPaciente = Paciente::model()->findByPk($_POST['elpaciente_id']);

			if ($_POST['Ventas']['credito_fecha'] == "") 
			{
				$fechaCredito = "0000-00-00";
			}
			else
			{
				$fechaCredito = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Ventas']['credito_fecha']);
			}

			$model->attributes=$_POST['Ventas'];
			$model->forma_pago = $_POST['Ventas']['forma_pago'];
			$model->descripcion = $_POST['Ventas']['descripcion'];
			$model->paciente_id = $_POST['elpaciente_id'];
			$model->n_identificacion = $elPaciente->n_identificacion;
			$model->credito_fecha = $fechaCredito;
			$model->fecha = date("Y-m-d");
			$model->fecha_hora = date("Y-m-d H:i:s");
			$model->estado = "Activo";
			$model->personal = Yii::app()->user->usuarioId;
			$model->vendedor_id = $_POST['Ventas']['vendedor_id'];
			if($model->save())
			{

				//Los detalles de la Compra
				for ($i=0; $i <= $_POST['variable']; $i++) {

			 		if (isset($_POST['producto_'.$i])) 
			 		{
			 			$detalleC = new VentasDetalle;
			 			$detalleC->venta_id = $model->id;
			 			$detalleC->producto_id = $_POST['producto_'.$i];
			 			$detalleC->cantidad = $_POST['cantidad_'.$i];
			 			$detalleC->valor = $_POST['valor_'.$i];
			 			$detalleC->iva = $_POST['iva_'.$i];
			 			$detalleC->total = $_POST['total_'.$i];
			 			$detalleC->paciente_id = $model->paciente_id;
			 			$detalleC->fecha = $model->fecha;
			 			$detalleC->save();

			 			//Aumentar inventario
			 			$elProducto = ProductoInventario::model()->findByPk($_POST['producto_'.$i]);
			 			$elProducto->cantidad = $elProducto->cantidad - $_POST['cantidad_'.$i];
			 			$elProducto->save();
			 		}			 		
			 	}



				if ($model->forma_pago == "Cheque") 
				{
					//Los detalles de la Compra
					for ($i=0; $i <= $_POST['variablec']; $i++) {

				 		if (isset($_POST['numero_'.$i])) 
				 		{
				 			$detalleC = new VentasCheques;
				 			$detalleC->ingresos_id = $model->id;
				 			$detalleC->numero = $_POST['numero_'.$i];
				 			$detalleC->entidad = $_POST['entidad_'.$i];
				 			$detalleC->valor = $_POST['valor_'.$i];
				 			$detalleC->f_cobro = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_cobro_'.$i]);
				 			$detalleC->save();
				 		}			 		
				 	}					
				}

				if ($model->forma_pago == "Efectivo")
				{
					//$this->actionEnvioCorreoVenta($model->id);
					$laCaja=CajaEfectivo::model()->findByPk($model->personal);
					if($laCaja===null)//no esta vacio
					{
						//Nueva Caja
						$nuevaCaja = new CajaEfectivo;
						$nuevaCaja->personal_id = $model->personal;
						$nuevaCaja->total = $model->total_venta;
						$nuevaCaja->save();

						//Registrar Ingreso en el detalle de caja
						$nuevaCajaDetalle = new CajaEfectivoDetalle;
						$nuevaCajaDetalle->caja_efectivo_id = $nuevaCaja->personal_id;
						$nuevaCajaDetalle->monto = $model->total_venta;
						$nuevaCajaDetalle->tipo = "Venta";
						$nuevaCajaDetalle->venta_id = $model->id;
						$nuevaCajaDetalle->fecha = date("Y-m-d H:i:s");
						$nuevaCajaDetalle->save();
					}
					else
					{
						//Actualizar Caja
						$laCaja->total = $laCaja->total + $model->total_venta;
						$laCaja->save();

						//Registrar Ingreso en el detalle de caja
						$nuevaCajaDetalle = new CajaEfectivoDetalle;
						$nuevaCajaDetalle->caja_efectivo_id = $model->personal;
						$nuevaCajaDetalle->monto = $model->total_venta;
						$nuevaCajaDetalle->tipo = "Venta";
						$nuevaCajaDetalle->venta_id = $model->id;
						$nuevaCajaDetalle->fecha = date("Y-m-d H:i:s");
						$nuevaCajaDetalle->save();
					}
				}

				//Render de Vista
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

		if(isset($_POST['Ventas']))
		{
			$model->attributes=$_POST['Ventas'];
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


	public function actionEnvioCorreoVenta($idIngreso)
	{
		$model=Ingresos::model()->findByPk($idIngreso);	

		$message = new YiiMailMessage;  
        $message->subject = 'Detalle de Venta: N° '.$model->id;
        /*$message->view ='prueba';//nombre de la vista q conformara el mail*/
        $message->setBody('<b>Venta número:</b>'.$model->id.'<br>
        				   <b>Fecha de Venta:</b>'.Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s",$model->fecha).'<br><br>
        				   <b>Doc. Paciente:</b><br>'.$model->paciente->n_identificacion.'<br>
        				   <b>Paciente:</b><br>'.$model->paciente->nombreCompleto.'<br>
        				   <b>Forma de Pago:</b><br>'.$model->forma_pago.'<br>
        				   <b>Valor:</b><br>'.$model->valor.'<br>
        				   <b>Centro de Costos:</b><br>'.$model->centroCosto->nombre.'<br>
        				   <b>Comentario:</b><br>'.$model->descripcion.'<br><br>
        				   <b>Usuario que Creo:</b><br>'.$model->personal->nombreCompleto.'<br><br>','text/html');//codificar el html de la vista
        $message->from =('no_responder@ilp.gob.sv'); // alias del q envia
        //recorrer a los miembros del equipo
        $message->setTo('josterricardo@gmail.com'); // a quien se le envia
        Yii::app()->mail->send($message);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ventas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionImprimirVentas()
	{
				$mPDF1 = Yii::app()->ePdf->HTML2PDF();
				$mPDF1->WriteHTML($this->renderPartial('ventas', array(), true));
        		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('ventas');
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new Ventas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ventas']))
		{
			$model->attributes=$_GET['Ventas'];
		}
		$this->layout='main';
		
		$lasVentas = Ventas::model()->count();
		if ($lasVentas == 0) {
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

	public function actionAdminProductos()
	{
		$model=new Ventas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ventas']))
			$model->attributes=$_GET['Ventas'];
		$this->layout='main';
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ventas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ventas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ventas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ventas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
