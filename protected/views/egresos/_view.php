<?php
/* @var $this EgresosController */
/* @var $data Egresos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proveedor_id')); ?>:</b>
	<?php echo CHtml::encode($data->proveedor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factura_id')); ?>:</b>
	<?php echo CHtml::encode($data->factura_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pago')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_pronto_pago')); ?>:</b>
	<?php echo CHtml::encode($data->desc_pronto_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_pronto_pago_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->desc_pronto_pago_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_pronto_pago_valor')); ?>:</b>
	<?php echo CHtml::encode($data->desc_pronto_pago_valor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('iva_porcentace')); ?>:</b>
	<?php echo CHtml::encode($data->iva_porcentace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_egreso')); ?>:</b>
	<?php echo CHtml::encode($data->valor_egreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_descuento')); ?>:</b>
	<?php echo CHtml::encode($data->total_descuento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iva_valor')); ?>:</b>
	<?php echo CHtml::encode($data->iva_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_aplica')); ?>:</b>
	<?php echo CHtml::encode($data->rte_aplica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retencion_id')); ?>:</b>
	<?php echo CHtml::encode($data->retencion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a_retener')); ?>:</b>
	<?php echo CHtml::encode($data->a_retener); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_base')); ?>:</b>
	<?php echo CHtml::encode($data->rte_base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_porcenaje')); ?>:</b>
	<?php echo CHtml::encode($data->rte_porcenaje); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_cree')); ?>:</b>
	<?php echo CHtml::encode($data->rte_cree); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_cree_porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->rte_cree_porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rte_cree_valor')); ?>:</b>
	<?php echo CHtml::encode($data->rte_cree_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('centro_costo_id')); ?>:</b>
	<?php echo CHtml::encode($data->centro_costo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_egreso')); ?>:</b>
	<?php echo CHtml::encode($data->total_egreso); ?>
	<br />

	*/ ?>

</div>