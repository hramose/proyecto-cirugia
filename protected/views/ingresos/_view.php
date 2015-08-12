<?php
/* @var $this IngresosController */
/* @var $data Ingresos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contrato_id')); ?>:</b>
	<?php echo CHtml::encode($data->contrato_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('centro_costo_id')); ?>:</b>
	<?php echo CHtml::encode($data->centro_costo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pago')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pago); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cheques_cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cheques_cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cheques_banco_cuenta_id')); ?>:</b>
	<?php echo CHtml::encode($data->cheques_banco_cuenta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cheques_total')); ?>:</b>
	<?php echo CHtml::encode($data->cheques_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarjeta_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tarjeta_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarjeta_aprobacion')); ?>:</b>
	<?php echo CHtml::encode($data->tarjeta_aprobacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarjeta_entidad')); ?>:</b>
	<?php echo CHtml::encode($data->tarjeta_entidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarjeta_banco_cuenta_id')); ?>:</b>
	<?php echo CHtml::encode($data->tarjeta_banco_cuenta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consigna_banco_o')); ?>:</b>
	<?php echo CHtml::encode($data->consigna_banco_o); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consigna_cuenta_o')); ?>:</b>
	<?php echo CHtml::encode($data->consigna_cuenta_o); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consigna_banco_d_cuenta_id')); ?>:</b>
	<?php echo CHtml::encode($data->consigna_banco_d_cuenta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	*/ ?>

</div>