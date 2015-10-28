<?php
/* @var $this ConfiguracionesController */
/* @var $model Configuraciones */

$this->breadcrumbs=array(
	'Configuraciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Configuraciones', 'url'=>array('index')),
	array('label'=>'Create Configuraciones', 'url'=>array('create')),
	array('label'=>'Update Configuraciones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Configuraciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Configuraciones', 'url'=>array('admin')),
);
?>

<h1>View Configuraciones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'super_usuario',
	),
)); ?>
