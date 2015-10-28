<?php
/* @var $this ConfiguracionesController */
/* @var $model Configuraciones */

$this->breadcrumbs=array(
	'Configuraciones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Configuraciones', 'url'=>array('index')),
	array('label'=>'Manage Configuraciones', 'url'=>array('admin')),
);
?>

<h1>Create Configuraciones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>