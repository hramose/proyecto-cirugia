<?php
/* @var $this ProductoRetencionesController */
/* @var $model ProductoRetenciones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-retenciones-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'retencion'); ?>
		<?php echo $form->textField($model,'retencion',array('size'=>60,'maxlength'=>75, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'retencion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'a_retener'); ?>
		<?php echo $form->textField($model,'a_retener',array('size'=>10,'maxlength'=>10, 'value'=>0)); ?>
		<?php echo $form->error($model,'a_retener'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'base'); ?>
		<?php echo $form->textField($model,'base',array('size'=>10,'maxlength'=>10, 'value'=>0)); ?>
		<?php echo $form->error($model,'base'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>10,'maxlength'=>10, 'value'=>0)); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->