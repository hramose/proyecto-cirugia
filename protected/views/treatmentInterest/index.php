<?php
/* @var $this TreatmentInterestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Treatment Interests',
);

$this->menu=array(
	array('label'=>'Create TreatmentInterest', 'url'=>array('create')),
	array('label'=>'Manage TreatmentInterest', 'url'=>array('admin')),
);
?>

<h1>Treatment Interests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
