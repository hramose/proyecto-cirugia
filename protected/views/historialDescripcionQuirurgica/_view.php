<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $data HistorialDescripcionQuirurgica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servicio')); ?>:</b>
	<?php echo CHtml::encode($data->servicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnostico_preoperatorio')); ?>:</b>
	<?php echo CHtml::encode($data->diagnostico_preoperatorio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diagnostico_posoperatorio')); ?>:</b>
	<?php echo CHtml::encode($data->diagnostico_posoperatorio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cirujano_id')); ?>:</b>
	<?php echo CHtml::encode($data->cirujano_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ayudante_id')); ?>:</b>
	<?php echo CHtml::encode($data->ayudante_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('anestesiologo_id')); ?>:</b>
	<?php echo CHtml::encode($data->anestesiologo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inst_quirurgico_id')); ?>:</b>
	<?php echo CHtml::encode($data->inst_quirurgico_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_cirugia')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_cirugia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->hora_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_final')); ?>:</b>
	<?php echo CHtml::encode($data->hora_final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_cups')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_cups); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intervencion')); ?>:</b>
	<?php echo CHtml::encode($data->intervencion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('control_compresas')); ?>:</b>
	<?php echo CHtml::encode($data->control_compresas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_anestesia')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_anestesia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_hallazgos')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_hallazgos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	*/ ?>

</div>