<?php
/* @var $this PacienteBaulController */
/* @var $model PacienteBaul */

$this->breadcrumbs=array(
	'Paciente Bauls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PacienteBaul', 'url'=>array('index')),
	array('label'=>'Create PacienteBaul', 'url'=>array('create')),
	array('label'=>'Update PacienteBaul', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PacienteBaul', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PacienteBaul', 'url'=>array('admin')),
);
?>

<h1>View PacienteBaul #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paciente_id',
		'detalle',
		'personal_id',
		'fecha',
	),
)); ?>
