<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $model HistorialFormulacionDetalle */

$this->breadcrumbs=array(
	'Historial Formulacion Detalles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List HistorialFormulacionDetalle', 'url'=>array('index')),
	array('label'=>'Create HistorialFormulacionDetalle', 'url'=>array('create')),
	array('label'=>'Update HistorialFormulacionDetalle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete HistorialFormulacionDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistorialFormulacionDetalle', 'url'=>array('admin')),
);
?>

<h1>View HistorialFormulacionDetalle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'formulacion_id',
		'otra_formulacion',
		'formulacion',
		'historial_formulacion_id',
	),
)); ?>
