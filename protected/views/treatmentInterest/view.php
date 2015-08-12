<?php
/* @var $this TreatmentInterestController */
/* @var $model TreatmentInterest */

$this->breadcrumbs=array(
	'Treatment Interests'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TreatmentInterest', 'url'=>array('index')),
	array('label'=>'Create TreatmentInterest', 'url'=>array('create')),
	array('label'=>'Update TreatmentInterest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TreatmentInterest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TreatmentInterest', 'url'=>array('admin')),
);
?>

<h1>View TreatmentInterest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'status',
		'mostrar',
	),
)); ?>
