<?php
/* @var $this HistorialEvaluacionCosmetologicaController */
/* @var $data HistorialEvaluacionCosmetologica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cita_id')); ?>:</b>
	<?php echo CHtml::encode($data->cita_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluacion')); ?>:</b>
	<?php echo CHtml::encode($data->evaluacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />


</div>