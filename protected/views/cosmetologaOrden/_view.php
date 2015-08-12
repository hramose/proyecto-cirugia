<?php
/* @var $this CosmetologaOrdenController */
/* @var $data CosmetologaOrden */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contrato_detalle_id')); ?>:</b>
	<?php echo CHtml::encode($data->contrato_detalle_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sesion')); ?>:</b>
	<?php echo CHtml::encode($data->sesion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cosmetologa_id')); ?>:</b>
	<?php echo CHtml::encode($data->cosmetologa_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_servicio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_servicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_pago')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_pago); ?>
	<br />


</div>