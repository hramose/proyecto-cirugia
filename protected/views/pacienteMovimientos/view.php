<?php
/* @var $this PacienteMovimientosController */
/* @var $model PacienteMovimientos */

$this->breadcrumbs=array(
	'Paciente Movimientoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PacienteMovimientos', 'url'=>array('index')),
	array('label'=>'Create PacienteMovimientos', 'url'=>array('create')),
	array('label'=>'Update PacienteMovimientos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PacienteMovimientos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PacienteMovimientos', 'url'=>array('admin')),
);
?>

<h1>View PacienteMovimientos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paciente_id',
		'valor',
		'tipo',
		'sub_tipo',
		'descripcion',
		'usuario_id',
		'fecha',
	),
)); ?>
