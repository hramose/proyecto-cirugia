<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $data HistorialFormulacionDetalle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formulacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->formulacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otra_formulacion')); ?>:</b>
	<?php echo CHtml::encode($data->otra_formulacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formulacion')); ?>:</b>
	<?php echo CHtml::encode($data->formulacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('historial_formulacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->historial_formulacion_id); ?>
	<br />


</div>