<?php

class CitasController extends Controller
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'calendario', 'citas', 'ver', 'exportar', 'seguimientoComercial'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'cancelar', 'PagoCosmetologa', 'confirmar', 'filtroContrato', 'correoConfirma'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('descuento', 'exportar', 'exportarAgenda', 'vencidasDetalle', 'sinConfirmar', 'bloquear'),
				'users'=>array('@'),
			),			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('vencidas'),
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

	public function actionVencidas()
	{
		//$elPersonal = Citas::model()->count("estado = 'Vencida' group by personal_id");
		//$elPersonal = Personal::model()->findAll("agenda = 'SI'");
		$this->render('vencidas');
	}

	public function actionBloquear()
	{
		//$elPersonal = Citas::model()->count("estado = 'Vencida' group by personal_id");
		//$elPersonal = Personal::model()->findAll("agenda = 'SI'");
		$this->render('bloquear');
	}

	public function actionVer($id)
	{
		$this->render('ver',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Citas;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Citas']))
		{
			$fechaCita = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Citas']['fecha_cita']);
			$horadeFin = $_POST['Citas']['hora_fin'];
			$horadeInicio = $_POST['Citas']['hora_inicio'];

			$laLineaServicio = $_POST['Citas']['linea_servicio_id'];
			/////Agregar equipo a reserva
			//Buscar equipo de la linea de servicio seleccionada.
			$equiposDisponibles = Equipos::model()->findAll("linea_servicio_id = $laLineaServicio");
			if ($equiposDisponibles) 
			{
				$sihayDisponible = 0;
				$lasuperllave = 0;
				$lallave = 0;
				//Consultar en agenda de equipos reservados
				$agendaEquipos = CitasEquipo::model()->findAll("fecha = '$fechaCita' and linea_servicio_id = $laLineaServicio");
				if ($agendaEquipos) 
				{
					//Verificar equipo en la agenda
					
					foreach ($equiposDisponibles as $equipos_disponibles)
					{
						$lallave = 0;
						$laInsidencia = 0;
						foreach ($agendaEquipos as $agenda_equipos) 
						{
							
							if ($equipos_disponibles->id == $agenda_equipos->equipo_id) 
							{
								
								$lallave = 1; //Si hay uno
								if ($horadeInicio >= $agenda_equipos->hora_inicio and $horadeInicio <= $agenda_equipos->hora_fin)
								{
									$laInsidencia = 1;	
								}

								if ($horadeFin >= $agenda_equipos->hora_inicio and $horadeFin <= $agenda_equipos->hora_fin) 
								{
									$laInsidencia = 1;
								}								
							}

						
						}

							//Comienza ingreso de equipo a reserva
							if ($laInsidencia == 0) 
							{
								if ($lasuperllave == 0) 
								{
									$lasuperllave = 1;
									$lallave = 2; //Guardo
									$reservaEquipos = new CitasEquipo;
									$reservaEquipos->fecha = $fechaCita;
									$reservaEquipos->equipo_id = $equipos_disponibles->id;
									$reservaEquipos->linea_servicio_id = $laLineaServicio;
								}
							}

						//Evaluar llave
						if ($lallave == 0) 
						{
							if ($sihayDisponible == 0) 
							{
								$numerodeEquipo = $equipos_disponibles->id;
								$sihayDisponible = 1;
							}
							
						}
					}

				}
				else //Preparar ingreso de registro
				{
					$unEquipo = Equipos::model()->find("linea_servicio_id = $laLineaServicio");
					$reservaEquipos = new CitasEquipo;
					$reservaEquipos->fecha = $fechaCita;
					$reservaEquipos->equipo_id = $unEquipo->id;
					$reservaEquipos->linea_servicio_id = $laLineaServicio;
					//Yii::app()->user->setFlash('error',"No debe de hacerlo aqui".$unEquipo->id);
				}

				if ($sihayDisponible == 1) 
				{
					$reservaEquipos = new CitasEquipo;
					$reservaEquipos->fecha = $fechaCita;
					$reservaEquipos->equipo_id = $numerodeEquipo;
					$reservaEquipos->linea_servicio_id = $laLineaServicio;
					//Yii::app()->user->setFlash('error',"Esta es una maravilla".$equipos_disponibles->id);
				}
			}
			else
			{
				$reservaEquipos = new CitasEquipo;
			}

			$elPaciente = Paciente::model()->findByPk($_POST['Citas']['paciente_id']);

			$model->attributes=$_POST['Citas'];
			$model->fecha_cita = $fechaCita;
			$model->n_identificacion = $elPaciente->n_identificacion;
			$model->hora_fin = $_POST['Citas']['hora_fin'] - 1;
			$model->hora_fin_mostrar = $_POST['Citas']['hora_fin'];
			$model->contrato_id = $_POST['elContrato'];
			$model->usuario_id = Yii::app()->user->usuarioId;
			$model->estado = "Programada";
			//$model->equipo_adicional = $_POST['Citas']['equipo_adicional'];
			$model->fecha_creacion = date("Y-m-d");
			$model->fecha_hora_creacion = date("Y-m-d H:i:s");

			if($model->save())
			{
				//Actualizar estado de Detalle de Contrato
				if ($model->contrato_id != NULL) 
				{
					//Buscar Detalle
					$detalleContrato = ContratoDetalle::model()->findAll("contrato_id = $model->contrato_id and estado = 'Activo'");
					foreach ($detalleContrato as $detalle_contrato) 
					{
						if ($model->linea_servicio_id == $detalle_contrato->linea_servicio_id) 
						{
							$paraActualizar = ContratoDetalle::model()->findByPk($detalle_contrato->id);
							$paraActualizar->estado = "Programada";
							$paraActualizar->save();
						}
					}
				}

				//Terminar consulta de reserva de equipo
				$reservaEquipos->hora_inicio = $model->hora_inicio;
				$reservaEquipos->hora_fin = $model->hora_fin;
				$reservaEquipos->hora_fin_mostrar = $model->hora_fin + 1;
				$reservaEquipos->cita_id = $model->id;
				$reservaEquipos->save();

				//Envio de Correo
				if ($model->correo == "Si") {
					$this->actionEnvioCorreo($model->id);
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Citas']))
		{

			//Copiar datos a tabla de actualizaciones
			$citaAnterior = new CitasActualizacion;
			$citaAnterior->cita_id 			= $model->id;
			$citaAnterior->fecha 			= $model->fecha_cita;
			$citaAnterior->personal 		= $model->personal->nombreCompleto;
			$citaAnterior->contrato 		= $model->contrato_id;
			$citaAnterior->servicio 		= $model->lineaServicio->nombre;
			$citaAnterior->comentario 		= $model->comentario;
			$citaAnterior->inicio 			= $model->hora_inicio;
			$citaAnterior->fin 				= $model->hora_fin_mostrar;
			$citaAnterior->actualizacion 	= $model->actualizacion;
			$citaAnterior->usuario 			= $model->usuario->nombreCompleto;


			$model->attributes=$_POST['Citas'];
			$model->fecha_cita = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Citas']['fecha_cita']);
			$model->hora_fin = $_POST['Citas']['hora_fin'] - 1;
			$model->hora_fin_mostrar = $_POST['Citas']['hora_fin'];
			$model->contrato_id = $_POST['elContrato'];
			$model->usuario_id = Yii::app()->user->usuarioId;
			$model->actualizacion = $_POST['Citas']['actualizacion'];
			//$model->equipo_adicional = $_POST['Citas']['equipo_adicional'];

			$fechaCita = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Citas']['fecha_cita']);
			$horadeFin = $_POST['Citas']['hora_fin'];
			$horadeInicio = $_POST['Citas']['hora_inicio'];

			$laLineaServicio = $_POST['Citas']['linea_servicio_id'];

			/////Actualizar equipo a reserva
			//Buscar equipo de la linea de servicio seleccionada.
			$equiposDisponibles = Equipos::model()->findAll("linea_servicio_id = $laLineaServicio");
			if ($equiposDisponibles) 
			{
				$sihayDisponible = 0;
				$lasuperllave = 0;
				$lallave = 0;
				//Consultar en agenda de equipos reservados
				$agendaEquipos = CitasEquipo::model()->findAll("fecha = '$fechaCita' and linea_servicio_id = $laLineaServicio");
				if ($agendaEquipos) 
				{
					//Verificar equipo en la agenda
					
					foreach ($equiposDisponibles as $equipos_disponibles)
					{
						$lallave = 0;
						$laInsidencia = 0;
						foreach ($agendaEquipos as $agenda_equipos) 
						{
							
							if ($equipos_disponibles->id == $agenda_equipos->equipo_id) 
							{
								
								$lallave = 1; //Si hay uno
								if ($horadeInicio >= $agenda_equipos->hora_inicio and $horadeInicio <= $agenda_equipos->hora_fin)
								{
									$laInsidencia = 1;	
								}

								if ($horadeFin >= $agenda_equipos->hora_inicio and $horadeFin <= $agenda_equipos->hora_fin) 
								{
									$laInsidencia = 1;
								}

								if ($laInsidencia == 1) {
									//Yii::app()->user->setFlash('error',"No debe de hacerlo aqui".$laInsidencia);
									//$this->redirect(array('update','id'=>$model->id));
								}
							}

						
						}

							//Comienza ingreso de equipo a reserva
							//if ($laInsidencia == 0) 
							//{
								if ($lasuperllave == 0) 
								{
									$lasuperllave = 1;
									$lallave = 2; //Guardo
									//$reservaEquipos = new CitasEquipo;
									$reservaEquipos = CitasEquipo::model()->findByPk($model->id);
									if ($reservaEquipos) 
									{
										$reservaEquipos->fecha = $fechaCita;
										$reservaEquipos->hora_inicio = $model->hora_inicio;
										$reservaEquipos->hora_fin = $model->hora_fin;
										$reservaEquipos->hora_fin_mostrar = $model->hora_fin + 1;
										$reservaEquipos->equipo_id = $equipos_disponibles->id;
										$reservaEquipos->linea_servicio_id = $laLineaServicio;
									}
									else
									{
										$reservaEquiposNuevo = new CitasEquipo;
										$reservaEquiposNuevo->fecha = $fechaCita;
										$reservaEquiposNuevo->hora_inicio = $model->hora_inicio;
										$reservaEquiposNuevo->hora_fin = $model->hora_fin;
										$reservaEquiposNuevo->hora_fin_mostrar = $model->hora_fin + 1;
										$reservaEquiposNuevo->equipo_id = $equipos_disponibles->id;
										$reservaEquiposNuevo->linea_servicio_id = $laLineaServicio;
										$reservaEquiposNuevo->save();
									}
									
								}
							//}

						//Evaluar llave
						if ($lallave == 0) 
						{
							if ($sihayDisponible == 0) 
							{
								$numerodeEquipo = $equipos_disponibles->id;
								$sihayDisponible = 1;
							}
							
						}
					}

				}
				else //Preparar ingreso de registro
				{
					$unEquipo = Equipos::model()->find("linea_servicio_id = $laLineaServicio");
					//$reservaEquipos = new CitasEquipo;
					$reservaEquipos = CitasEquipo::model()->findByPk($model->id);
					$reservaEquipos->fecha = $fechaCita;
					$reservaEquipos->hora_inicio = $model->hora_inicio;
					$reservaEquipos->hora_fin = $model->hora_fin;
					$reservaEquipos->hora_fin_mostrar = $model->hora_fin + 1;
					$reservaEquipos->equipo_id = $unEquipo->id;
					$reservaEquipos->linea_servicio_id = $laLineaServicio;
					//Yii::app()->user->setFlash('error',"No debe de hacerlo aqui".$unEquipo->id);
				}

				if ($sihayDisponible == 1) 
				{
					$reservaEquipos = CitasEquipo::model()->findByPk($model->id);
					//$reservaEquipos = new CitasEquipo;
					$reservaEquipos->fecha = $fechaCita;
					$reservaEquipos->hora_inicio = $model->hora_inicio;
					$reservaEquipos->hora_fin = $model->hora_fin;
					$reservaEquipos->hora_fin_mostrar = $model->hora_fin + 1;
					$reservaEquipos->equipo_id = $numerodeEquipo;
					$reservaEquipos->linea_servicio_id = $laLineaServicio;
					//Yii::app()->user->setFlash('error',"Esta es una maravilla".$equipos_disponibles->id);
				}
			}
			else
			{
				$reservaEquipos = CitasEquipo::model()->findByPk($model->id);
				//$reservaEquipos = new CitasEquipo;
			}





			if($model->validate())
			{
			if($model->update())

				
				//Actualizar Cita Equipo
				//$losEquipos = CitasEquipo::model()->findByPk($model->id);
				//Si encuentra registros
				//if($losEquipos)
				//{
					// $losEquipos->fechaCita = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['Citas']['fecha_cita']);
					// $losEquipos->hora_inicio = $_POST['Citas']['hora_inicio'];
					// $losEquipos->hora_fin = $_POST['Citas']['hora_fin'] - 1;
					// $losEquipos->hora_fin_mostrar = $_POST['Citas']['hora_fin'];
					// $losEquipos->update();
				//}

				//Terminar consulta de reserva de equipo
				if(isset($reservaEquipos))	
				{
					// $reservaEquipos->hora_inicio = $horadeInicio;
					// $reservaEquipos->hora_fin = $horadeFin;
					// $reservaEquipos->hora_fin_mostrar = $model->hora_fin + 1;
					$reservaEquipos->hora_inicio = $model->hora_inicio;
					$reservaEquipos->hora_fin = $model->hora_fin;
					$reservaEquipos->hora_fin_mostrar = $model->hora_fin + 1;
					$reservaEquipos->cita_id = $model->id;
					$reservaEquipos->update();
					//Yii::app()->user->setFlash('error',"Se actualizo en equipo.");
				}
				
				//Actualizar estado de Detalle de Contrato
				if ($model->contrato_id != NULL) 
				{
					//Buscar Detalle
					$detalleContrato = ContratoDetalle::model()->findAll("contrato_id = $model->contrato_id and estado = 'Activo'");
					foreach ($detalleContrato as $detalle_contrato) 
					{
						if ($model->linea_servicio_id == $detalle_contrato->linea_servicio_id) 
						{
							$paraActualizar = ContratoDetalle::model()->findByPk($detalle_contrato->id);
							$paraActualizar->estado = "Programada";
							$paraActualizar->update();
						}
					}
				}

				//Envio de Correo
				if ($model->correo == "Si") {
					$this->actionEnvioCorreo($model->id);
				}

				$citaAnterior->save();


				$this->redirect(array('view','id'=>$model->id));
		}
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

	public function actionDescuento()
	{
		//Aplicar Descuento
		$numeroCita = $_GET['idCita'];
		$nuevaValoracion = $_POST['valoracion'];
		$cuenta = CuentasXcDetalle::model()->find("cita_id = $numeroCita");
		$cuenta->saldo = $nuevaValoracion;
		$cuenta->update();


		$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $cuenta->paciente_id");
		$total_detalles = 0;
		foreach ($sumadetalles as $suma_detalles) 
		{
			$total_detalles = $total_detalles + $suma_detalles->saldo;
		}

		$pacienteXC = CuentasXc::model()->find("paciente_id = $cuenta->paciente_id");
		$pacienteXC->saldo = $total_detalles;
		$pacienteXC->update();

		
		//Aplicar a Pago a Asistenciales
		$pagoAsistenciales = PagoCosmetologas::model()->find("cita_id = $numeroCita and contrato_id is NULL");
		$pagoAsistenciales->valor_tratamiento_desc = $nuevaValoracion;
		$pagoAsistenciales->saldo = $nuevaValoracion * -1;
		$pagoAsistenciales->aprobo_id = Yii::app()->user->usuarioId;
		$pagoAsistenciales->update();


		$this->redirect(array('view','id'=>$cuenta->cita_id));

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Citas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionEnvioCorreo($idCita)
	{
		$model=Citas::model()->findByPk($idCita);

		$lahora = HorasServicio::model()->findByPK($model->hora_fin + 1);

		//Buscar Correo en la plantilla
		$plantillaCorreo = Correos::model()->findByPK(1);

		$elCorreo = $model->paciente->email;

		if (filter_var($elCorreo, FILTER_VALIDATE_EMAIL)) 
		{
			$soloCorreo = array($elCorreo);
			Yii::import('ext.yii-mail.YiiMailMessage');
			$message = new YiiMailMessage;
			//$message = Yii::app()->Smtpmail;
	        $message->subject = 'Notificación de Cita en SMADIA Clinic: N° '.$model->id;
	        /*$message->view ='prueba';//nombre de la vista q conformara el mail*/      
	        $message->setBody('<br><b>Apreciado Sr (a). : </b>'.$model->paciente->nombreCompleto.'<br><br>
	        				   Su Cita N°: '.$model->id. ' de <b>'.$model->lineaServicio->nombre.'</b> en Smadia Clinic se encuentra agendada para el día: <b>'.Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_cita).'</b>
	        				   a las: <b>'.$model->horaInicio->hora.'</b> con el <b>'.$model->personal->idPerfil->nombre.' '.$model->personal->nombreCompleto.'.</b>
	        <br><br>'.$plantillaCorreo->detalle.'<br>'.$plantillaCorreo->pie.'','text/html');//codificar el html de la vista
	        $message->from =('noresponder@smadiaclinic.com'); // alias del q envia
	        //recorrer a los miembros del equipo
	        $message->setTo($soloCorreo); // a quien se le envia
	        //$message->setTo('gerencia@smadiaclinic.com hramirez@myrs.com.co'); // a quien se le envia
	        Yii::app()->mail->send($message);

	        //Yii::app()->user->setFlash('success',"El correo es. " .$elCorreo);
		}
		else
		{
			Yii::app()->user->setFlash('error',"No se envio confirmación por correo electrónico." .$elCorreo);	
		}
		

        //Yii::app()->user->setFlash('success',"Se entro al proceso de correo. " .$plantillaCorreo->id);

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

				//$attribs = array('estado'=>'Activo');
				$attribs = array();
				$criteria = new CDbCriteria(array('order'=>'id DESC'));
				$criteria->addBetweenCondition('fecha_cita', $laFechaDesde, $laFechaHasta);
				$rows = Citas::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = Citas::model()->findAll();
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'paciente.nombre',
	            'paciente.apellido',
	            'paciente.celular',
	            'n_identificacion::Cedula',
	            'personal.nombreCompleto::Ingresado Por',
				'usuario.nombreCompleto::Registrado por',
				'lineaServicio.nombre::Linea de Servicio',
				'contrato_id::Contrato Asociado',
				'estado::Estado',
				'fecha_cita::Fecha de Cita',
				'horaInicio.hora::Hora de Inicio',
				'horaFinMostrar.hora::Hora de Fin',
				'comentario::Comentario',
				'motivo_cancelacion::Motivo de Cancelación',
				'usuarioEstado.nombreCompleto::Establecio Estado',
				'fecha_creacion::Fecha Creación',
	        ));
		}
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new Citas('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Citas']))
				$model->attributes=$_GET['Citas'];
			$this->layout='main';
			$this->render('admin',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new Citas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Citas']))
			$model->attributes=$_GET['Citas'];
		if (isset($_GET['programadas'])) 
		{
			$model->fecha_cita = date("Y-m-d");
			$model->estado = 'Programada';
			$model->personal_id = Yii::app()->user->usuarioId;
		}

		if (isset($_GET['vencidas'])) 
		{
			$model->estado = 'Vencida';
			$model->personal_id = Yii::app()->user->usuarioId;
		}
		$this->layout='main';
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionVencidasDetalle()
	{

		$model=new Citas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Citas']))
			$model->attributes=$_GET['Citas'];
		$model->personal_id = $_GET['idPersonal'];
		$model->estado = 'Vencida';
		$this->layout='main';
		$this->render('vencidasDetalle',array(
			'model'=>$model,
		));
	}

	public function actionSinConfirmar()
	{

		$model=new Citas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Citas']))
			$model->attributes=$_GET['Citas'];
		$model->fecha_cita = date("d-m-Y");
		$model->confirmacion_personal_id = "";
		$this->layout='main';
		$this->render('sinConfirmar',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Citas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Citas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	//Cancelar Cita
	public function actionCancelar()
	{
		$elid = $_POST['Citas']['id'];
		$lacita = Citas::model()->find("id = $elid and estado !='Completada'");
		if ($lacita) 
		{
		
			$lacita->estado = "Cancelada";
			$lacita->fecha_accion = date("Y-m-d H:i:s");
			$lacita->motivo_cancelacion = $_POST['Citas']['motivo_cancelacion'];
			$lacita->usuario_estado_id = Yii::app()->user->usuarioId;
			if ($lacita->update())
			{

				//Cancelar Reservación de Equipo
				$equipoReservado = CitasEquipo::model()->findByPk($elid);
				if ($equipoReservado) {
					$equipoReservado->delete();
				}
				

				//Actualizar estado de Detalle de Contrato
					if ($lacita->contrato_id != NULL) 
					{
						//Buscar Detalle
						$detalleContrato = ContratoDetalle::model()->find("contrato_id = $lacita->contrato_id and estado = 'Programada' and linea_servicio_id = $lacita->linea_servicio_id");
						if($detalleContrato)
						{
							$detalleContrato->estado = "Activo";
							$detalleContrato->update();	
						}
					}
				Yii::app()->user->setFlash('error',"La cita se ha cancelado.");	
				//Redireccionar
				$dataProvider=new CActiveDataProvider('Citas');
					/*$this->render('calendario',array(
						'dataProvider'=>$dataProvider,
					));*/
				if (isset($_GET['irCita'])) {
					$this->redirect(array('view','id'=>$lacita->id));
				}
				else
				{
					$this->redirect(array('calendario','idpersonal'=>$lacita->personal->id_perfil, 'fecha'=>$lacita->fecha_cita));
				}
			}
			else
			{
				Yii::app()->user->setFlash('error',"No se ha podido cancelar la cita.");	
				if (isset($_GET['irCita'])) {
					$this->redirect(array('view','id'=>$lacita->id));
				}
				else
				{
					$this->redirect(array('calendario','idpersonal'=>$lacita->personal->id_perfil, 'fecha'=>$lacita->fecha_cita));
				}
			}
		}
		else
		{
			Yii::app()->user->setFlash('error',"No se ha podido cancelar la cita.");
			if (isset($_GET['irCita'])) {
				$this->redirect(array('view','id'=>$lacita->id));
			}
			else
			{
			$this->redirect(array('citas'));	
			}	
			
	}
	}


	//Confirmar Cita
	public function actionConfirmar()
	{
		$lacita = Citas::model()->findByPk($_POST['Citas']['contrato_id']);
		//$lacita->estado = "Programada";
		$lacita->fecha_confirmacion = date("Y-m-d H:i:s");
		$lacita->confirmacion = $_POST['Citas']['confirmacion'];
		$lacita->confirmacion_personal_id = Yii::app()->user->usuarioId;
		if ($lacita->update())
		{
			Yii::app()->user->setFlash('success',"La cita se ha confirmado.");	
			//Redireccionar
			$dataProvider=new CActiveDataProvider('Citas');
				/*$this->render('calendario',array(
					'dataProvider'=>$dataProvider,
				));*/
			if (isset($_GET['irCita'])) {
				$this->redirect(array('view','id'=>$lacita->id));
			}
			else
			{
				$this->redirect(array('calendario','idpersonal'=>$lacita->personal->id_perfil, 'fecha'=>$lacita->fecha_cita));
			}

		}
		else
		{
			Yii::app()->user->setFlash('error',"No se ha podido cancelar la cita.");	
			$this->redirect(array('calendario','idpersonal'=>$lacita->personal->id_perfil, 'fecha'=>$lacita->fecha_cita));
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param Citas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='citas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function performAjaxValidation2($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seguimiento-comercial-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCalendario()
	{	
		$dataProvider=new CActiveDataProvider('Citas');

		

		if (isset($_POST['SeguimientoComercial'])) 
		{
			
			$ncita = $_POST['SeguimientoComercial']['cita_id'];

			$lacita = Citas::model()->findByPk($ncita);
			$lacita->estado = $_POST['SeguimientoComercial']['tipo'];
			$lacita->fecha_accion = date("Y-m-d H:i:s");
			$lacita->omitir_seguimiento = $_POST['aplica'];
			$lacita->comentario_cierre = $_POST['SeguimientoComercial']['observaciones'];
			$lacita->usuario_estado_id = Yii::app()->user->usuarioId;
			$lacita->update();



			if ($_POST['aplica'] == "No") 
			{			
				$model=new SeguimientoComercial;
				if ($_POST['SeguimientoComercial']['fecha_accion'] != "") 
				{
					$model->fecha_accion = 		Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['SeguimientoComercial']['fecha_accion']);
				}
				else
				{
					$model->fecha_accion = date("Y-m-d");
				}
				
				
				$model->tema_id = 			$_POST['SeguimientoComercial']['tema_id'];	
				
				$model->id_personal = 		Yii::app()->user->usuarioId;
				$model->responsable_id = 	$_POST['SeguimientoComercial']['responsable_id'];
				$model->observaciones = 	$_POST['SeguimientoComercial']['observaciones'];
				$model->cita_id = 			$_POST['SeguimientoComercial']['cita_id'];
				$model->fecha_registro =	date("Y-m-d");
				$model->tipo = "Cita";
				//Fecha de registro
				$model->paciente_id	= 	$lacita->paciente_id;
				$model->n_identificacion	= 	$lacita->paciente->n_identificacion;
				$model->estado = 		"Abierto";
				$model->save();

			}


			//Actualizar estado de Detalle de Contrato
			if ($lacita->contrato_id != NULL and $lacita->estado == "Completada") 
			{
				//Buscar Detalle
				$detalleContrato = ContratoDetalle::model()->find("contrato_id = $lacita->contrato_id and linea_servicio_id = $lacita->linea_servicio_id and (estado = 'Programada' or estado = 'Activo')");
				$elSaldoContrato = Contratos::model()->findByPk($lacita->contrato_id);
				//Saldo de Contrato
				
					$saldoContrato = $elSaldoContrato->saldo;
				
								
				//$paraActualizar = ContratoDetalle::model()->findByPk($detalle_contrato->id);
				if ($detalleContrato->cantidad > $detalleContrato->realizadas) {
					if ($detalleContrato->cantidad > ($detalleContrato->realizadas + 1)) {
						$detalleContrato->realizadas = $detalleContrato->realizadas + 1;
						$detalleContrato->estado = "Activo";
					}
					else
					{
						$detalleContrato->realizadas = $detalleContrato->realizadas + 1;
						$detalleContrato->estado = "Completada";
					}
				}
				$detalleContrato->update();
				
				
				//Ingresar a Detalle de tratamientos realizados
				$contratoTratamientos = new ContratosTratamientoRealizados;

				$contratoTratamientos->contrato_id = $lacita->contrato_id;
				$contratoTratamientos->cita_id = $lacita->id;
				$contratoTratamientos->linea_servicio_id = $lacita->linea_servicio_id;
				$contratoTratamientos->sesion = $detalleContrato->realizadas;
				$contratoTratamientos->save();

				//Verificar si es una cuenta por cobrar
				$losIngresos = Ingresos::model()->findAll("contrato_id = $lacita->contrato_id and estado = 'Activo'");
				$sumaIngresos = 0;
				if ($losIngresos) {
					foreach ($losIngresos as $los_ingresos) {
						$sumaIngresos = $sumaIngresos + $los_ingresos->valor;
					}

				}



				if(isset($lacita->contrato_id))
					{

						//Actualizar Saldo a favor de contrato
						$los_contratos = Contratos::model()->findByPk($lacita->contrato_id);
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
									$saldo_favorTodos = ($los_contratos->total - $los_contratos->saldo)-$tratamiento_condescuentoTodos;	
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
							//Yii::app()->user->setFlash('warning',"Saldo a Favor Actualizado.");	
					//Fin de actualizar saldo a favor
					}



				
				//Suma de tratamientos realizados
				$saldo_tratamientos = 0;
				$tratamientosRealizados = ContratoDetalle::model()->findAll("contrato_id = $lacita->contrato_id");



				foreach ($tratamientosRealizados as $tratamientos_realizados) 
				{
					$saldo_tratamientos = $saldo_tratamientos + ($tratamientos_realizados->vu * $tratamientos_realizados->realizadas);
				}

				
				if ($sumaIngresos < $saldo_tratamientos)
				{				
					//Buscar Paciente en Cuentas XC
					$pacienteXC = CuentasXc::model()->find("paciente_id = $lacita->paciente_id");
					if ($pacienteXC) 
					{	
						
						$cuentasXC_detalle = CuentasXcDetalle::model()->find("contrato_id = $lacita->contrato_id");
						if ($cuentasXC_detalle) 
						{
							if ($saldoContrato == 0) {
								$cuentasXC_detalle->saldo = 0;
							}
							else
							{
								$cuentasXC_detalle->saldo = $saldo_tratamientos - $sumaIngresos;
							}
							
							$cuentasXC_detalle->update();

							$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $lacita->paciente_id");
							$total_detalles = 0;
							foreach ($sumadetalles as $suma_detalles) 
							{
								$total_detalles = $total_detalles + $suma_detalles->saldo;
							}

							$pacienteXC->saldo = $total_detalles;
							$pacienteXC->update();
							
						}
						else
						{
							//Detalle de CxC
							$cuentasXC_detalle = new CuentasXcDetalle;
							$cuentasXC_detalle->cuentas_xc_id = $pacienteXC->id;
							$cuentasXC_detalle->paciente_id = $lacita->paciente_id;
							$cuentasXC_detalle->n_identificacion = $lacita->n_identificacion;
							$cuentasXC_detalle->cita_id = $lacita->id;
							$cuentasXC_detalle->contrato_id = $lacita->contrato_id;
							//$cuentasXC_detalle->saldo = $detalleContrato->vu;
							if ($saldoContrato == 0) 
							{
								$cuentasXC_detalle->saldo = 0;
							}
							else
							{
								$cuentasXC_detalle->saldo = $saldo_tratamientos - $sumaIngresos;	
							}
							
							$cuentasXC_detalle->save();

							$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $lacita->paciente_id");
							$total_detalles = 0;
							foreach ($sumadetalles as $suma_detalles) 
							{
								$total_detalles = $total_detalles + $suma_detalles->saldo;
							}

							$pacienteXC->saldo = $total_detalles;
							$pacienteXC->update();

							
						}

						//Actualizamos saldo de cuenta
						// $sumadecuentas = 0;
						// $lascuentasxc = CuentasXcDetalle::model()->findAll("paciente_id = $lacita->paciente_id");
						// foreach ($lascuentasxc as $lascuentas_xc) {
						// 	$sumadecuentas = $sumadecuentas + $lascuentas_xc->saldo;
						// }
						// if ($saldoContrato == 0) 
						// {
						// 	$pacienteXC->saldo = 0;
						// }
						// else
						// {
						// 	$pacienteXC->saldo = $sumadecuentas;
						// }
						
						// $pacienteXC->update();
						
					}
					else
					{
						$cuentasXC = new CuentasXc;
						$cuentasXC->paciente_id = $lacita->paciente_id;
						$cuentasXC->n_identificacion = $lacita->n_identificacion;
						if ($saldoContrato == 0) {
							$cuentasXC->saldo = 0;
						}
						else
						{
							$cuentasXC->saldo = $saldo_tratamientos - $sumaIngresos;
						}
						
						$cuentasXC->save();

						//Detalle de CxC
						$cuentasXC_detalle = new CuentasXcDetalle;
						$cuentasXC_detalle->cuentas_xc_id = $cuentasXC->id;
						$cuentasXC_detalle->paciente_id = $lacita->paciente_id;
						$cuentasXC_detalle->n_identificacion = $lacita->n_identificacion;
						$cuentasXC_detalle->cita_id = $lacita->id;
						$cuentasXC_detalle->contrato_id = $lacita->contrato_id;
						if ($saldoContrato == 0) 
						{
							$cuentasXC_detalle->saldo = 0;
						}
						else
						{
							$cuentasXC_detalle->saldo = $saldo_tratamientos - $sumaIngresos;
						}
						
						$cuentasXC_detalle->save();


					}
				}
									
				//Ver que sea cosmetologa
				$this->actionPagoCosmetologa($lacita->id, $sumaIngresos);

			}
			else
			{
				if ($lacita->estado == "Completada") 
				{
					
					//Tratamientos sin contrato
					$pacienteXC = CuentasXc::model()->find("paciente_id = $lacita->paciente_id");
					if ($pacienteXC) 
					{
						$cuentasXC_detalle = new CuentasXcDetalle;
						$cuentasXC_detalle->cuentas_xc_id = $pacienteXC->id;
						$cuentasXC_detalle->paciente_id = $lacita->paciente_id;
						$cuentasXC_detalle->n_identificacion = $lacita->n_identificacion;
						$cuentasXC_detalle->cita_id = $lacita->id;
						$cuentasXC_detalle->linea_servicio_id = $lacita->linea_servicio_id;
						$cuentasXC_detalle->saldo = $lacita->lineaServicio->precio;
						$cuentasXC_detalle->save();

						$sumadetalles = CuentasXcDetalle::model()->findAll("paciente_id = $lacita->paciente_id");
						$total_detalles = 0;
						foreach ($sumadetalles as $suma_detalles) 
						{
							$total_detalles = $total_detalles + $suma_detalles->saldo;
						}

						$pacienteXC->saldo = $total_detalles;
						$pacienteXC->update();
					}
					else
					{
						$cuentasXC = new CuentasXc;
						$cuentasXC->paciente_id = $lacita->paciente_id;
						$cuentasXC->n_identificacion = $lacita->n_identificacion;
						$cuentasXC->saldo = $lacita->lineaServicio->precio;					
						$cuentasXC->save();

						$cuentasXC_detalle = new CuentasXcDetalle;
						$cuentasXC_detalle->cuentas_xc_id = $cuentasXC->id;
						$cuentasXC_detalle->paciente_id = $lacita->paciente_id;
						$cuentasXC_detalle->n_identificacion = $lacita->n_identificacion;
						$cuentasXC_detalle->cita_id = $lacita->id;
						$cuentasXC_detalle->linea_servicio_id = $lacita->linea_servicio_id;
						$cuentasXC_detalle->saldo = $lacita->lineaServicio->precio;
						$cuentasXC_detalle->save();
					}

					//Pago a Cosmetologa
					$pagoCosmetologa = new PagoCosmetologas;
					$pagoCosmetologa->n_identificacion = $lacita->paciente->n_identificacion;
					$pagoCosmetologa->paciente_id = $lacita->paciente_id;
					$pagoCosmetologa->linea_servicio_id = $lacita->linea_servicio_id;
					$pagoCosmetologa->aprobo_id = Yii::app()->user->usuarioId;
					$pagoCosmetologa->vendedor_id = $lacita->personal_id;
					$pagoCosmetologa->cita_id = $lacita->id;
					$pagoCosmetologa->valor_tratamiento = $lacita->lineaServicio->precio;
					$pagoCosmetologa->misma_persona = "No";
					$pagoCosmetologa->valor_comision = 0;
					$pagoCosmetologa->porcentaje = 0;
					$pagoCosmetologa->estado = "Activo";
					$pagoCosmetologa->descarga = "No";
					$pagoCosmetologa->fecha = date("Y-m-d H:i:s");
					$pagoCosmetologa->fecha_sola = date("Y-m-d");
					$pagoCosmetologa->sesion = "1/1";
					$pagoCosmetologa->personal_id = $lacita->personal_id;
					$pagoCosmetologa->saldo = $lacita->lineaServicio->precio * -1;
					$pagoCosmetologa->total_pago = $lacita->lineaServicio->precio_pago;
					$pagoCosmetologa->save();

					
				}
				else
				{
					if (($lacita->estado =="Fallida" or $lacita->estado =="Cancelada") and $lacita->contrato_id != NULL) //Regresar a Activo el tratamiento
					{
						//Buscar Detalle
						$detalleContrato = ContratoDetalle::model()->find("contrato_id = $lacita->contrato_id and linea_servicio_id = $lacita->linea_servicio_id and (estado = 'Programada' or estado = 'Activo')");
						//Saldo de Contrato
						$detalleContrato->estado = "Activo";
						$detalleContrato->update();
					}
				}

			}

				//Mensajes
				if ($lacita->estado =="Completada" and $lacita->omitir_seguimiento =="Si") {
					Yii::app()->user->setFlash('success',"La cita se ha completado.");	
				}else{
					if ($lacita->estado =="Completada") {
						Yii::app()->user->setFlash('success',"La cita se ha completado y el seguimiento se ha guardado.");	
					}
				}

				if ($lacita->estado =="Cancelada") {
					Yii::app()->user->setFlash('error',"La cita se ha cancelado y el seguimiento se ha guardado.");	
				}

				if ($lacita->estado =="Vencida") {
					Yii::app()->user->setFlash('warning',"La cita se ha Vencido y el seguimiento se ha guardado.");	
				}
				
				//Redireccionar
				if (isset($_GET['irCita'])) {
					$this->redirect(array('view','id'=>$lacita->id));
				}
				else
				{
					$this->render('calendario',array(
						'dataProvider'=>$dataProvider,
					));
				}

		}
		else
		{
			//Redireccionar
			if (isset($_GET['irCita'])) {
				$this->redirect(array('view','id'=>$lacita->id));
			}
			else
			{
				$this->render('calendario',array(
					'dataProvider'=>$dataProvider,
				));
			}
		}		
	}

	public function actionCitas()
	{
		$dataProvider=new CActiveDataProvider('Citas');
		$this->render('citas',array(
			'dataProvider'=>$dataProvider,
		));
	}

	//Actualizar Pago a cosmetologas
	public function actionPagoCosmetologa($id, $sumaIngresos)
	{
		//Verificar si el vendedor es el mismo de la cita
		$datosCita = Citas::model()->findByPk($id);
		$datosContratos = ContratoDetalle::model()->find("contrato_id = $datosCita->contrato_id and linea_servicio_id = $datosCita->linea_servicio_id");
		$misma_vendedora = "";
		$pagoTotal = 0;
		$saldo_paciente = 0;
		//Saldo de Contrato
		$saldoContrato = $datosContratos->contrato->saldo;

		//Ver costo de tratamientos realizados
		$saldo_tratamientos = 0;
		$saldo_tratamientos_descuento = 0;
		$tratamientosRealizados = ContratoDetalle::model()->findAll("contrato_id = $datosCita->contrato_id");
		foreach ($tratamientosRealizados as $tratamientos_realizados) 
		{
			$saldo_tratamientos = $saldo_tratamientos + ($tratamientos_realizados->vu * $tratamientos_realizados->realizadas);
			$saldo_tratamientos_descuento = $saldo_tratamientos_descuento + ($tratamientos_realizados->vu_desc * $tratamientos_realizados->realizadas);
		}

		//Actualizar Valores de saldo del paciente y contratos si los hay
		$hayPagos = PagoCosmetologas::model()->findAll("contrato_id = $datosCita->contrato_id");
		if ($hayPagos) 
		{
			foreach ($hayPagos as $hay_pagos) 
			{
				if ($saldoContrato == 0) {
					//$hay_pagos->saldo = 0;
					$hay_pagos->saldo = $sumaIngresos - $saldo_tratamientos_descuento;
				}
				else
				{
					$hay_pagos->saldo = $sumaIngresos - $saldo_tratamientos;
				}
				
				$hay_pagos->update();
			}
		}

		$pagoCosmetologa = new PagoCosmetologas;
		$pagoCosmetologa->n_identificacion = $datosCita->paciente->n_identificacion;
		$pagoCosmetologa->paciente_id = $datosCita->paciente_id;
		$pagoCosmetologa->linea_servicio_id = $datosCita->linea_servicio_id;
		$pagoCosmetologa->aprobo_id = Yii::app()->user->usuarioId;
		$pagoCosmetologa->vendedor_id = $datosContratos->contrato->vendedor_id;

		$pagoCosmetologa->cita_id = $datosCita->id;
		$pagoCosmetologa->contrato_id = $datosCita->contrato_id;
		$pagoCosmetologa->valor_tratamiento = $datosContratos->vu; //Corregir agregar columna
		$pagoCosmetologa->valor_tratamiento_desc = $datosContratos->vu_desc; //Corregir agregar columna

		if ($datosCita->personal_id == $datosContratos->contrato->vendedor_id) //Corregido
		{ 
			$pagoCosmetologa->misma_persona = "Si";
			$pagoCosmetologa->porcentaje = $datosCita->lineaServicio->porcentaje;
			$pagoCosmetologa->valor_comision = 0;
			//Calculo de Pago por porcentaje
			$pagoTotal = (($datosContratos->vu_desc / 1.16) - $datosContratos->lineaServicio->insumo) * ($datosContratos->lineaServicio->porcentaje / 100);
		}
		else
		{ 
			$pagoCosmetologa->misma_persona = "No";
			$pagoCosmetologa->valor_comision = $datosCita->lineaServicio->precio_pago;
			$pagoCosmetologa->porcentaje = 0;
			$pagoTotal = $datosContratos->lineaServicio->precio_pago;

		}
		$pagoCosmetologa->estado = "Activo";
		$pagoCosmetologa->descarga = "No";
		$pagoCosmetologa->fecha = date("Y-m-d H:i:s");
		$pagoCosmetologa->fecha_sola = date("Y-m-d");
		$pagoCosmetologa->sesion = $datosContratos->realizadas."/".$datosContratos->cantidad;
		$pagoCosmetologa->personal_id = $datosCita->personal_id;
		if ($saldoContrato == 0) {
			//$pagoCosmetologa->saldo = 0;
			$pagoCosmetologa->saldo = $sumaIngresos - $saldo_tratamientos_descuento;
		}
		else
		{
			$pagoCosmetologa->saldo = $sumaIngresos - $saldo_tratamientos;
		}
		$pagoCosmetologa->total_pago = $pagoTotal;
		$pagoCosmetologa->save();
		


	}
	

	// public function actionExportar()
	// {
	// 	$lafecha = Yii::app()->dateformatter->format("yyyy-MM-dd",$_GET['lafecha']);
	// 	$elpersonal = $_GET['elpersonal'];
	//     // Load data
	//     $model = Citas::model()->findAll("fecha_cita='$lafecha' and personal_id = $elpersonal");
	 
	//     // Export it
	//     $this->toExcel($model,
	//     	array(
 //            'paciente.nombreCompleto::Paciente',
 //            'paciente.celular::Celular',
 //            'personal.nombreCompleto::Personal',
 //            'lineaServicio.nombre::Linea de Servicio', // Note the custom header
 //            'fecha_cita',
 //            'horaInicio.hora::Hora de inicio',
 //            'horaFin.hora::Hora Fin',
 //            'comentario',
 //        ));
	// }


	public function actionExportarAgenda()
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

	public function actionFiltroContrato()
	{
		if ($_POST['elContrato'] == NULL) 
		{
			//$data=;	
			$data=CHtml::listData(LineaServicio::model()->findAll("estado = 'Activo' "),'id','nombre');
		}
		else
		{
			$numeroContrato = $_POST['elContrato'];
			//$data=ContratoDetalle::model()->findAll('contrato_id=:id', array(':id'=>(int) $_POST['elContrato']));	
			$data=ContratoDetalle::model()->findAll("(contrato_id=$numeroContrato and estado = 'Activo' and realizadas < cantidad) or (contrato_id=$numeroContrato and estado = 'Programada' and (realizadas < cantidad))");	
			$data=CHtml::listData($data,'linea_servicio_id','lineaServicio.nombre');
		}	
				
		
		 foreach($data as $value=>$name)
		 {
			 echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		 }
	}
}
