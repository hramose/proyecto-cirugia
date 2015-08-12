<?php
/* @var $this ProductoRetencionesController */
/* @var $data ProductoRetenciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retencion')); ?>:</b>
	<?php echo CHtml::encode($data->retencion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_retener')); ?>:</b>
	<?php echo CHtml::encode($data->a_retener); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base')); ?>:</b>
	<?php echo CHtml::encode($data->base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->porcentaje); ?>
	<br />


</div>