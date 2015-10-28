<?php
/* @var $this ConfiguracionesController */
/* @var $data Configuraciones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('super_usuario')); ?>:</b>
	<?php echo CHtml::link(Chtml::encode($data->super_usuario), array('view', 'id'=>$data->id)); ?>
	<br />


</div>