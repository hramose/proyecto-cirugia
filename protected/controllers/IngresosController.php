<?php

class IngresosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

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
				'actions'=>array('create','update','contratos', 'envioCorreoIngreso', 'anular', 'imprimirIngresos'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'exportar'),
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
		$model=new Ingresos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ingresos']))
		{
			$elPaciente = Paciente::model()->findByPk($_GET['idPaciente']);


			$model->attributes=$_POST['Ingresos'];
			$model->forma_pago = $_POST['Ingresos']['forma_pago'];
			$model->descripcion = $_POST['Ingresos']['descripcion'];
			$model->vendedor_id = $_POST['Ingresos']['vendedor_id'];
			$model->paciente_id = $_GET['idPaciente'];
			$model->cita_id = $_POST["cita_id"];
			$model->n_identificacion = $elPaciente->n_identificacion;
			$model->fecha = date("Y-m-d H:i:s");
			$model->fecha_sola = date("Y-m-d");
			$model->estado = "Activo";
			if ($_POST['Ingresos']['personal_seguimiento'] == "") {
				$model->personal_seguimiento = 26;
			}
			else
			{
				$model->personal_seguimiento = $_POST['Ingresos']['personal_seguimiento'];	
			}
			$model->personal_id = Yii::app()->user->usuarioId;
			if($model->save())
			{
				
				if ($model->contrato_id != NULL) 
				{
				//Actualizar Saldo a favor de contrato
					$los_contratos = Contratos::model()->findByPk($model->contrato_id);
					$tratamiento_condescuentoTodos = 0;
					$tratamiendo_sindescuentoTodos = 0;
					$tratamientosRealizadosTodos = ContratosTratamientoRealizados::model()->findAll("contrato_id = $los_contratos->id");
					
					foreach ($tratamientosRealizadosTodos as $tratamientos_realizadosTodos) 
					{
						$preciosTratamiento = ContratoDetalle::model()->find("contrato_id = $tratamientos_realizadosTodos->contrato_id and linea_servicio_id = $tratamientos_realizadosTodos->linea_servicio_id");
						$tratamiento_condescuentoTodos = $tratamiento_condescuentoTodos + $preciosTratamiento->vu_desc;
						$tratamiendo_sindescuentoTodos = $tratamiendo_sindescuentoTodos + $preciosTratamiento->vu;
					}


					//Saldo a favor
						if ($los_contratos->saldo == 0) 
						{
							if ($los_contratos->estado == "Liquidado") 
							{
								$saldo_favorTodos = 0;
							}
							else
							{
								$saldo_favorTodos = ($los_contratos->total - $model->saldo)-$tratamiento_condescuentoTodos;	
							}
							
						}
						else
						{
							if ($los_contratos->saldo == $los_contratos->total) 
							{
								if ($los_contratos->descuento == "Si") {
									$saldo_favorTodos = $tratamiento_condescuentoTodos *-1;
								}
								else
								{
									$saldo_favorTodos = $tratamiendo_sindescuentoTodos *-1;
								}
								
							}
							else
							{
								if ($los_contratos->descuento == "Si") {
									$saldo_favorTodos = ($los_contratos->total - $los_contratos->saldo)-$tratamiento_condescuentoTodos;
								}
								else
								{
									$saldo_favorTodos = ($los_contratos->total - $los_contratos->saldo)-$tratamiendo_sindescuentoTodos;
								}
								
							}
						}

						$los_contratos->saldo_favor = $saldo_favorTodos;
						$los_contratos->update();
				}

				//Fin de actualizar saldo a favor

				if ($model->contrato_id != NULL) 
				{
					$elContrato = Contratos::model()->findByPk($model->contrato_id);
					if (isset($_GET['tipo'])) {
						$elContrato->observaciones_liquidacion = $model->descripcion;
						$elContrato->estado = "Liquidado";
					}					
					$elContrato->saldo = $elContrato->saldo - $model->valor;
			 		$elContrato->save();
				

					//Actualizar cuenta por cobrar
					$lacuentaXC = CuentasXc::model()->find("paciente_id = $elPaciente->id");
					if ($lacuentaXC) 
					{
						//Verificar si saldo es menor que cero
						$nuevoSaldo = $lacuentaXC->saldo - $model->valor;
						if ($nuevoSaldo <= 0) 
							{$lacuentaXC->saldo = 0;}
						else
							{$lacuentaXC->saldo = $nuevoSaldo;}
						//$lacuentaXC->update();
						
						//Cuenta por cobrrar detalle
						//$cuentaXC_detalle = CuentasXcDetalle::model()->find("paciente_id = $elPaciente->id");
						$cuentaXC_detalle = CuentasXcDetalle::model()->find("contrato_id = $model->contrato_id");
						if ($cuentaXC_detalle) {
							$nuevoSaldoDetalle = $cuentaXC_detalle->saldo - $model->valor;
							if ($nuevoSaldoDetalle <= 0) 
								{$cuentaXC_detalle->saldo = 0;}
								//{$cuentaXC_detalle->saldo = $nuevoSaldoDetalle;}
							else
								{$cuentaXC_detalle->saldo = $nuevoSaldoDetalle;}
							$cuentaXC_detalle->update();

							$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $elPaciente->id");
							$total_detalles = 0;
							foreach ($sumadetalles as $suma_detalles) 
							{
								$total_detalles = $total_detalles + $suma_detalles->saldo;
							}

							$lacuentaXC->saldo = $total_detalles;
							$lacuentaXC->update();
						}
						
					}
				



					//Si saldo de contrato = 0
					 $saldoContrato = Contratos::model()->findByPk($model->contrato_id);
					 if ($saldoContrato) 
					 {
					 	if ($saldoContrato->saldo > 0) {
					 	//Actualizar pago a Asistenciales
						 	$pagoAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $model->contrato_id");
						 	if ($pagoAsistenciales) 
						 	{
						 			foreach ($pagoAsistenciales as $pago_asistenciales) 
						 			{
						 				$pago_asistenciales->saldo = $pago_asistenciales->saldo + $model->valor;
						 				$pago_asistenciales->update();
						 			}
						 	}
						 }
						 else
						 {
						 	if ($saldoContrato->saldo == 0 and $saldoContrato->estado = "Liquidado") 
						 	{
						 		$pagoAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $model->contrato_id");
							 	if ($pagoAsistenciales) 
							 	{
							 			foreach ($pagoAsistenciales as $pago_asistenciales) 
							 			{
							 				$pago_asistenciales->saldo = 0;
							 				$pago_asistenciales->update();
							 			}
							 	}
						 	}
						 	else
						 	{
							 	//Actualizar pago a Asistenciales
							 	$sumaIngresos = 0;
							 	$total_vu_descuento_suma = 0;
							 	$detalleIngresos = Ingresos::model()->findAll("contrato_id = $model->contrato_id and estado = 'Activo'");
								foreach ($detalleIngresos as $detalle_ingreso) 
								{
									$sumaIngresos = $sumaIngresos + $detalle_ingreso->valor;
								}

								//Detalle de contratos
								$datosContratoDetalle = ContratoDetalle::model()->findAll("contrato_id = $model->contrato_id");
								foreach ($datosContratoDetalle as $datos_Contrato_Detalle) 
								{
										$total_vu_descuento_suma = $total_vu_descuento_suma + ($datos_Contrato_Detalle->vu_desc * $datos_Contrato_Detalle->realizadas);

								}

							 	$pagoAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $model->contrato_id");
							 	if ($pagoAsistenciales) 
							 	{
							 			foreach ($pagoAsistenciales as $pago_asistenciales) 
							 			{
							 				$pago_asistenciales->saldo = $sumaIngresos - $total_vu_descuento_suma;
							 				$pago_asistenciales->update();
							 			}
							 	}
							 }
						 }
					 }
				 }

				 //Verificar si es liquidacion de procedimiento sin contrato
				 if ($model->cita_id != NULL) 
				 {
				 	$lacuentaXC = CuentasXc::model()->find("paciente_id = $elPaciente->id");
					if ($lacuentaXC) 
					{
						//Verificar si saldo es menor que cero
						$nuevoSaldo = $lacuentaXC->saldo - $model->valor;
						if ($nuevoSaldo <= 0) 
							{$lacuentaXC->saldo = 0;}
						else
							{$lacuentaXC->saldo = $nuevoSaldo;}
						//$lacuentaXC->update();
						
						//Cuenta por cobrrar detalle
						$cuentaXC_detalle = CuentasXcDetalle::model()->find("cita_id = $model->cita_id");
						$nuevoSaldoDetalle = $cuentaXC_detalle->saldo - $model->valor;
						if ($nuevoSaldoDetalle <= 0) 
							{$cuentaXC_detalle->saldo = 0;}
							//{$cuentaXC_detalle->saldo = $nuevoSaldoDetalle;}
						else
							{$cuentaXC_detalle->saldo = $nuevoSaldoDetalle;}
						$cuentaXC_detalle->update();

						$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $elPaciente->id");
						$total_detalles = 0;
						foreach ($sumadetalles as $suma_detalles) 
						{
							$total_detalles = $total_detalles + $suma_detalles->saldo;
						}

						$lacuentaXC->saldo = $total_detalles;
						$lacuentaXC->update();
					}

					$pagoAsistenciales = PagoCosmetologas::model()->findAll("cita_id = $model->cita_id");
				 	if ($pagoAsistenciales) 
				 	{
				 			foreach ($pagoAsistenciales as $pago_asistenciales) 
				 			{
				 				$pago_asistenciales->saldo = 0;
				 				$pago_asistenciales->update();
				 			}
				 	}
				 }


				if ($model->forma_pago == "Cheque") 
				{
					//Los detalles de la Compra
					for ($i=0; $i <= $_POST['variable']; $i++) {

				 		if (isset($_POST['numero_'.$i])) 
				 		{
				 			$detalleC = new IngresosCheques;
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
					
					$laCaja=CajaEfectivo::model()->findByPk($model->personal_id);
					if($laCaja===null)//no esta vacio
					{
						//Nueva Caja
						$nuevaCaja = new CajaEfectivo;
						$nuevaCaja->personal_id = $model->personal_id;
						$nuevaCaja->total = $model->valor;
						$nuevaCaja->save();

						//Registrar Ingreso en el detalle de caja
						$nuevaCajaDetalle = new CajaEfectivoDetalle;
						$nuevaCajaDetalle->caja_efectivo_id = $nuevaCaja->personal_id;
						$nuevaCajaDetalle->monto = $model->valor;
						$nuevaCajaDetalle->tipo = "Ingreso";
						$nuevaCajaDetalle->ingreso_id = $model->id;
						$nuevaCajaDetalle->fecha = date("Y-m-d HH:ii:ss");
						$nuevaCajaDetalle->save();
					}
					else
					{
						//Actualizar Caja
						$laCaja->total = $laCaja->total + $model->valor;
						$laCaja->save();

						//Registrar Ingreso en el detalle de caja
						$nuevaCajaDetalle = new CajaEfectivoDetalle;
						$nuevaCajaDetalle->caja_efectivo_id = $model->personal_id;
						$nuevaCajaDetalle->monto = $model->valor;
						$nuevaCajaDetalle->tipo = "Ingreso";
						$nuevaCajaDetalle->ingreso_id = $model->id;
						$nuevaCajaDetalle->fecha = date("Y-m-d H:i:s");
						$nuevaCajaDetalle->save();
					}
				}

					//Para envio de correos
				$this->actionEnvioCorreoIngreso($model->id);

					if ($model->contrato_id != NULL) 
					{
			 			$this->redirect(array('view','id'=>$model->id));
		 			}
		 			else
		 			{
		 				$this->redirect(array('view','id'=>$model->id));	
		 			}
		 			//$this->actionImprimirIngresos($model->id);
				
				
				
				
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

		if(isset($_POST['Ingresos']))
		{
			$model->attributes=$_POST['Ingresos'];
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


	public function actionExportar()
	{
		if ($_POST['filtro'] == 1) 
		{
			$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
			$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

			$attribs = array('estado'=>'Activo');
			$criteria = new CDbCriteria(array('order'=>'id DESC'));
			$criteria->addBetweenCondition('fecha_sola', $laFechaDesde, $laFechaHasta);
			$rows = Ingresos::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			$rows = Ingresos::model()->findAll("estado = 'Activo'");
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::ID',
            'paciente.nombreCompleto',
            'n_identificacion::Cedula',
            'valor::Valor del Ingreso',
            'descripcion',
            'centroCosto.nombre',
            'forma_pago',
            'tarjeta_aprobacion',
            'personal.nombreCompleto::Ingresado Por',
            'contrato_id',
            'fecha_sola::Fecha',
            'vendedor.nombreCompleto::Vendedor',
            'estado',
        ));
	}


	public function actionContratos()
	{
		$dataProvider=new CActiveDataProvider('Ingresos');
		$this->layout = 'vacio';
		$this->render('contratos',array(
			//'dataProvider'=>$dataProvider,
		));
	}


	public function actionAnular()
	{
		$id = $_GET['id'];
		if ($_POST['clave'] == "super") //Es super usuario
			{
				//Proceso de anulación
				$elIngreso = Ingresos::model()->findByPk($id);
				$ingresoActual = $elIngreso->valor;
				$elIngreso->valor = $elIngreso->valor - ($elIngreso->valor * 2);
				$elIngreso->estado = "Anulado";
				$elIngreso->observacion_anular = $_POST['observacion_anular'];
				if ($elIngreso->save()) 
				{
					if ($elIngreso->contrato_id != NULL)
					{
						//Actualizar Saldo de contrato
						$datoContrato = Contratos::model()->findByPk($elIngreso->contrato_id);
						$datoContrato->saldo = $datoContrato->saldo + $ingresoActual;
						$datoContrato->save();
					}

					//Actualizar caja si es efectivo
					if ($elIngreso->forma_pago == "Efectivo")
					{
						$datoCaja = CajaEfectivo::model()->findByPk($elIngreso->personal_id);
						$datoCaja->total = $datoCaja->total - $ingresoActual;
						$datoCaja->save();

						$datoCajaDetalle = CajaEfectivoDetalle::model()->find("ingreso_id = $elIngreso->id");
						$datoCajaDetalle->tipo = "Ingreso Anulado";
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
		$dataProvider=new CActiveDataProvider('Ingresos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ingresos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ingresos']))
		{
			$model->attributes=$_GET['Ingresos'];
		}

		$losIngresos = Ingresos::model()->count();
		if ($losIngresos == 0) {
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
	 * @return Ingresos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ingresos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	public function actionEnvioCorreoIngreso($idIngreso)
	{
		$model=Ingresos::model()->findByPk($idIngreso);	

		Yii::import('ext.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		//$message = Yii::app()->Smtpmail;
        $message->subject = 'Detalle de Ingreso: N° '.$model->id;
        /*$message->view ='prueba';//nombre de la vista q conformara el mail*/
        $message->setBody('<b>Ingreso número:</b>'.$model->id.'<br>
        				   <b>Fecha Ingreso:</b>'.Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s",$model->fecha).'<br><br>
        				   <b>Doc. Paciente:</b><br>'.$model->paciente->n_identificacion.'<br>
        				   <b>Paciente:</b><br>'.$model->paciente->nombreCompleto.'<br>
        				   <b>Forma de Pago:</b><br>'.$model->forma_pago.'<br>
        				   <b>Valor: $ </b><br>'.$model->valor.'<br>
        				   <b>Centro de Costos:</b><br>'.$model->centroCosto->nombre.'<br>
        				   <b>Comentario:</b><br>'.$model->descripcion.'<br><br>
        				   <b>Vendedor:</b><br>'.$model->vendedor->nombreCompleto.'<br><br>
        				   <b>Usuario que Creo:</b><br>'.$model->personal->nombreCompleto.'<br><br>','text/html');//codificar el html de la vista
        $message->from =('noresponder@smadiaclinic.com'); // alias del q envia
        //recorrer a los miembros del equipo
        $message->setTo(array('gerencia@smadiaclinic.com')); // a quien se le envia
        //$message->setTo('gerencia@smadiaclinic.com hramirez@myrs.com.co'); // a quien se le envia
        Yii::app()->mail->send($message);






		// Yii::import('ext.yii-mail.YiiMailMessage');
		//  $message = new YiiMailMessage;
		//  $message->setBody('Message content here with HTML', 'text');
		//  $message->subject = 'My Subject';
		//  $message->addTo('j.ricardo@ilp.gob.sv');
		//  $message->from = Yii::app()->params['adminEmail'];
		//  Yii::app()->mail->send($message);
	}

	public function actionImprimirIngresos()
	{
				$mPDF1 = Yii::app()->ePdf->HTML2PDF();
				$mPDF1->WriteHTML($this->renderPartial('ingresos', array(), true));
        		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('ingresos');
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ingresos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ingresos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
