<?php
/* @var $this PacienteOrdenController */
/* @var $model PacienteOrden */


$this->menu=array(
	array('label'=>'Listar Ordenes de Pacientes', 'url'=>array('index')),
	array('label'=>'Actualizar Orden de Pacientes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Orden de Paciente', 'url'=>array('admin')),
);
?>

<h1>Orden de Paciente #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paciente_id',
		'observaciones',
		'vendedor',
		'estado',
		'abierto_cerrado',
		'fecha',
		'responsable',
	),
)); ?>
