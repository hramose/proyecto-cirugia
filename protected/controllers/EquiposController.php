<?php

class EquiposController extends Controller
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

	public function behaviors()
    {
        return array(
            'eexcelview'=>array(
                'class'=>'ext.eexcelview.EExcelBehavior',
            ),
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'exportar', 'lineaServicio', 'eliminarLinea'),
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

	public function actionEliminarLinea($idEquipo, $idLinea)
	{
		$linea = EquiposLineaServicio::model()->find("equipo_id = ".$idEquipo. " and linea_servicio_id = ".$idLinea);
		if ($linea->delete()) {
			$this->redirect(array('view','id'=>$idEquipo));
		}
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Equipos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Equipos']))
		{
			$model->attributes=$_POST['Equipos'];
			$model->Estado = "Activo";
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionLineaServicio()
	{
		$model=new EquiposLineaServicio;
		$model->equipo_id = $_GET['idEquipo'];
		$model->linea_servicio_id = $_POST['EquiposLineaServicio']['linea_servicio_id'];

		//Nombre de equipo
		$nombreEquipo = Equipos::model()->findByPk($model->equipo_id);

		//Buscar linea de servicio en otro equipo
		$conteo = 0;
		$ListadoEquipos = Equipos::model()->findAll("nombre != '".$nombreEquipo->nombre."'");
		foreach ($ListadoEquipos as $listado_equipos) 
		{
			$temporal = EquiposLineaServicio::model()->findAll("equipo_id=".$listado_equipos->id. " and linea_servicio_id = ".$model->linea_servicio_id);
			if ($temporal) 
			{
				$conteo = $conteo + 1;
			}
		}

		if ($conteo > 0) 
		{
			Yii::app()->user->setFlash('error',"Esta linea de servicio ya esta vinculada a otro equipo.");
			$this->redirect(array('view','id'=>$model->equipo_id));
		}

		//Buscar si ya hay linea de Servicio Vinculada al equipo
		$hayLineaServicio = EquiposLineaServicio::model()->findAll("equipo_id=".$model->equipo_id." and linea_servicio_id = ".$model->linea_servicio_id);

		if($hayLineaServicio){
			Yii::app()->user->setFlash('error',"Esta linea de servicio ya esta vinculada al equipo.");
			$this->redirect(array('view','id'=>$model->equipo_id));
		}
		else
		{
			if ($model->save()) 
			{
				$this->redirect(array('view','id'=>$model->equipo_id));
			}	
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
				$criteria->addBetweenCondition('fecha_sola', $laFechaDesde, $laFechaHasta);
				$rows = Equipos::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = Equipos::model()->findAll();
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'nombre',
	            'numero',
	            'marca',
	            'Estado',
	        ));
	     }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new Equipos('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Equipos']))
				$model->attributes=$_GET['Equipos'];

			$this->render('admin',array(
				'model'=>$model,
			));
		}
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

		if(isset($_POST['Equipos']))
		{
			$model->attributes=$_POST['Equipos'];
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
		$dataProvider=new CActiveDataProvider('Equipos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Equipos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Equipos']))
			$model->attributes=$_GET['Equipos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Equipos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Equipos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Equipos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
