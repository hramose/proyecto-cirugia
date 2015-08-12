<?php
/* @var $this ProductoReferenciaController */
/* @var $model ProductoReferencia */

$this->menu=array(
	array('label'=>'Listar Referencia de Producto', 'url'=>array('index')),
	array('label'=>'Crear Referencia de Producto', 'url'=>array('create')),
	array('label'=>'Actualizar Referencia de Producto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Referencia de Producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Referencia de Producto', 'url'=>array('admin')),
);
?>

<h1>Referencia de Producto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'referencia',
	),
)); ?>
