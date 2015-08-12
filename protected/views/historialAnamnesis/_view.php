<?php
/* @var $this HistorialAnamnesisController */
/* @var $data HistorialAnamnesis */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo_consulta')); ?>:</b>
	<?php echo CHtml::encode($data->motivo_consulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enfermedad_actual')); ?>:</b>
	<?php echo CHtml::encode($data->enfermedad_actual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_patologico')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_patologico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_quirurgico')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_quirurgico); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_alergico')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_alergico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_traumatico')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_traumatico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_medicamento')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_medicamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_ginecologico')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_ginecologico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_fum')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_fum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_habitos')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_habitos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_familiares')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_familiares); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('antecedente_nutricionales')); ?>:</b>
	<?php echo CHtml::encode($data->antecedente_nutricionales); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones_paciente')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones_paciente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	*/ ?>

</div>