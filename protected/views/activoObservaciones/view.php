<?php
/* @var $this ActivoObservacionesController */
/* @var $model ActivoObservaciones */

$this->breadcrumbs=array(
	'Activo Observaciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ActivoObservaciones', 'url'=>array('index')),
	array('label'=>'Create ActivoObservaciones', 'url'=>array('create')),
	array('label'=>'Update ActivoObservaciones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ActivoObservaciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ActivoObservaciones', 'url'=>array('admin')),
);
?>

<h1>View ActivoObservaciones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'activo_inventario_id',
		'estado',
		'observacion',
		'fecha',
		'personal_id',
	),
)); ?>
