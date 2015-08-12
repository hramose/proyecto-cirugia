<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $model SeguimientoComercialDetalle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguimiento-comercial-detalle-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_seguimiento'); ?>
		<?php echo $form->textField($model,'fecha_seguimiento'); ?>
		<?php echo $form->error($model,'fecha_seguimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seguimiento'); ?>
		<?php echo $form->textArea($model,'seguimiento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seguimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'responsable_id'); ?>
		<?php echo $form->textField($model,'responsable_id'); ?>
		<?php echo $form->error($model,'responsable_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->