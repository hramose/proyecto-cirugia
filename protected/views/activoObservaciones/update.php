<?php
/* @var $this ActivoObservacionesController */
/* @var $model ActivoObservaciones */

$this->breadcrumbs=array(
	'Activo Observaciones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ActivoObservaciones', 'url'=>array('index')),
	array('label'=>'Create ActivoObservaciones', 'url'=>array('create')),
	array('label'=>'View ActivoObservaciones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ActivoObservaciones', 'url'=>array('admin')),
);
?>

<h1>Update ActivoObservaciones <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>