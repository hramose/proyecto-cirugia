<?php
/* @var $this PacienteSucesosController */
/* @var $model PacienteSucesos */

$this->menu=array(
	array('label'=>'List PacienteSucesos', 'url'=>array('index')),
	array('label'=>'Create PacienteSucesos', 'url'=>array('create')),
	array('label'=>'Update PacienteSucesos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PacienteSucesos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PacienteSucesos', 'url'=>array('admin')),
);
?>

<h1>View PacienteSucesos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paciente_id',
		'suceso',
		'fecha',
		'hora',
		'usuario_id',
	),
)); ?>
