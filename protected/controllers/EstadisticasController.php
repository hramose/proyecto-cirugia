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
		$sql = "SELECT citas.id as cita, paciente.id as paciente, paciente.nombre, paciente.apellido, paciente.n_identificacion, contratos.id as contrato, contratos.total as ctotal from paciente inner join citas on citas.paciente_id = paciente.id inner join contratos on contratos.paciente_id = paciente.id where citas.linea_servicio_id = 5 group by paciente";

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
 

		$this->toExcel($model,
		    	array(
	            'cita::num_cita',
	            'nombre',
	            'apellido',
	            'n_identificacion',
	            'contrato::num_contrato',
	            'ctotal::total',
	        ));
	}

	public function actionPrimeraVisita()
	{
		$connection = Yii::app()->db;
		$sql = "SELECT citas.id as cita, paciente.id as paciente, contratos.id as contrato, contratos.total as ctotal  from paciente inner join citas on citas.paciente_id = paciente.id inner join contratos on contratos.paciente_id = paciente.id where citas.linea_servicio_id = 5 group by paciente";
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