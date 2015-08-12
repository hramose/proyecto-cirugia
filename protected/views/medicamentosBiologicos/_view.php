<?php
/* @var $this MedicamentosBiologicosController */
/* @var $data MedicamentosBiologicos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('medicamento')); ?>:</b>
	<?php echo CHtml::encode($data->medicamento); ?>
	<br />


</div>