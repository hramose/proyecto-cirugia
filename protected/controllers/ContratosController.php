<?php

class ContratosController extends Controller
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
				'actions'=>array('create','update', 'guardarContratos', 'aprobarContratos', 'precio','guardarPresupueston', 'actualizarContrato', 'imprimirIngresos'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'contratos', 'vincular', 'cxc', 'completar', 'notaCredito', 'liquidar', 'actualizarContratoLiquidar', 'anular', 'exportar', 'vincularNota', 'ingresoContrato'),
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

	public function actionIngresoContrato($idContrato)
	{
		$elContrato = Contratos::model()->findByPk($idContrato);
		$elContrato->saldo = $elContrato->saldo - $_POST['valor'];
		if ($elContrato->update()) 
		{
			$elPaciente = Paciente::model()->findByPk($elContrato->paciente_id);
			$elPaciente->saldo = $elPaciente->saldo - $_POST['valor'];
			$elPaciente->update();
			
			$losMovimientos = new PacienteMovimientos;
			$losMovimientos->paciente_id = $elContrato->paciente_id;
			$losMovimientos->valor = $_POST['valor'];
			$losMovimientos->tipo = "Egreso";
			$losMovimientos->sub_tipo = "Ingreso a Contrato";
			$losMovimientos->descripcion = "Ingreso a Contrato usando Caja Personal";
			$losMovimientos->contrato_id = $elContrato->id;
			$losMovimientos->usuario_id = Yii::app()->user->usuarioId;
			$losMovimientos->fecha = date("Y-m-d H:i:s");
			$losMovimientos->save();

			Yii::app()->user->setFlash('success',"Se ha realizado con éxito el ingreso");
			$this->redirect(array('view','id'=>$elContrato->id));

		}
		//Ingreso a contrato de caja de paciente

	}

	

	public function actionAnular($id)
	{
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['clave'] == $clave->super_usuario) //Es super usuario
		{
			$datosContrato = Contratos::model()->findByPk($id);
			$datosContrato->estado = "Anulado";
			$datosContrato->observacion_anular = $_POST['observacion_anular'];
			if ($datosContrato->update()) 
			{
				$this->redirect(array('view','id'=>$datosContrato->id));
			}
		}
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Contratos;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Contratos']))
		{
			// $model->attributes=$_POST['Contratos'];
			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	
	public function actionCxc()
	{
		$model=new Contratos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contratos']))
		{
			$model->attributes=$_GET['Contratos'];
			$model->estado = "Activo";
		}

		$this->layout='main';

		$lasCuentas = Contratos::model()->count();
		if ($lasCuentas == 0) {
			$this->render('vacio',array(
			'model'=>$model,
			));
		}
		else
		{
			$this->render('cxc',array(
			'model'=>$model,
			));	
		}
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
				$criteria->addBetweenCondition('fecha', $laFechaDesde, $laFechaHasta);
				$rows = Contratos::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = Contratos::model()->findAll();
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'paciente.nombreCompleto',
	            'n_identificacion::Cedula',
	            'estado',
	            'fecha_sola',
	            'total',
	            'saldo',
	            'usuario.nombreCompleto::Elaborado Por',
	            'vendedor.nombreCompleto::Vendido Por',
	        ));
	    }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new Contratos('search');
			$this->layout='main';
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Contratos']))
				$model->attributes=$_GET['Contratos'];

			$this->render('admin',array(
				'model'=>$model,
			));
		}
	}

	public function actionCompletar()
	{
		$idContrato = $_GET['idContrato'];
		$elContrato = Contratos::model()->findByPk($idContrato);
		$elContrato->estado = "Completado";
		$elContrato->usuario_completo = Yii::app()->user->usuarioId;
		$elContrato->fecha_completo = date("Y-m-d H:i:s");
		if($elContrato->update())
		{
			Yii::app()->user->setFlash('success',"Se ha completado el contrato.");
			$this->redirect(array('view','id'=>$elContrato->id));
		}
	}

	public function actionLiquidar()
	{
		$idContrato = $_GET['id'];
		$datosContrato = Contratos::model()->findByPk($idContrato);
		$datosContrato->comentario_liquidado = $_POST['Contratos']['comentario_liquidado'];

		if ($datosContrato->comentario_liquidado == "") 
		{
			Yii::app()->user->setFlash('error',"No se liquido el contrato. No se coloco comentario de liquidación.");
			$this->redirect(array('view','id'=>$datosContrato->id));
		}

		//Detalle de contrato
		$total_tratamiento = 0;
		$total_tratamientos_realizados = 0;
		$total_vu = 0;
		$total_vu_descuento = 0;
		$total_vu_suma = 0;
		$total_vu_descuento_suma = 0;
		$sumaIngresos = 0;
		$total_cxc = 0;
		$total_nota_credito = 0;
		$saldo_favor = 0;
		$tipo_accion = "";
		$tratamiendo_sindescuento = 0;
		$tratamiento_condescuento = 0;

		//Saldo a Favor*****************
		$tratamientosRealizados = ContratosTratamientoRealizados::model()->findAll("contrato_id = $datosContrato->id");
		if ($tratamientosRealizados) 
		{
			foreach ($tratamientosRealizados as $tratamientos_realizados) 
			{
				$preciosTratamiento = ContratoDetalle::model()->find("contrato_id = $tratamientos_realizados->contrato_id and linea_servicio_id = $tratamientos_realizados->linea_servicio_id");
				$tratamiendo_sindescuento = $tratamiendo_sindescuento + $preciosTratamiento->vu;
				$tratamiento_condescuento = $tratamiento_condescuento + $preciosTratamiento->vu_desc;
			}
		}

		if ($datosContrato->saldo == $datosContrato->total) 
		{
			if ($datosContrato->descuento == "Si") {
				$saldo_favor = $tratamiento_condescuento *-1;
			}
			else
			{
				$saldo_favor = $tratamiendo_sindescuento *-1;
			}
			
		}
		else
		{
			if ($datosContrato->descuento == "Si") {
				$saldo_favor = ($datosContrato->total - $datosContrato->saldo)-$tratamiento_condescuento;
			}
			else
			{
				$saldo_favor = ($datosContrato->total - $datosContrato->saldo)-$tratamiendo_sindescuento;
			}
			
		}

		//$saldo_favor = ($datosContrato->total - $datosContrato->saldo)-$tratamiento_condescuento;	

		//Suma de ingresos
		$detalleIngresos = Ingresos::model()->findAll("contrato_id = $idContrato and estado = 'Activo'");
		if ($detalleIngresos) 
		{
			foreach ($detalleIngresos as $detalle_ingreso) 
			{
				$sumaIngresos = $sumaIngresos + $detalle_ingreso->valor;
			}
		}
		

		$datosContratoDetalle = ContratoDetalle::model()->findAll("contrato_id = $idContrato");
		foreach ($datosContratoDetalle as $datos_Contrato_Detalle) 
		{
			$total_tratamiento = $total_tratamiento + $datos_Contrato_Detalle->cantidad;
			$total_tratamientos_realizados = $total_tratamientos_realizados + $datos_Contrato_Detalle->realizadas;
			$total_vu = $total_vu + $datos_Contrato_Detalle->vu;
			$total_vu_descuento = $total_vu_descuento + $datos_Contrato_Detalle->vu_desc;
			$total_vu_suma = $total_vu_suma + ($datos_Contrato_Detalle->vu * $datos_Contrato_Detalle->realizadas);
			$total_vu_descuento_suma = $total_vu_descuento_suma + ($datos_Contrato_Detalle->vu_desc * $datos_Contrato_Detalle->realizadas);

		}

		//$saldo_favor = $total_vu_suma;
		//se esta liquidando un contrato inclumplido = Valores sin descuento

		if ($datosContrato->saldo == 0) 
		{
			//$saldo_favor = $sumaIngresos - $total_vu_descuento;
			$saldo_favor = $sumaIngresos - $total_vu_suma;
		}

		if ($total_tratamientos_realizados <= $total_tratamiento) 
		{
			$saldo_favor = $sumaIngresos - $total_vu_suma;
		}

		
		//---->>>***** Aca es donde se depositara a la caja personal
		if ($saldo_favor > 0) //Es nota de crédito
		{
			//Ingreso a caja Personal
			$PacienteCaja = Paciente::model()->findByPk($datosContrato->paciente_id);
			$PacienteCaja->saldo = $PacienteCaja->saldo + $saldo_favor;
			if ($PacienteCaja->update()) 
			{
				$movimientosCaja = new PacienteMovimientos;
				$movimientosCaja->paciente_id = $PacienteCaja->id;
				$movimientosCaja->valor = $PacienteCaja->saldo;
				$movimientosCaja->tipo = "Ingreso";
				$movimientosCaja->sub_tipo = "Nota de Crédito";
				$movimientosCaja->contrato_id = $datosContrato->id;
				$movimientosCaja->descripcion = "Ingreso a caja de paciente con nota de crédito por liquidación de contrato N°. ".$datosContrato->id;
				$movimientosCaja->usuario_id = Yii::app()->user->usuarioId;
				$movimientosCaja->fecha = date("Y-m-d H:i:s");
				//$movimientosCaja->save();

				if($movimientosCaja->save())
				{
					$notadeCredito = new NotaCredito;
					$notadeCredito->paciente_id = $datosContrato->paciente_id;
					$notadeCredito->n_identificacion = $datosContrato->n_identificacion;
					$notadeCredito->contrato_id = $datosContrato->id;
					$notadeCredito->valor = $saldo_favor;
					$notadeCredito->fecha = date("Y-m-d");
					$notadeCredito->fecha_hora = date("Y-m-d H:i:s");
					$notadeCredito->personal_id = Yii::app()->user->usuarioId;
					$notadeCredito->save();

					$nuevoIngreso = new Ingresos;
					$nuevoIngreso->paciente_id = $datosContrato->paciente_id;
					$nuevoIngreso->n_identificacion = $datosContrato->n_identificacion;
					//$nuevoIngreso->contrato_id = $datosContrato->id;
					$nuevoIngreso->valor = $saldo_favor;
					$nuevoIngreso->descripcion = "Ingreso a caja de paciente por Nota de Crédito N° ". $notadeCredito->id;
					$nuevoIngreso->centro_costo_id = 60;
					$nuevoIngreso->forma_pago = "Nota de Crédito";
					$nuevoIngreso->fecha_sola = date("Y-m-d");
					$nuevoIngreso->fecha = date("Y-m-d H:i:s");
					$nuevoIngreso->personal_id = Yii::app()->user->usuarioId;
					$nuevoIngreso->estado = "Activo";
					$nuevoIngreso->vendedor_id = Yii::app()->user->usuarioId;
					$nuevoIngreso->personal_seguimiento = Yii::app()->user->usuarioId;

					$nuevoIngreso->save();

					$datosContrato->estado = "Liquidado";
					$datosContrato->update();

					foreach ($datosContratoDetalle as $datos_contrato_detalle) 
					{
							$datos_contrato_detalle->estado = "Liquidado";
							$datos_contrato_detalle->update();
					}
					$this->redirect(array('view','id'=>$datosContrato->id));
				}
			}

			
		}

		if ($saldo_favor < 0) //Es Cuenta por Cobrar
		{
			if ($datosContrato->saldo == 0) //Ya pago valor de contrato, tratamientos van con descuento
			{
				// $datosContrato->estado = "Liquidado";
				// $datosContrato->update();

				// foreach ($datosContratoDetalle as $datos_contrato_detalle) 
				// {
				// 		$datos_contrato_detalle->estado = "Liquidado";
				// 		$datos_contrato_detalle->update();
				// }
				// $this->redirect(array('view','id'=>$datosContrato->id));
			}

			//Comentado
			// if ($datosContrato->saldo > 0) //No ha pagado contrato, los tratamientos van sin descuento
			// {
			// 	$datosContrato->estado = "Liquidado";
			// 	$datosContrato->update();

			// 	foreach ($datosContratoDetalle as $datos_contrato_detalle) 
			// 	{
			// 			$datos_contrato_detalle->estado = "Liquidado";
			// 			$datos_contrato_detalle->update();
			// 	}
			// 	$this->redirect(array('view','id'=>$datosContrato->id));				
			// }

			//Buscar si hay cuenta por cobrar madre
			$laCuenta = CuentasXc::model()->find("paciente_id = $datosContrato->paciente_id");
			if ($laCuenta) 
			{

				$laCuentaExiste = CuentasXcDetalle::model()->find("contrato_id = $datosContrato->id");
				if ($laCuentaExiste) 
				{
					$laCuentaExiste->saldo = ($saldo_favor * -1);
					$laCuentaExiste->update();

					$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $datosContrato->paciente_id");
						$total_detalles = 0;
						foreach ($sumadetalles as $suma_detalles) 
						{
							$total_detalles = $total_detalles + $suma_detalles->saldo;
						}

					$cuentaPrincipal = CuentasXc::model()->find("paciente_id = $datosContrato->paciente_id");
					$cuentaPrincipal->saldo = $total_detalles;
					$cuentaPrincipal->update();

				}
				else
				{
					$detallesCuenta = new CuentasXcDetalle;
					$detallesCuenta->cuentas_xc_id = $laCuenta->id;
					$detallesCuenta->paciente_id = $datosContrato->paciente_id;
					$detallesCuenta->n_identificacion = $datosContrato->n_identificacion;
					$detallesCuenta->contrato_id = $datosContrato->id;
					$detallesCuenta->saldo = ($saldo_favor * -1);
					$detallesCuenta->save();

					$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $datosContrato->paciente_id");
						$total_detalles = 0;
						foreach ($sumadetalles as $suma_detalles) 
						{
							$total_detalles = $total_detalles + $suma_detalles->saldo;
						}

					$laCuenta->saldo = $total_detalles;
					$laCuenta->update();
				}
				
			}
			else
			{
				$nuevaCuenta = new CuentasXc;
				$nuevaCuenta->paciente_id = $datosContrato->paciente_id;
				$nuevaCuenta->n_identificacion = $datosContrato->n_identificacion;
				$nuevaCuenta->saldo = ($saldo_favor * -1);
				$nuevaCuenta->save();
				
				
					$detallesCuenta = new CuentasXcDetalle;
					$detallesCuenta->cuentas_xc_id = $nuevaCuenta->id;
					$detallesCuenta->paciente_id = $nuevaCuenta->paciente_id;
					$detallesCuenta->n_identificacion = $nuevaCuenta->n_identificacion;
					$detallesCuenta->contrato_id = $datosContrato->id;
					$detallesCuenta->saldo = $nuevaCuenta->saldo;
					$detallesCuenta->save();
				
				
			}


			//if ($datosContrato->saldo > 0) //No ha pagado contrato, los tratamientos van sin descuento
			//{
				$datosContrato->estado = "Liquidado";
				$datosContrato->update();

				foreach ($datosContratoDetalle as $datos_contrato_detalle) 
				{
						$datos_contrato_detalle->estado = "Liquidado";
						$datos_contrato_detalle->update();
				}
				$this->redirect(array('view','id'=>$datosContrato->id));				
			//}


		}

		if ($saldo_favor == 0) //No se
		{
			# code...
		}



		Yii::app()->user->setFlash('error',$saldo_favor);	

		//Contrato Pagado
		if ($datosContrato->saldo == 0) 
		{
			//Verificar si todos los tratamientos ya estan realizados
		}
		
	}

	public function actionGuardarPresupueston()
	{
		$model=new Contratos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Presupuesto']))
		// {
			//$model->attributes=$_POST['Presupuesto'];
			

			 $model->paciente_id = $_GET['idPaciente'];
			 $model->estado = "Activo";
			 $model->fecha = date("Y-m-d");
			 $model->vendedor_id = $_POST['vendedor_id'];
			 $model->observaciones = $_POST['observaciones'];
			 $model->usuario_id = Yii::app()->user->usuarioId;

			
			 if($model->save())
			 {
			 	//Actualizar estado de presupuesto


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
			 			$detalleP->estado = "Activo";
			 			$eltotal = $eltotal + $_POST['total_'.$i];
			 			$detalleP->save();
			 		}

			 		$ElTratamiento = ContratoDetalle::model()->find("presupuesto_id = $model->id");

			 		$paraTotal = Contratos::model()->findByPk($model->id);
			 		//Guardar tratamiento
			 		$paraTotal->tratamiento = $ElTratamiento->lineaServicio->nombre;
			 		$paraTotal->total = $eltotal;
			 		$paraTotal->saldo = $eltotal;
			 		$paraTotal->save();
			 		
			 	}
			 	$this->redirect(array('view','id'=>$model->id));
			 }


		//}

		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
	}

	public function actionNotaCredito($id)
	{
		//Agregar nota de credito
	}


	public function actionActualizarContrato()
	{
		$model= Contratos::model()->findByPk($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Presupuesto']))
		// {
			//$model->attributes=$_POST['Presupuesto'];
			

			 $model->fechahora = date("Y-m-d H:i:s");
			 $model->observaciones = $_POST['observaciones'];
			 //$model->observaciones_liquidacion = $_POST['observaciones_liquidacion'];
			 $model->usuario_id = Yii::app()->user->usuarioId;
			 $model->vendedor_id = $_POST['vendedor_id'];

			
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
				 			$detalleP->contrato_id = $model->id;
				 			$detalleP->linea_servicio_id = $_POST['linea_'.$i];
				 			$detalleP->cantidad = $_POST['cantidad_'.$i];
				 			$detalleP->vu = $_POST['vu_'.$i];
				 			$detalleP->desc = $_POST['desc_'.$i];
				 			$detalleP->vu_desc = $_POST['vu_desc_'.$i];
				 			$detalleP->vt_sin_desc = $_POST['vt_sin_desc_'.$i];
				 			$detalleP->vt_con_desc = $_POST['vt_con_desc_'.$i];
				 			$detalleP->total = $_POST['total_'.$i];
				 			$detalleP->estado = "Activo";
				 			$eltotal = $eltotal + $_POST['total_'.$i];
				 			$detalleP->save();
				 		}
			 		}

			 		$ElTratamiento = ContratoDetalle::model()->find("contrato_id = $model->id");
			 		
			 		$paraTotal = Contratos::model()->findByPk($model->id);
					$paraTotal->tratamiento = $ElTratamiento->lineaServicio->nombre;
			 		$paraTotal->total = $eltotal;
			 		$paraTotal->saldo = $eltotal;
			 		$paraTotal->save();
			 		
			 	}
			 	$this->redirect(array('view','id'=>$model->id));
			 


		//}

		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
	}


	public function actionActualizarContratoLiquidar()
	{
		$model= Contratos::model()->findByPk($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Presupuesto']))
		// {
			//$model->attributes=$_POST['Presupuesto'];
			//Verificar si es una cuenta por cobrar
				$losIngresos = Ingresos::model()->findAll("contrato_id = $model->id and estado = 'Activo'");
				$sumaIngresos = 0;
				if ($losIngresos) {
					foreach ($losIngresos as $los_ingresos) {
						$sumaIngresos = $sumaIngresos + $los_ingresos->valor;
					}

				}

			 //$model->fechahora = date("Y-m-d H:i:s");
			 $model->observaciones = $_POST['observaciones'];
			 //$model->observaciones_liquidacion = $_POST['observaciones_liquidacion'];
			 //$model->usuario_id = Yii::app()->user->usuarioId;

			
			 if($model->save())
			 {
			 	$detalleP = ContratoDetalle::model()->findAll("contrato_id = $model->id");
	 			foreach ($detalleP as $detalle_P) {
					$detalle_P->delete();					 		
	 			}

	 			$eltotal = 0;
			 	for ($i=0; $i <= 10; $i++) {
			 		//$x = $i+1;
			 		//
			 		 if (isset($_POST['cantidad_'.$i])) 
			 		 {
				 			$detalleP = new ContratoDetalle;
				 			$detalleP->contrato_id = $model->id;
				 			$detalleP->linea_servicio_id = $_POST['linea_'.$i];
				 			$detalleP->cantidad = $_POST['cantidad_'.$i];
				 			$detalleP->realizadas = $_POST['realizadas_'.$i];
				 			$detalleP->vu = $_POST['vu_'.$i];
				 			$detalleP->desc = $_POST['desc_'.$i];
				 			$detalleP->vu_desc = $_POST['vu_desc_'.$i];
				 			$detalleP->vt_sin_desc = $_POST['vt_sin_desc_'.$i];
				 			$detalleP->vt_con_desc = $_POST['vt_con_desc_'.$i];
				 			$detalleP->total = $_POST['total_'.$i];
				 			$detalleP->estado = "Activo";
				 			$eltotal = $eltotal + $_POST['total_'.$i];
				 			$detalleP->save();
				 		}
			 		}

					$ElTratamiento = ContratoDetalle::model()->find("contrato_id = $model->id");

			 		$paraTotal = Contratos::model()->findByPk($model->id);
			 		$paraTotal->tratamiento = $ElTratamiento->lineaServicio->nombre;
			 		$paraTotal->descuento = "Si";
			 		$paraTotal->total = $eltotal;
			 		$paraTotal->saldo = $eltotal - $sumaIngresos;
			 		$paraTotal->save();
			 		
			 	}
			 	//Magia para hacer la liquidacion
			 	
				//Actualizar pago a asistenciales
				$lasAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $model->id");
				if ($lasAsistenciales) 
				{
					foreach ($lasAsistenciales as $las_asistenciales) 
					{
						$las_asistenciales->saldo = $paraTotal->saldo * -1;
						$las_asistenciales->update();
					}
				}

				//Actualizar Cuentas por Cobrar
				$laCuenta = CuentasXcDetalle::model()->find("contrato_id = $model->id");
				if ($laCuenta) 
				{
					$laCuenta->saldo = $paraTotal->saldo;
					$laCuenta->update();

					$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $model->paciente_id");
						$total_detalles = 0;
						foreach ($sumadetalles as $suma_detalles) 
						{
							$total_detalles = $total_detalles + $suma_detalles->saldo;
						}

					$cuentaPrincipal = CuentasXc::model()->find("paciente_id = $model->paciente_id");
					$cuentaPrincipal->saldo = $total_detalles;
					$cuentaPrincipal->update();

				}

				//Actualizar 
				

			 	$this->redirect(array('view','id'=>$model->id));
			 


		//}

		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
	}


	public function actionContratos()
	{
			$mPDF1 = Yii::app()->ePdf->HTML2PDF();
			$mPDF1->WriteHTML($this->renderPartial('contratos', array(), true));
    		$mPDF1->Output();
		
		$this->layout = "dialoglayout";
	    $this->render('contratos');
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

		if(isset($_POST['Contratos']))
		{
			$model->attributes=$_POST['Contratos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionGuardarContratos()
	{
		if(!isset($_GET['idPaciente']))
		{
		$model = new Contratos;
			
			//Buscar Presupuesto
			$elpresupuesto = Presupuesto::model()->findByPk($_GET['idpresupuesto']);
			
			 $model->presupuesto_id = $elpresupuesto->id;
			 $model->paciente_id = $elpresupuesto->paciente_id;
			 $model->total = $elpresupuesto->total;
			 $model->saldo = $elpresupuesto->total;
			 $model->n_identificacion = $elpresupuesto->paciente->n_identificacion;
			 $model->estado = "Sin Confirmar";
			 $model->fecha_sola = date("Y-m-d");
			 $model->fechahora = date("Y-m-d H:i:s");
			 $model->vendedor_id = $elpresupuesto->vendedor_id;
			 $model->usuario_id = $elpresupuesto->usuario_id;
			 $model->observaciones = $elpresupuesto->observaciones;
			
			if($model->save())
			{
				$detallePresupuesto = PresupuestoDetalle::model()->findAll("presupuesto_id=$elpresupuesto->id");
				foreach ($detallePresupuesto as $detalle_presupuesto) 
				{
					$detalleContrato = new ContratoDetalle;
					$detalleContrato->contrato_id = $model->id;
		 			$detalleContrato->linea_servicio_id = $detalle_presupuesto->linea_servicio_id;
		 			$detalleContrato->cantidad = $detalle_presupuesto->cantidad;
		 			$detalleContrato->vu = $detalle_presupuesto->vu;
		 			$detalleContrato->desc = $detalle_presupuesto->desc;
		 			$detalleContrato->vu_desc = $detalle_presupuesto->vu_desc;
		 			$detalleContrato->vt_sin_desc = $detalle_presupuesto->vt_sin_desc;
		 			$detalleContrato->vt_con_desc = $detalle_presupuesto->vt_con_desc;
		 			$detalleContrato->estado = "Activo";
		 			$detalleContrato->total = $detalle_presupuesto->total;
		 			$detalleContrato->save();
				}
			 	$elpresupuesto->estado = "Contratado";
			 	$elpresupuesto->save();

			 	$ElTratamiento = ContratoDetalle::model()->find("contrato_id = $model->id");

		 		$paraTotal = Contratos::model()->findByPk($model->id);
		 		$paraTotal->tratamiento = $ElTratamiento->lineaServicio->nombre;
		 		$paraTotal->save();
			}
				$this->redirect(array('view','id'=>$model->id));
		// 		
		

		}
		else
		{
				$model=new Contratos;

				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);

				// if(isset($_POST['Presupuesto']))
				// {
					//$model->attributes=$_POST['Presupuesto'];
					$datoPaciente = Paciente::model()->findByPk($_GET['idPaciente']);

					 $model->paciente_id = $_GET['idPaciente'];
					 $model->estado = "Activo";
					 $model->n_identificacion = $datoPaciente->n_identificacion;
					 $model->fechahora = date("Y-m-d H:i:s");
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
					 			$detalleP = new ContratoDetalle;
					 			$detalleP->contrato_id = $model->id;
					 			$detalleP->linea_servicio_id = $_POST['linea_'.$i];
					 			$detalleP->cantidad = $_POST['cantidad_'.$i];
					 			$detalleP->vu = $_POST['vu_'.$i];
					 			$detalleP->desc = $_POST['desc_'.$i];
					 			$detalleP->vu_desc = $_POST['vu_desc_'.$i];
					 			$detalleP->vt_sin_desc = $_POST['vt_sin_desc_'.$i];
					 			$detalleP->vt_con_desc = $_POST['vt_con_desc_'.$i];
					 			$detalleP->total = $_POST['total_'.$i];
					 			$detalleP->estado = "Activo";
					 			$eltotal = $eltotal + $_POST['total_'.$i];
					 			$detalleP->save();
					 		}

					 		
					 		
					 	}

					 	$ElTratamiento = ContratoDetalle::model()->find("contrato_id = $model->id");

				 		$paraTotal = Contratos::model()->findByPk($model->id);
				 		$paraTotal->tratamiento = $ElTratamiento->lineaServicio->nombre;
				 		$paraTotal->total = $eltotal;
				 		$paraTotal->saldo = $eltotal;
				 		$paraTotal->save();
				 		
					 	$this->redirect(array('view','id'=>$model->id));
					 }
			}
		
	}


	public function actionPrecio()
	{
		$dataProvider=new CActiveDataProvider('Presupuesto');
		$this->layout = 'vacio';
		$this->render('precio',array(
			//'dataProvider'=>$dataProvider,
		));
	}

	public function actionVincular()
	{		
		if (isset($_GET['confirmado'])) 
		{
			//Vincular Ingreso a Contrato
			$elContrato = Contratos::model()->findByPk($_GET['idContrato']);
			$elIngreso = Ingresos::model()->findByPk($_GET['idIngreso']);

			$elIngreso->contrato_id = $elContrato->id;
			$elIngreso->update();

			$elContrato->saldo = $elContrato->saldo - $elIngreso->valor;
			$elContrato->update();

			//Actualizar en todos lados
			if ($elIngreso->contrato_id != NULL) 
			{
				// $elContrato = Contratos::model()->findByPk($elIngreso->contrato_id);				
				// $elContrato->saldo = $elContrato->saldo - $elIngreso->valor;
		 		// $elContrato->save();
			

				//Actualizar cuenta por cobrar
				$lacuentaXC = CuentasXc::model()->find("paciente_id = $elContrato->paciente_id");
				if ($lacuentaXC) 
				{
					//Verificar si saldo es menor que cero
					$nuevoSaldo = $lacuentaXC->saldo - $elIngreso->valor;
					if ($nuevoSaldo <= 0) 
						{$lacuentaXC->saldo = 0;}
					else
						{$lacuentaXC->saldo = $nuevoSaldo;}
					//$lacuentaXC->update();
					
					//Cuenta por cobrrar detalle
					//$cuentaXC_detalle = CuentasXcDetalle::model()->find("paciente_id = $elPaciente->id");
					$cuentaXC_detalle = CuentasXcDetalle::model()->find("contrato_id = $elIngreso->contrato_id");
					if ($cuentaXC_detalle) {
						$nuevoSaldoDetalle = $cuentaXC_detalle->saldo - $elIngreso->valor;
						if ($nuevoSaldoDetalle <= 0) 
							{$cuentaXC_detalle->saldo = 0;}
							//{$cuentaXC_detalle->saldo = $nuevoSaldoDetalle;}
						else
							{$cuentaXC_detalle->saldo = $nuevoSaldoDetalle;}
						$cuentaXC_detalle->update();

						$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $elContrato->paciente_id");
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
				 $saldoContrato = Contratos::model()->findByPk($elIngreso->contrato_id);
				 if ($saldoContrato) 
				 {
				 	if ($saldoContrato->saldo > 0) {
				 	//Actualizar pago a Asistenciales
					 	$pagoAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $elIngreso->contrato_id");
					 	if ($pagoAsistenciales) 
					 	{
					 			foreach ($pagoAsistenciales as $pago_asistenciales) 
					 			{
					 				$pago_asistenciales->saldo = $pago_asistenciales->saldo + $elIngreso->valor;
					 				$pago_asistenciales->update();
					 			}
					 	}
					 }
					 else
					 {
					 	if ($saldoContrato->saldo == 0 and $saldoContrato->estado = "Liquidado") 
					 	{
					 		$pagoAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $elIngreso->contrato_id");
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
						 	$detalleIngresos = Ingresos::model()->findAll("contrato_id = $elIngreso->contrato_id and estado = 'Activo'");
							foreach ($detalleIngresos as $detalle_ingreso) 
							{
								$sumaIngresos = $sumaIngresos + $detalle_ingreso->valor;
							}

							//Detalle de contratos
							$datosContratoDetalle = ContratoDetalle::model()->findAll("contrato_id = $elIngreso->contrato_id");
							foreach ($datosContratoDetalle as $datos_Contrato_Detalle) 
							{
									$total_vu_descuento_suma = $total_vu_descuento_suma + ($datos_Contrato_Detalle->vu_desc * $datos_Contrato_Detalle->realizadas);

							}

						 	$pagoAsistenciales = PagoCosmetologas::model()->findAll("contrato_id = $elIngreso->contrato_id");
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







			Yii::app()->user->setFlash('success',"Se ha vinculado.");	
			$this->redirect(array('view','id'=>$_GET['idContrato']));
		}
		else
		{
			$this->render('vincular',array(
			//'dataProvider'=>$dataProvider,
			));	
		}
		
	}


	public function actionVincularNota()
	{		
		if (isset($_GET['confirmado'])) 
		{
			//Vincular Ingreso a Contrato
			$elContrato = Contratos::model()->findByPk($_GET['idContrato']);
			$elIngreso = NotaCredito::model()->findByPk($_GET['idNota']);

			$nuevoIngreso = new Ingresos;
			$nuevoIngreso->paciente_id = $elContrato->paciente_id;
			$nuevoIngreso->n_identificacion = $elContrato->n_identificacion;
			$nuevoIngreso->contrato_id = $elContrato->id;
			$nuevoIngreso->valor = $elIngreso->valor;
			$nuevoIngreso->descripcion = "Nota de Crédito N° ". $elIngreso->id;
			$nuevoIngreso->centro_costo_id = 60;
			$nuevoIngreso->forma_pago = "Nota de Crédito";
			$nuevoIngreso->fecha_sola = date("Y-m-d");
			$nuevoIngreso->fecha = date("Y-m-d H:i:s");
			$nuevoIngreso->personal_id = Yii::app()->user->usuarioId;
			$nuevoIngreso->estado = "Activo";
			$nuevoIngreso->vendedor_id = Yii::app()->user->usuarioId;

			if ($nuevoIngreso->save()) 
			{
				$elContrato->saldo = $elContrato->saldo - $nuevoIngreso->valor;
				$elContrato->update();
				$elIngreso->contrato_asociado_id = $elContrato->id;
				$elIngreso->update();
				Yii::app()->user->setFlash('success',"Se ha vinculado.");	
				$this->redirect(array('view','id'=>$_GET['idContrato']));	
			}
			else
			{
				Yii::app()->user->setFlash('error',"No se ha vinculado.");	
				$this->redirect(array('view','id'=>$_GET['idContrato']));	
			}

			

			
		 			
		}
		else
		{
			$this->render('vincular',array(
			//'dataProvider'=>$dataProvider,
			));	
		}
		
	}


	public function actionAprobarContratos()
	{
		$elContrato = Contratos::model()->findByPk($_GET['idContrato']);
		$elContrato->fecha = date("Y-m-d");
		$elContrato->estado = "Activo";
		if ($elContrato->save()) 
		{
			$this->redirect(array('view','id'=>$_GET['idContrato']));
		}
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
		$dataProvider=new CActiveDataProvider('Contratos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contratos('search');
		$this->layout='main';
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contratos']))
			$model->attributes=$_GET['Contratos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contratos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contratos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contratos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contratos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
