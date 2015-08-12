<?php
/* @var $this OrdenPedidoController */
/* @var $data OrdenPedido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_entrega_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_entrega_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_recibe_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_recibe_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observacion')); ?>:</b>
	<?php echo CHtml::encode($data->observacion); ?>
	<br />


</div>