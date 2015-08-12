<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $model HistorialFormulacionDetalle */

$this->breadcrumbs=array(
	'Historial Formulacion Detalles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistorialFormulacionDetalle', 'url'=>array('index')),
	array('label'=>'Manage HistorialFormulacionDetalle', 'url'=>array('admin')),
);
?>

<h1>Create HistorialFormulacionDetalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>