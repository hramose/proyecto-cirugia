<?php
/* @var $this PacienteSucesosController */
/* @var $model PacienteSucesos */

$this->breadcrumbs=array(
	'Paciente Sucesoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PacienteSucesos', 'url'=>array('index')),
	array('label'=>'Manage PacienteSucesos', 'url'=>array('admin')),
);
?>

<h1>Create PacienteSucesos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>