<?php
/* @var $this HistorialExamenFisicoController */
/* @var $data HistorialExamenFisico */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnostico_principal_id')); ?>:</b>
	<?php echo CHtml::encode($data->diagnostico_principal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnostico_relacionado_id')); ?>:</b>
	<?php echo CHtml::encode($data->diagnostico_relacionado_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altura')); ?>:</b>
	<?php echo CHtml::encode($data->altura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imc')); ?>:</b>
	<?php echo CHtml::encode($data->imc); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	*/ ?>

</div>