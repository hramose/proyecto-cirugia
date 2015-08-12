<?php
/* @var $this PacienteOrdenController */
/* @var $model PacienteOrden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paciente-orden-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
	
	<?php 
	//Datos de Paciente
	$idpaciente = $_GET['idpaciente'];
	$paciente = Paciente::model()->find("id=$idpaciente");
	$nombrePaciente = $paciente->nombre. ' ' .$paciente->apellido;
	echo "<h3>Paciente: <span class='text-error'>$nombrePaciente</span></h3>";

	?>


	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


	<a href="#ingresar_acompanantes" role="button" class="btn btn-primary" data-toggle="modal"><i class="icon-pencil icon-white"></i> Añadir Servicio a la Orden</a>
	
	<div class="row"><div class="span8"></div></div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vendedor'); ?>
		<?php echo $form->dropDownList($model, 'vendedor',CHtml::listData(Personal::model()->findAll("activo = 'SI' order by 'nombres'"),'id','nombres'), array('class'=>'input-xlarge'));?>
		<?php echo $form->error($model,'vendedor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->