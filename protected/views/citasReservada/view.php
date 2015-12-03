<?php
/* @var $this CitasReservadaController */
/* @var $model CitasReservada */

$this->breadcrumbs=array(
	'Citas Reservadas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CitasReservada', 'url'=>array('index')),
	array('label'=>'Create CitasReservada', 'url'=>array('create')),
	array('label'=>'Update CitasReservada', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CitasReservada', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CitasReservada', 'url'=>array('admin')),
);
?>

<h1>View CitasReservada #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'personal_id',
		'cita_id',
		'hora_inicio',
		'hora_fin',
		'fecha_inicio',
		'fecha_fin',
		'motivo',
		'observacon',
		'usuario_id',
		'fecha_creado',
	),
)); ?>
