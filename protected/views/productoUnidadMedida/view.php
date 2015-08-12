<?php
/* @var $this ProductoUnidadMedidaController */
/* @var $model ProductoUnidadMedida */

$this->menu=array(
	array('label'=>'Listar Unidad de Medida', 'url'=>array('index')),
	array('label'=>'Crear Unidad de Medida', 'url'=>array('create')),
	array('label'=>'Actualizar Unidad de Medida', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Unidad de Medida', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Unidad de Medida', 'url'=>array('admin')),
);
?>

<h1>Unidad de Medida #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'medida',
		'corto',
	),
)); ?>
