<?php
/* @var $this ActivoObservacionesController */
/* @var $model ActivoObservaciones */

$this->breadcrumbs=array(
	'Activo Observaciones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ActivoObservaciones', 'url'=>array('index')),
	array('label'=>'Manage ActivoObservaciones', 'url'=>array('admin')),
);
?>

<h1>Create ActivoObservaciones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>