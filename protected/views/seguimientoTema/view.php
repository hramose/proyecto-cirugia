<?php
/* @var $this SeguimientoTemaController */
/* @var $model SeguimientoTema */

$this->menu=array(
	array('label'=>'Listar Temas de Seguimiento', 'url'=>array('index')),
	array('label'=>'Crear Tema de Seguimiento', 'url'=>array('create')),
	array('label'=>'Actualizar Tema de Seguimiento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Tema de Seguimiento', 'url'=>array('admin')),
);
?>

<h1>Tema de Seguimiento #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'estado',
	),
)); ?>
