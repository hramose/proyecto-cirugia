<?php
/* @var $this CajaEfectivoController */
/* @var $data CajaEfectivo */

//Actualizar Cajas Efectivo principal
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->personal->nombreCompleto), array('view', 'id'=>$data->personal_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Total ($)')); ?>:</b>
	<?php echo CHtml::encode(number_format($data->total,2)); ?>
	<br />


</div>