<?php
/* @var $this CitasEquipoController */
/* @var $model CitasEquipo */

$this->breadcrumbs=array(
	'Citas Equipos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CitasEquipo', 'url'=>array('index')),
	array('label'=>'Manage CitasEquipo', 'url'=>array('admin')),
);
?>

<h1>Create CitasEquipo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>