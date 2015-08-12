<?php
/* @var $this PagoCosmetologasController */
/* @var $data PagoCosmetologas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cita_id')); ?>:</b>
	<?php echo CHtml::encode($data->cita_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('misma_persona')); ?>:</b>
	<?php echo CHtml::encode($data->misma_persona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_comision')); ?>:</b>
	<?php echo CHtml::encode($data->valor_comision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_tratamiento')); ?>:</b>
	<?php echo CHtml::encode($data->valor_tratamiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('descarga')); ?>:</b>
	<?php echo CHtml::encode($data->descarga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_pago')); ?>:</b>
	<?php echo CHtml::encode($data->total_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sesion')); ?>:</b>
	<?php echo CHtml::encode($data->sesion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_pago')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_pago); ?>
	<br />

	*/ ?>

</div>