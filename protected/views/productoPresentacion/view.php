<?php
/* @var $this ProductoPresentacionController */
/* @var $model ProductoPresentacion */

$this->menu=array(
	array('label'=>'Listar ProductoPresentacion', 'url'=>array('index')),
	array('label'=>'Crear ProductoPresentacion', 'url'=>array('create')),
	array('label'=>'Actualizar ProductoPresentacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar ProductoPresentacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar ProductoPresentacion', 'url'=>array('admin')),
);
?>

<h1>Presentación de Producto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'presentacion',
	),
)); ?>
