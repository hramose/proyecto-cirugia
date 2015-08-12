<?php
/* @var $this HistorialTablaMedidasController */
/* @var $data HistorialTablaMedidas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cita_id')); ?>:</b>
	<?php echo CHtml::encode($data->cita_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imc')); ?>:</b>
	<?php echo CHtml::encode($data->imc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('busto')); ?>:</b>
	<?php echo CHtml::encode($data->busto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contorno')); ?>:</b>
	<?php echo CHtml::encode($data->contorno); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cintura')); ?>:</b>
	<?php echo CHtml::encode($data->cintura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umbilical')); ?>:</b>
	<?php echo CHtml::encode($data->umbilical); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abd_inferior')); ?>:</b>
	<?php echo CHtml::encode($data->abd_inferior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abd_superior')); ?>:</b>
	<?php echo CHtml::encode($data->abd_superior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cadera')); ?>:</b>
	<?php echo CHtml::encode($data->cadera); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('piernas')); ?>:</b>
	<?php echo CHtml::encode($data->piernas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('muslo_derecho')); ?>:</b>
	<?php echo CHtml::encode($data->muslo_derecho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('muslo_izquierdo')); ?>:</b>
	<?php echo CHtml::encode($data->muslo_izquierdo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brazo_derecho')); ?>:</b>
	<?php echo CHtml::encode($data->brazo_derecho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brazo_izquierdo')); ?>:</b>
	<?php echo CHtml::encode($data->brazo_izquierdo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	*/ ?>

</div>