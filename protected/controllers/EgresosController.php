<?php

class EgresosController extends Controller
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
				'actions'=>array('index','view', 'consultaFacturas'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','consultaFacturas', 'saldoFactura', 'retenciones'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'consultaFacturas', 'envioCorreoEgresos', 'anular', 'imprimirEgresos', 'exportar'),
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
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['clave'] == $clave->super_usuario) 
		{	
			if ($_POST['filtro'] == 1) 
			{
				$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
				$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

				$attribs = array('estado'=>'Activo');
				$criteria = new CDbCriteria(array('order'=>'id DESC'));
				$criteria->addBetweenCondition('fecha_sola', $laFechaDesde, $laFechaHasta);
				$rows = Egresos::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = Egresos::model()->findAll("estado = 'Activo'");
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'proveedor.nombre',
	            'factura.factura_n',
	            'forma_pago',
	            'valor_egreso',
	            'iva_valor',
	            'total_egreso',
	            'centroCosto.nombre',
	            'personal.nombreCompleto',
	            'fecha_sola::Fecha',
	        ));
	     }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new Egresos('search');
			$model->unsetAttributes();  // clear any default values
			$this->layout='main';
			if(isset($_GET['Egresos']))
			{
				$model->attributes=$_GET['Egresos'];
			}

			$losEgresos = Egresos::model()->count();
			if ($losEgresos == 0) {
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
	}


	public function actionCreate()
	{
		$model=new Egresos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Egresos']))
		{
			//Buscar Proveedores
			$datosProveedor = ProductoProveedor::model()->findByPk($_POST['id_proveedor']);

			$model->attributes=$_POST['Egresos'];
			$model->observaciones = $_POST['Egresos']['observaciones'];
			$model->proveedor_id = $_POST['id_proveedor'];
			$model->n_identificacion = $datosProveedor->doc_nit;
			$model->aplica_factura = $_POST['Egresos']['aplica_factura'];
			$model->fecha = date("Y-m-d H:i:s");
			$model->fecha_sola = date("Y-m-d");
			$model->personal_id = Yii::app()->user->usuarioId;
			$model->estado = "Activo";
			if($model->save())
			{
				if ($model->forma_pago == "Efectivo") 
				{
					//Para envio de correos
					$this->actionEnvioCorreoEgresos($model->id);
					//Afectar Caja
					$datosCaja = CajaEfectivo::model()->findByPk(Yii::app()->user->usuarioId);
					$datosCaja->total = $datosCaja->total - $model->valor_egreso;
					$datosCaja->update();

					//Registrar Ingreso en el detalle de caja
					$nuevaCajaDetalle = new CajaEfectivoDetalle;
					$nuevaCajaDetalle->caja_efectivo_id = $datosCaja->personal_id;
					$nuevaCajaDetalle->monto = ($model->valor_egreso * -1);
					$nuevaCajaDetalle->tipo = "Egreso";
					$nuevaCajaDetalle->egreso_id = $model->id;
					$nuevaCajaDetalle->fecha = date("Y-m-d H:i:s");
					$nuevaCajaDetalle->save();

					if ($model->aplica_factura == "Si") {
						$laCompra = ProductoCompras::model()->findByPk($model->factura_id);
			 			$laCompra->saldo = $laCompra->saldo - $model->valor_egreso;
			 			$laCompra->save();
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Egresos']))
		{
			$model->attributes=$_POST['Egresos'];
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


	public function actionAnular()
	{
		$id = $_GET['id'];
		if ($_POST['clave'] == "super") //Es super usuario
		{
			//Proceso de anulación
			$elEgreso = Egresos::model()->findByPk($id);
			$egresoActual = $elEgreso->valor_egreso;
			$elEgreso->valor_egreso = $elEgreso->valor_egreso - ($elEgreso->valor_egreso * 2);
			$elEgreso->estado = "Anulado";

			if ($elEgreso->save()) 
			{
				//Actualizar Saldo de Compra
				if($elEgreso->factura_id != null)
				{
					$datoCompra = ProductoCompras::model()->findByPk($elEgreso->factura->id);
					$datoCompra->saldo = $datoCompra->saldo + $egresoActual;
					$datoCompra->save();	
				}
				
				//Actualizar caja si es efectivo
				if ($elEgreso->forma_pago == "Efectivo") 
				{
					$datoCaja = CajaEfectivo::model()->findByPk($elEgreso->personal_id);
					$datoCaja->total = $datoCaja->total + $egresoActual;
					$datoCaja->save();

					$datoCajaDetalle = CajaEfectivoDetalle::model()->find("egreso_id = $elEgreso->id");
					$datoCajaDetalle->tipo = "Egreso Anulado";
					$datoCajaDetalle->monto = ($datoCajaDetalle->monto * -1);
					$datoCajaDetalle->update();
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


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Egresos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionConsultaFacturas()
	{
		$dataProvider=new CActiveDataProvider('Egresos');
		$this->layout = 'vacio';
		$this->render('consultaFacturas',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionRetenciones()
	{
		$dataProvider=new CActiveDataProvider('Egresos');
		$this->layout = 'vacio';
		$this->render('retenciones',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionSaldoFactura()
	{
		$dataProvider=new CActiveDataProvider('Egresos');
		$this->layout = 'vacio';
		$this->render('saldoFactura',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionImprimirEgresos()
	{
				$mPDF1 = Yii::app()->ePdf->HTML2PDF();
				$mPDF1->WriteHTML($this->renderPartial('egresos', array(), true));
        		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('egresos');
	}

	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Egresos('search');
		$model->unsetAttributes();  // clear any default values
		$this->layout='main';
		if(isset($_GET['Egresos']))
		{
			$model->attributes=$_GET['Egresos'];
		}

		$losEgresos = Egresos::model()->count();
		if ($losEgresos == 0) {
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

	public function actionEnvioCorreoEgresos($idEgreso)
	{
		$model=Egresos::model()->findByPk($idEgreso);	

		Yii::import('ext.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		//$message = Yii::app()->Smtpmail;
        $message->subject = 'Detalle de Egreso: N° '.$model->id;
        /*$message->view ='prueba';//nombre de la vista q conformara el mail*/
        $message->setBody('<b>Egreso número:</b>'.$model->id.'<br>
        				   <b>Fecha Egreso:</b>'.Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s",$model->fecha).'<br><br>
        				   <b>Doc. Beneficiario:</b><br>'.$model->n_identificacion.'<br>
        				   <b>Beneficiario:</b><br>'.$model->proveedor->nombre.'<br>
        				   <b>Forma de Pago:</b><br>'.$model->forma_pago.'<br>
        				   <b>Valor: $ </b><br>'.$model->total_egreso.'<br>
        				   <b>Centro de Costos:</b><br>'.$model->centroCosto->nombre.'<br>
        				   <b>Comentario:</b><br>'.$model->observaciones.'<br><br>
        				   <b>Usuario que Creo:</b><br>'.$model->personal->nombreCompleto.'<br><br>','text/html');//codificar el html de la vista
        $message->from =('noresponder@smadiaclinic.com'); // alias del q envia
        //recorrer a los miembros del equipo
        $message->setTo(array('gerencia@smadiaclinic.com')); // a quien se le envia
        //$message->setTo('gerencia@smadiaclinic.com hramirez@myrs.com.co'); // a quien se le envia
        Yii::app()->mail->send($message);

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Egresos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Egresos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Egresos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='egresos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
