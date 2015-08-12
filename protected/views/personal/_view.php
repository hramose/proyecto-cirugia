<?php
/* @var $this PersonalController */
/* @var $data Personal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cc')); ?>:</b>
	<?php echo CHtml::encode($data->cc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->NombreCompleto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_nacimiento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lugar_nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->lugar_nacimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genero')); ?>:</b>
	<?php echo CHtml::encode($data->genero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('celular')); ?>:</b>
	<?php echo CHtml::encode($data->celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo')); ?>:</b>
	<?php echo CHtml::encode($data->correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arp')); ?>:</b>
	<?php echo CHtml::encode($data->arp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cualarp')); ?>:</b>
	<?php echo CHtml::encode($data->cualarp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pension')); ?>:</b>
	<?php echo CHtml::encode($data->pension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cualpension')); ?>:</b>
	<?php echo CHtml::encode($data->cualpension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salud')); ?>:</b>
	<?php echo CHtml::encode($data->salud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cualsalud')); ?>:</b>
	<?php echo CHtml::encode($data->cualsalud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sangre')); ?>:</b>
	<?php echo CHtml::encode($data->sangre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aprueba_ordenes')); ?>:</b>
	<?php echo CHtml::encode($data->aprueba_ordenes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office')); ?>:</b>
	<?php echo CHtml::encode($data->office); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('medico')); ?>:</b>
	<?php echo CHtml::encode($data->medico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seguimiento')); ?>:</b>
	<?php echo CHtml::encode($data->seguimiento); ?>
	<br />

	*/ ?>

</div>