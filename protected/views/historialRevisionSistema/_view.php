<?php
/* @var $this HistorialRevisionSistemaController */
/* @var $data HistorialRevisionSistema */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_c_c')); ?>:</b>
	<?php echo CHtml::encode($data->c_c_c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cardio_respiratorio')); ?>:</b>
	<?php echo CHtml::encode($data->cardio_respiratorio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sistema_digestivo')); ?>:</b>
	<?php echo CHtml::encode($data->sistema_digestivo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sistema_genitoUrinario')); ?>:</b>
	<?php echo CHtml::encode($data->sistema_genitoUrinario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sistema_locomotor')); ?>:</b>
	<?php echo CHtml::encode($data->sistema_locomotor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sistema_nervioso')); ?>:</b>
	<?php echo CHtml::encode($data->sistema_nervioso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sistema_tegumentario')); ?>:</b>
	<?php echo CHtml::encode($data->sistema_tegumentario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	*/ ?>

</div>