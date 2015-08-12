<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $model HistorialFormulacionDetalle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-formulacion-detalle-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'formulacion_id'); ?>
		<?php echo $form->textField($model,'formulacion_id'); ?>
		<?php echo $form->error($model,'formulacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otra_formulacion'); ?>
		<?php echo $form->textField($model,'otra_formulacion',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'otra_formulacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'formulacion'); ?>
		<?php echo $form->textArea($model,'formulacion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'formulacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'historial_formulacion_id'); ?>
		<?php echo $form->textField($model,'historial_formulacion_id'); ?>
		<?php echo $form->error($model,'historial_formulacion_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->