<?php
/* @var $this TreatmentInterestController */
/* @var $model TreatmentInterest */

$this->breadcrumbs=array(
	'Treatment Interests'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TreatmentInterest', 'url'=>array('index')),
	array('label'=>'Create TreatmentInterest', 'url'=>array('create')),
	array('label'=>'View TreatmentInterest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TreatmentInterest', 'url'=>array('admin')),
);
?>

<h1>Update TreatmentInterest <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>