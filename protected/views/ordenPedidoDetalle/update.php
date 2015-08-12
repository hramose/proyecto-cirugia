<?php
/* @var $this OrdenPedidoDetalleController */
/* @var $model OrdenPedidoDetalle */

$this->breadcrumbs=array(
	'Orden Pedido Detalles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrdenPedidoDetalle', 'url'=>array('index')),
	array('label'=>'Create OrdenPedidoDetalle', 'url'=>array('create')),
	array('label'=>'View OrdenPedidoDetalle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrdenPedidoDetalle', 'url'=>array('admin')),
);
?>

<h1>Update OrdenPedidoDetalle <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>