<?php
/* @var $this OrdenPedidoDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orden Pedido Detalles',
);

$this->menu=array(
	array('label'=>'Create OrdenPedidoDetalle', 'url'=>array('create')),
	array('label'=>'Manage OrdenPedidoDetalle', 'url'=>array('admin')),
);
?>

<h1>Orden Pedido Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
