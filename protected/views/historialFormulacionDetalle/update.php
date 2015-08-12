<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $model HistorialFormulacionDetalle */

$this->breadcrumbs=array(
	'Historial Formulacion Detalles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistorialFormulacionDetalle', 'url'=>array('index')),
	array('label'=>'Create HistorialFormulacionDetalle', 'url'=>array('create')),
	array('label'=>'View HistorialFormulacionDetalle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HistorialFormulacionDetalle', 'url'=>array('admin')),
);
?>

<h1>Update HistorialFormulacionDetalle <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>