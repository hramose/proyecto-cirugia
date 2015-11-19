<?php

class PagoCosmetologasController extends Controller
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
				'actions'=>array('create','update'),
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
		$model=new PagoCosmetologas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PagoCosmetologas']))
		{
			$model->attributes=$_POST['PagoCosmetologas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionExportar()
	{

		// $actualizarpago = PagoCosmetologas::model()->findAll();
		// foreach ($actualizarpago as $actualizar_pago) 
		// {
		// 	$actualizar_pago->fecha_sola = Yii::app()->dateformatter->format("yyyy-MM-dd",$actualizar_pago->fecha);
		// 	$actualizar_pago->update();
		// }
		$clave = Configuraciones::model()->findByPk(1);
		if ($_POST['clave'] == $clave->super_usuario) 
		{
			if ($_POST['filtro'] == 1) 
			{
				$laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
				$laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

				$attribs = array('estado'=>'Activo');
				$criteria = new CDbCriteria(array('order'=>'id DESC'));
				$criteria->addBetweenCondition('fecha', $laFechaDesde, $laFechaHasta);
				$rows = PagoCosmetologas::model()->findAllByAttributes($attribs, $criteria);
			}
			else
			{
				$rows = PagoCosmetologas::model()->findAll("estado = 'Activo'");
			}
		    
		    // Export it
		    $this->toExcel($rows,
		    	array(
	            'id::ID',
	            'paciente.nombreCompleto',
	            'n_identificacion::Cedula',
	            'lineaServicio.nombre',
	            'personal.nombreCompleto::Asistencial',
	            'contrato_id::Contrato',
	            'sesion::Sesion',
	            'fecha_sola',
	            'valor_tratamiento::Valor de Tratamiento',
	            'valor_tratamiento_desc::Tratamiento con Descuento',
	            'valor_comision::Valor Comisión',
	            'vendedor.nombreCompleto::Vendedor',
	            'aprobo.nombreCompleto::Establecio estado',
	            'total_pago::Total de Pago',
	            'saldo::Saldo a Favor',
	        ));
	       }
		else
		{
			Yii::app()->user->setFlash('error',"Clave incorrecta para realizar la exportación.");
			$model=new PagoCosmetologas('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['PagoCosmetologas']))
			{
				$model->attributes=$_GET['PagoCosmetologas'];
			}
			$this->layout='main';

			$loPagos = PagoCosmetologas::model()->count();
			
			if ($loPagos == 0) {
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

		if(isset($_POST['PagoCosmetologas']))
		{
			$model->attributes=$_POST['PagoCosmetologas'];
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
		$dataProvider=new CActiveDataProvider('PagoCosmetologas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PagoCosmetologas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PagoCosmetologas']))
		{
			$model->attributes=$_GET['PagoCosmetologas'];
		}
		$this->layout='main';

		$loPagos = PagoCosmetologas::model()->count();
		
		if ($loPagos == 0) {
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
	 * @return PagoCosmetologas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PagoCosmetologas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PagoCosmetologas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pago-cosmetologas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
