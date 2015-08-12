<?php
/* @var $this TratamientoInteresController */
/* @var $model TratamientoInteres */

$this->menu=array(
	array('label'=>'Listar Tratamientos de Interes', 'url'=>array('index')),
	array('label'=>'Crear Tratamientos de Interes', 'url'=>array('create')),
	array('label'=>'Actualizar Tratamientos de Interes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Tratamientos de Interes', 'url'=>array('admin')),
);
?>

<h1>Tratamiento de Interes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'estado',
		'mostrar',
	),
)); ?>
