<?php
/* @var $this VentasDetalleController */
/* @var $model VentasDetalle */


$this->menu=array(
	array('label'=>'Buscar Relación de Productos', 'url'=>array('admin')),
);
?>

<h1>Relación de Productos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'venta_id',
		'producto.nombre_producto',
		'cantidad',
		'valor',
		'iva',
		'total',
	),
)); ?>
