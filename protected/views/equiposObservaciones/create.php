<?php
/* @var $this EquiposObservacionesController */
/* @var $model EquiposObservaciones */

$this->breadcrumbs=array(
	'Equipos Observaciones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EquiposObservaciones', 'url'=>array('index')),
	array('label'=>'Manage EquiposObservaciones', 'url'=>array('admin')),
);
?>

<h1>Create EquiposObservaciones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>