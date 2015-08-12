<?php
/* @var $this ProductoComprasController */
/* @var $data ProductoCompras */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_proveedor_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_proveedor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factura_n')); ?>:</b>
	<?php echo CHtml::encode($data->factura_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pago')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento')); ?>:</b>
	<?php echo CHtml::encode($data->descuento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_valor')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_valor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_total')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iva')); ?>:</b>
	<?php echo CHtml::encode($data->iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iva_total')); ?>:</b>
	<?php echo CHtml::encode($data->iva_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retencion_id')); ?>:</b>
	<?php echo CHtml::encode($data->retencion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retencion_retener')); ?>:</b>
	<?php echo CHtml::encode($data->retencion_retener); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retencion_base')); ?>:</b>
	<?php echo CHtml::encode($data->retencion_base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retencion_porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->retencion_porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_iva')); ?>:</b>
	<?php echo CHtml::encode($data->rte_iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_iva_valor')); ?>:</b>
	<?php echo CHtml::encode($data->rte_iva_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_ica')); ?>:</b>
	<?php echo CHtml::encode($data->rte_ica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_ica_porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->rte_ica_porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_ica_valor')); ?>:</b>
	<?php echo CHtml::encode($data->rte_ica_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_productos')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_productos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_orden')); ?>:</b>
	<?php echo CHtml::encode($data->total_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_compra')); ?>:</b>
	<?php echo CHtml::encode($data->total_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('centro_costo_id')); ?>:</b>
	<?php echo CHtml::encode($data->centro_costo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	*/ ?>

</div>