<?php
/* @var $this ConfiguracionesController */
/* @var $data Configuraciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('super_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->super_usuario); ?>
	<br />


</div>