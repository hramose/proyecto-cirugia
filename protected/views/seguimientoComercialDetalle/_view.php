<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $data SeguimientoComercialDetalle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_seguimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_seguimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seguimiento')); ?>:</b>
	<?php echo CHtml::encode($data->seguimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable_id')); ?>:</b>
	<?php echo CHtml::encode($data->responsable_id); ?>
	<br />


</div>