<?php
/* @var $this SeguimientoComercialController */
/* @var $model SeguimientoComercial */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguimiento-comercial-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
		<?php echo $form->error($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textField($model,'tipo',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cita_id'); ?>
		<?php echo $form->textField($model,'cita_id'); ?>
		<?php echo $form->error($model,'cita_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paciente_id'); ?>
		<?php echo $form->textField($model,'paciente_id'); ?>
		<?php echo $form->error($model,'paciente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_accion'); ?>
		<?php echo $form->textField($model,'fecha_accion'); ?>
		<?php echo $form->error($model,'fecha_accion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_atencion'); ?>
		<?php echo $form->textField($model,'fecha_atencion'); ?>
		<?php echo $form->error($model,'fecha_atencion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tema_id'); ?>
		<?php echo $form->textField($model,'tema_id'); ?>
		<?php echo $form->error($model,'tema_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_personal'); ?>
		<?php echo $form->textField($model,'id_personal'); ?>
		<?php echo $form->error($model,'id_personal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->