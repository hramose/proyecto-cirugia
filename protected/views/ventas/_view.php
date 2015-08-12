<?php
/* @var $this VentasController */
/* @var $data Ventas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_total')); ?>:</b>
	<?php echo CHtml::encode($data->sub_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_iva')); ?>:</b>
	<?php echo CHtml::encode($data->total_iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento')); ?>:</b>
	<?php echo CHtml::encode($data->descuento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_tipo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_valor')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_total')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cant_productos')); ?>:</b>
	<?php echo CHtml::encode($data->cant_productos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_orden')); ?>:</b>
	<?php echo CHtml::encode($data->total_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pago')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dinero_recibido')); ?>:</b>
	<?php echo CHtml::encode($data->dinero_recibido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dinero_cambio')); ?>:</b>
	<?php echo CHtml::encode($data->dinero_cambio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_venta')); ?>:</b>
	<?php echo CHtml::encode($data->total_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credito_dias')); ?>:</b>
	<?php echo CHtml::encode($data->credito_dias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credito_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->credito_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cheques_cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cheques_cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cheques_cuenta_banco')); ?>:</b>
	<?php echo CHtml::encode($data->cheques_cuenta_banco); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarjeta_cuenta_banco')); ?>:</b>
	<?php echo CHtml::encode($data->tarjeta_cuenta_banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consignacion_cuenta_banco')); ?>:</b>
	<?php echo CHtml::encode($data->consignacion_cuenta_banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consignacion_banco')); ?>:</b>
	<?php echo CHtml::encode($data->consignacion_banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consignacion_cuenta')); ?>:</b>
	<?php echo CHtml::encode($data->consignacion_cuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal')); ?>:</b>
	<?php echo CHtml::encode($data->personal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_hora')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_hora); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	*/ ?>

</div>