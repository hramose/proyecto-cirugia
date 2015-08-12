<?php
class ProveedorController extends Controller
{
/**
* @return array action filters
*/
public function filters()
{
	return array(
	'accessControl',
	'ajaxOnly -uploadFile'
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
		array('allow',
		'actions'=>array('buscarProveedor'),
		'users'=>array('*'),
		),
		array('deny', // deny all users
		'users'=>array('*'),
		),
	);
}
/**
* @return array actions
*/
public function actions()
{
return array(
	'buscarProveedor'=>array(
	'class'=>'ext.actions.XSuggestAction',
	'modelName'=>'ProductoProveedor',
	'methodName'=>'suggest',
	),

);


}
/**
* Displays list on persons that have same firstname as person with given id
*/
public function actionListPersonsWithSameFirstname()
{
if(isset($_GET['id']))
$model=Person::model()->findbyPk($_GET['id']);
if($model!==null)
{
$models=Person::model()->findAll("firstname='{$model->firstname}'");
$data=array();
foreach($models as $model)
$data[] = $model->fullname;
echo Yii::t('ui','Persons with same firstname: ').implode(', ', $data);
}
}
}