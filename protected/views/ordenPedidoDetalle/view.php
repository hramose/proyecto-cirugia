<?php
/* @var $this OrdenPedidoDetalleController */
/* @var $model OrdenPedidoDetalle */

$this->breadcrumbs=array(
	'Orden Pedido Detalles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrdenPedidoDetalle', 'url'=>array('index')),
	array('label'=>'Create OrdenPedidoDetalle', 'url'=>array('create')),
	array('label'=>'Update OrdenPedidoDetalle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrdenPedidoDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrdenPedidoDetalle', 'url'=>array('admin')),
);
?>

<h1>View OrdenPedidoDetalle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'orden_pedido_id',
		'tipo_orden_pedido_id',
		'producto_id',
		'area',
		'cantidad',
	),
)); ?>
