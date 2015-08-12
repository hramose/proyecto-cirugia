<?php
/* @var $this TreatmentInterestController */
/* @var $model TreatmentInterest */

$this->breadcrumbs=array(
	'Treatment Interests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TreatmentInterest', 'url'=>array('index')),
	array('label'=>'Manage TreatmentInterest', 'url'=>array('admin')),
);
?>

<h1>Create TreatmentInterest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>