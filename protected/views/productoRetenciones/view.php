<?php
/* @var $this ProductoRetencionesController */
/* @var $model ProductoRetenciones */

$this->menu=array(
	array('label'=>'Listar Retenciones', 'url'=>array('index')),
	array('label'=>'Crear Retenciones', 'url'=>array('create')),
	array('label'=>'Actualizar Retenciones', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Retenciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Retenciones', 'url'=>array('admin')),
);
?>

<h1>Retenciones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'retencion',
		'a_retener',
		'base',
		'porcentaje',
	),
)); ?>
