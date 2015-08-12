<?php
/* @var $this EquiposObservacionesController */
/* @var $model EquiposObservaciones */

$this->breadcrumbs=array(
	'Equipos Observaciones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EquiposObservaciones', 'url'=>array('index')),
	array('label'=>'Create EquiposObservaciones', 'url'=>array('create')),
	array('label'=>'View EquiposObservaciones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EquiposObservaciones', 'url'=>array('admin')),
);
?>

<h1>Update EquiposObservaciones <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>