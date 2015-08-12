<?php
/* @var $this CajaEfectivoController */
/* @var $model CajaEfectivo */

$this->breadcrumbs=array(
	'Caja Efectivos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CajaEfectivo', 'url'=>array('index')),
	array('label'=>'Manage CajaEfectivo', 'url'=>array('admin')),
);
?>

<h1>Create CajaEfectivo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>