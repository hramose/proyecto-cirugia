<?php
/* @var $this PacienteController */
/* @var $data Paciente */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellido')); ?>:</b>
	<?php echo CHtml::encode($data->apellido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->n_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genero')); ?>:</b>
	<?php echo CHtml::encode($data->genero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_nacimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email2')); ?>:</b>
	<?php echo CHtml::encode($data->email2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono1')); ?>:</b>
	<?php echo CHtml::encode($data->telefono1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono2')); ?>:</b>
	<?php echo CHtml::encode($data->telefono2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('celular')); ?>:</b>
	<?php echo CHtml::encode($data->celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pais')); ?>:</b>
	<?php echo CHtml::encode($data->pais); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referer_contact')); ?>:</b>
	<?php echo CHtml::encode($data->referer_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_civil')); ?>:</b>
	<?php echo CHtml::encode($data->estado_civil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ocupacion')); ?>:</b>
	<?php echo CHtml::encode($data->ocupacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_vinculacion')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_vinculacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Aseguradora')); ?>:</b>
	<?php echo CHtml::encode($data->Aseguradora); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_acompanante')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_acompanante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acompanante_telefono')); ?>:</b>
	<?php echo CHtml::encode($data->acompanante_telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relacion_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->relacion_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable')); ?>:</b>
	<?php echo CHtml::encode($data->responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('historia_id')); ?>:</b>
	<?php echo CHtml::encode($data->historia_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tratamiento_interes_id')); ?>:</b>
	<?php echo CHtml::encode($data->tratamiento_interes_id); ?>
	<br />

	*/ ?>

</div>