<?php
/* @var $this OrdenPedidoController */
/* @var $model OrdenPedido */


$this->menu=array(
	array('label'=>'Listar Orden de Pedido', 'url'=>array('index')),
	array('label'=>'Crear Orden de Pedido', 'url'=>array('create')),
	array('label'=>'Ver Orden de Pedido', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Orden de Pedido', 'url'=>array('admin')),
);
?>

<h1>Actualizar Orden de Pedido <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>