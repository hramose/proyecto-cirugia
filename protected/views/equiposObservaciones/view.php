<?php
/* @var $this EquiposObservacionesController */
/* @var $model EquiposObservaciones */

$this->breadcrumbs=array(
	'Equipos Observaciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EquiposObservaciones', 'url'=>array('index')),
	array('label'=>'Create EquiposObservaciones', 'url'=>array('create')),
	array('label'=>'Update EquiposObservaciones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EquiposObservaciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EquiposObservaciones', 'url'=>array('admin')),
);
?>

<h1>View EquiposObservaciones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'equipo_id',
		'estado',
		'observacion',
		'fecha',
		'personal_id',
	),
)); ?>
