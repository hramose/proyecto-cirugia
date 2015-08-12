<?php
/* @var $this HojaGastosCirugiaController */
/* @var $data HojaGastosCirugia */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_cirugia')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_cirugia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sala')); ?>:</b>
	<?php echo CHtml::encode($data->sala); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_paciente')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_paciente); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_anestesia')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_anestesia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_cirugia')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_cirugia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cirugia')); ?>:</b>
	<?php echo CHtml::encode($data->cirugia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cirugia_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->cirugia_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->hora_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_inicio_cirugia')); ?>:</b>
	<?php echo CHtml::encode($data->hora_inicio_cirugia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_final_cirugia')); ?>:</b>
	<?php echo CHtml::encode($data->hora_final_cirugia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cirujano_id')); ?>:</b>
	<?php echo CHtml::encode($data->cirujano_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ayudante_id')); ?>:</b>
	<?php echo CHtml::encode($data->ayudante_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anestesiologo_id')); ?>:</b>
	<?php echo CHtml::encode($data->anestesiologo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rotadora_id')); ?>:</b>
	<?php echo CHtml::encode($data->rotadora_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('instrumentadora_id')); ?>:</b>
	<?php echo CHtml::encode($data->instrumentadora_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_productos')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_productos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	*/ ?>

</div>