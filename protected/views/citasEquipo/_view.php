<?php
/* @var $this CitasEquipoController */
/* @var $data CitasEquipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cita_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cita_id), array('view', 'id'=>$data->cita_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->hora_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_fin')); ?>:</b>
	<?php echo CHtml::encode($data->hora_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('equipo_id')); ?>:</b>
	<?php echo CHtml::encode($data->equipo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('linea_servicio_id')); ?>:</b>
	<?php echo CHtml::encode($data->linea_servicio_id); ?>
	<br />


</div>