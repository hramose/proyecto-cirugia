<?php
/* @var $this ProductoInventarioController */
/* @var $data ProductoInventario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_producto')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_referencia')); ?>:</b>
	<?php echo CHtml::encode($data->producto_referencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('costo_iva')); ?>:</b>
	<?php echo CHtml::encode($data->costo_iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio_publico')); ?>:</b>
	<?php echo CHtml::encode($data->precio_publico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iva')); ?>:</b>
	<?php echo CHtml::encode($data->iva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_presentacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_presentacion_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_unidad_medida_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_unidad_medida_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_minimo')); ?>:</b>
	<?php echo CHtml::encode($data->stock_minimo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_proveedor_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_proveedor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_inventario')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_inventario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_categoria_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_categoria_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::encode($data->personal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	*/ ?>

</div>