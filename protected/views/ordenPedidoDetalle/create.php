<?php
/* @var $this OrdenPedidoDetalleController */
/* @var $model OrdenPedidoDetalle */

$this->breadcrumbs=array(
	'Orden Pedido Detalles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrdenPedidoDetalle', 'url'=>array('index')),
	array('label'=>'Manage OrdenPedidoDetalle', 'url'=>array('admin')),
);
?>

<h1>Create OrdenPedidoDetalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>