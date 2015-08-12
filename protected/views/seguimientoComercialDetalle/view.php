<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $model SeguimientoComercialDetalle */

$this->breadcrumbs=array(
	'Seguimiento Comercial Detalles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SeguimientoComercialDetalle', 'url'=>array('index')),
	array('label'=>'Create SeguimientoComercialDetalle', 'url'=>array('create')),
	array('label'=>'Update SeguimientoComercialDetalle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SeguimientoComercialDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SeguimientoComercialDetalle', 'url'=>array('admin')),
);
?>

<h1>View SeguimientoComercialDetalle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_seguimiento',
		'seguimiento',
		'responsable_id',
	),
)); ?>
