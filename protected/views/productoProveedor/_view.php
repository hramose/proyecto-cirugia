<?php
/* @var $this ProductoProveedorController */
/* @var $data ProductoProveedor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_nit')); ?>:</b>
	<?php echo CHtml::encode($data->doc_nit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_contacto); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->email_contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('celular_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->celular_contacto); ?>
	<br />

	*/ ?>

</div>