<?php
/* @var $this InventarioPersonalController */
/* @var $data InventarioPersonal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('personal_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->personal_id), array('view', 'id'=>$data->personal_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />


</div>