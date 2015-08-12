<?php
/* @var $this TipoLineaServicioController */
/* @var $model TipoLineaServicio */

$this->menu=array(
	array('label'=>'Listar Tipo de Linea de Servicio', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Linea de Servicio', 'url'=>array('create')),
	array('label'=>'Actualizar Tipo de Linea de Servicio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Tipo de Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Tipo de Linea de Servicio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'estado',
	),
)); ?>
