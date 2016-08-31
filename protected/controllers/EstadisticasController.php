<?php

class EstadisticasController extends Controller
{

	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
        );
    }

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionExportarPrimeraVisita()
	{
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['clave'] == $clave->super_usuario) 
		{

			if ($_POST['filtro'] == 1) 
			{
				$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
				$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

				$sql = "SELECT citas.id as cita, citas.fecha_cita, CONCAT(personal.nombres, ' ', personal.apellidos) as nombrepersonal, paciente.id as paciente, paciente.nombre, paciente.apellido, paciente.n_identificacion, contratos.id as contrato, contratos.total as ctotal, (contratos.total - contratos.saldo) as ingresos, contratos.estado from paciente inner join citas on citas.paciente_id = paciente.id inner join contratos on contratos.paciente_id = paciente.id inner join personal on personal.id = citas.personal_id where citas.linea_servicio_id = 5 and citas.fecha_cita between '$laFechaDesde' and '$laFechaHasta' and contratos.fecha >= citas.fecha_cita group by paciente order by citas.fecha_cita";

				// //$attribs = array('estado'=>'Activo');
				// $attribs = array();
				// $criteria = new CDbCriteria(array('order'=>'id DESC'));
				// $criteria->addBetweenCondition('fecha_cita', $laFechaDesde, $laFechaHasta);
				// $rows = Citas::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$sql = "SELECT citas.id as cita, citas.fecha_cita,  CONCAT(personal.nombres, ' ', personal.apellidos) as nombrepersonal, paciente.id as paciente, paciente.nombre, paciente.apellido, paciente.n_identificacion, contratos.id as contrato, contratos.total as ctotal, (contratos.total - contratos.saldo) as ingresos, contratos.estado from paciente inner join citas on citas.paciente_id = paciente.id inner join contratos on contratos.paciente_id = paciente.id inner join personal on personal.id = citas.personal_id where citas.linea_servicio_id = 5 and contratos.fecha >= citas.fecha_cita group by paciente order by citas.fecha_cita";
			}

			$rawData = Yii::app()->db->createCommand($sql);
			         
			        $model = new CSqlDataProvider($rawData, array( 
			                    'keyField' => 'cita', 
			                    'sort' => array(
			                        'attributes' => array(
			                            'cita'
			                        ),
			                        'defaultOrder' => array(
			                            'cita' => CSort::SORT_ASC, //default sort value
			                        ),
			                    ),
			                    'pagination' => array(
			                        'pageSize' => 9999999999,
			                    ),
			                ));
		    
		    // Export it
		    $this->toExcel($model,
		    	array(
	            'cita::num_cita',
	            'fecha_cita',
	            'nombrepersonal',
	            'nombre',
	            'apellido',
	            'n_identificacion',
	            'contrato::num_contrato',
	            'ctotal::total',
	            'ingresos',
	            'estado',
	        ));
		}
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$this->actionPrimeraVisita();
		}
		
	}


	public function actionExportarPrimeraVisitaNo()
	{
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['claveNo'] == $clave->super_usuario) 
		{

			if ($_POST['filtroNo'] == 1) 
			{
				$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
				$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

				$sql = "SELECT citas.id as cita, citas.linea_servicio_id, citas.fecha_cita, CONCAT(personal.nombres, ' ', personal.apellidos) as nombrepersonal, paciente.id as paciente, paciente.nombre, paciente.apellido, paciente.n_identificacion from paciente INNER join citas on citas.paciente_id = paciente.id inner join personal on personal.id = citas.personal_id where citas.linea_servicio_id = 5 and citas.estado = 'Completada' and citas.fecha_cita between '$laFechaDesde' and '$laFechaHasta' and paciente.id not in (select contratos.paciente_id from contratos) group by paciente order by citas.fecha_cita";

				// //$attribs = array('estado'=>'Activo');
				// $attribs = array();
				// $criteria = new CDbCriteria(array('order'=>'id DESC'));
				// $criteria->addBetweenCondition('fecha_cita', $laFechaDesde, $laFechaHasta);
				// $rows = Citas::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$sql = "SELECT citas.id as cita, citas.linea_servicio_id, citas.fecha_cita, CONCAT(personal.nombres, ' ', personal.apellidos) as nombrepersonal, paciente.id as paciente, paciente.nombre, paciente.apellido, paciente.n_identificacion from paciente INNER join citas on citas.paciente_id = paciente.id inner join personal on personal.id = citas.personal_id where citas.linea_servicio_id = 5 and citas.estado = 'Completada' and paciente.id not in (select contratos.paciente_id from contratos) group by paciente order by citas.fecha_cita";
			}

			$rawData = Yii::app()->db->createCommand($sql);
			         
			        $model = new CSqlDataProvider($rawData, array( 
			                    'keyField' => 'cita', 
			                    'sort' => array(
			                        'attributes' => array(
			                            'cita'
			                        ),
			                        'defaultOrder' => array(
			                            'cita' => CSort::SORT_ASC, //default sort value
			                        ),
			                    ),
			                    'pagination' => array(
			                        'pageSize' => 9999999999,
			                    ),
			                ));
		    
		    // Export it
		    $this->toExcel($model,
		    	array(
	            'cita::num_cita',
	            'fecha_cita',
	            'nombrepersonal',
	            'nombre',
	            'apellido',
	            'n_identificacion',
	        ));
		}
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$this->actionPrimeraVisita();
		}
		
	}

	public function actionPrimeraVisita()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT citas.id as cita, paciente.id as paciente, contratos.id as contrato, contratos.total as ctotal  from paciente inner join citas on citas.paciente_id = paciente.id inner join contratos on contratos.paciente_id = paciente.id inner join personal on personal.id = citas.personal_id where citas.linea_servicio_id = 5 group by paciente";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		$model = $dataReader->readAll();

		$connection = Yii::app()->db;
		$sql = "SELECT citas.id as cita from citas where citas.linea_servicio_id = 5 and citas.estado = 'Completada'";
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();
		$lascitas = $dataReader->readAll();

		// $connection = Yii::app()->db;
		// $sql = "SELECT sum(contratos.total) from paciente inner join citas on citas.paciente_id = paciente.id inner join contratos on contratos.paciente_id = paciente.id where citas.linea_servicio_id = 5";
		// $command = $connection->createCommand($sql);
		// $dataReader = $command->query();
		// $totalmodel = $dataReader->readAll();
		
		$this->render('1visita',array(
			'model'=>$model,
			'lascitas'=>$lascitas,
		));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}