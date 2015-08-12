<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $model SeguimientoComercialDetalle */

$this->breadcrumbs=array(
	'Seguimiento Comercial Detalles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SeguimientoComercialDetalle', 'url'=>array('index')),
	array('label'=>'Manage SeguimientoComercialDetalle', 'url'=>array('admin')),
);
?>

<h1>Create SeguimientoComercialDetalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>