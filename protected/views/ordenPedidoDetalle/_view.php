<?php
/* @var $this OrdenPedidoDetalleController */
/* @var $data OrdenPedidoDetalle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orden_pedido_id')); ?>:</b>
	<?php echo CHtml::encode($data->orden_pedido_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_orden_pedido_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_orden_pedido_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
	<?php echo CHtml::encode($data->area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />


</div>