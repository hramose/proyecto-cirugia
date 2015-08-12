<?php

class CuentasXcController extends Controller
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
		$model=new CuentasXc;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CuentasXc']))
		{
			$model->attributes=$_POST['CuentasXc'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionExportar()
	{
		if ($_POST['filtro'] == 1) 
		{
			// $laFechaDesde = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_desde']);
			// $laFechaHasta = Yii::app()->dateformatter->format("yyyy-MM-dd",$_POST['fecha_hasta']);

			// $attribs = array('estado'=>'Activo');
			// $criteria = new CDbCriteria(array('order'=>'id DESC'));
			// $criteria->addBetweenCondition('fecha_sola', $laFechaDesde, $laFechaHasta);
			// $rows = Egresos::model()->findAllByAttributes($attribs, $criteria);
		}
		else
		{
			$rows = CuentasXc::model()->findAll("saldo > 0");
		}
	    
	    // Export it
	    $this->toExcel($rows,
	    	array(
            'id::ID',
            'paciente.nombreCompleto',
            'n_identificacion',
            'saldo',
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

		if(isset($_POST['CuentasXc']))
		{
			$model->attributes=$_POST['CuentasXc'];
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
		$dataProvider=new CActiveDataProvider('CuentasXc');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CuentasXc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CuentasXc']))
		{
			$model->attributes=$_GET['CuentasXc'];
			$model->saldo > 0;
		}

		$lasCuentas = CuentasXc::model()->count();
		
	
		$criteria = new CDbCriteria;
		$criteria->select='SUM(saldo) as lasuma';
		//$criteria->condition='id > 0';
		$sumaSaldo = CuentasXc::model()->find($criteria);

		$lasuma = Yii::app()->db->createCommand("SELECT SUM(`saldo`) as `sum` FROM `cuentas_xc` WHERE 1")->queryScalar();

		//$lasumas = $lasuma * -1;
		if ($lasCuentas == 0 or $lasuma == 0) {
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
	 * @return CuentasXc the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CuentasXc::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CuentasXc $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cuentas-xc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
