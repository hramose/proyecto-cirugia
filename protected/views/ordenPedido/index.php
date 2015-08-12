<?php
/* @var $this OrdenPedidoController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Orden de Pedido', 'url'=>array('create')),
	array('label'=>'Buscar Orden de Pedido', 'url'=>array('admin')),
);
?>

<h1>Orden de Pedidos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
