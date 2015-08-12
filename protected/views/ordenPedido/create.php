<?php
/* @var $this OrdenPedidoController */
/* @var $model OrdenPedido */

$this->menu=array(
	//array('label'=>'Listar Orden de Pedidos', 'url'=>array('index')),
	array('label'=>'Buscar Orden de Pedidos', 'url'=>array('admin')),
);
?>

<h1>Crear Orden de Pedido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>